<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class BackofficeService
{
    protected string $baseUrl;
    protected string $cookieFile;
    protected string $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36';

    public function __construct()
    {
        $this->baseUrl    = rtrim(config('backoffice.url', 'https://backoffice.holidaymyboss.com'), '/');
        $this->cookieFile = storage_path('app/backoffice_session.txt');

        if (!file_exists($this->cookieFile)) {
            touch($this->cookieFile);
            chmod($this->cookieFile, 0664);
        }
    }

    // ────────────────────────────────────────────
    // LOGIN
    // ────────────────────────────────────────────
    public function login(bool $force = false): bool
    {
        if (!$force && Cache::has('backoffice_session_valid')) {
            return true;
        }

        // Hapus cookie lama
        file_put_contents($this->cookieFile, '');

        // ── Step 1: GET halaman login ──
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $this->baseUrl . '/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_COOKIEJAR      => $this->cookieFile,
            CURLOPT_COOKIEFILE     => $this->cookieFile,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_USERAGENT      => $this->userAgent,
            CURLOPT_HTTPHEADER     => [
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8',
            ],
        ]);
        curl_exec($ch);
        curl_close($ch);

        Log::info('Backoffice: cookie after GET', [
            'cookie_file' => file_get_contents($this->cookieFile)
        ]);

        // ── Step 2: POST login — TANPA FOLLOWLOCATION ──
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $this->baseUrl . '/Login/cek',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query([
                'username' => config('backoffice.username'),
                'userpass' => config('backoffice.password'),
            ]),
            // ✅ TIDAK pakai FOLLOWLOCATION agar kita bisa tangkap Set-Cookie dari redirect
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_COOKIEJAR      => $this->cookieFile,
            CURLOPT_COOKIEFILE     => $this->cookieFile,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_USERAGENT      => $this->userAgent,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8',
                'Origin: ' . $this->baseUrl,
                'Referer: ' . $this->baseUrl . '/login',
            ],
        ]);

        $postResponse = curl_exec($ch);
        $httpCode     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError    = curl_error($ch);
        curl_close($ch);

        Log::info('Backoffice: POST login raw response', [
            'http_code'    => $httpCode,
            'headers_only' => substr($postResponse, 0, 800),
        ]);

        if ($curlError) {
            Log::error('Backoffice login error', ['error' => $curlError]);
            return false;
        }
        
        $isRedirect = $httpCode === 301 || $httpCode === 302 || $httpCode === 303;

        // Extract Location header
        $location = null;
        if (preg_match('/^Location:\s*(.+)$/im', $postResponse, $m)) {
            $location = trim($m[1]);
        }

        // Extract cookie baru dari response
        // ✅ Ganti bagian extract cookie — ambil yang PERTAMA saja, bukan yang terakhir
        preg_match_all('/set-cookie:\s*core_ci=([^;]+)/i', $postResponse, $matches);

        $cookieVal = null;
        foreach ($matches[1] as $val) {
            if ($val !== 'deleted') {
                $cookieVal = $val;
                break; // ✅ Stop di yang pertama valid, jangan lanjut ke 'deleted'
            }
        }

        if ($cookieVal) {
            Cache::put('backoffice_core_ci', $cookieVal, now()->addHours(2));
            Log::info('Backoffice: session cookie captured', [
                'cookie' => substr($cookieVal, 0, 20) . '...'
            ]);
        }

        Log::info('Backoffice: login result', [
            'http_code'   => $httpCode,
            'is_redirect' => $isRedirect,
            'location'    => $location,
        ]);

        // ── Step 4: Ikuti redirect ke dashboard secara manual ──
        $success = false;
        if ($isRedirect && $location) {
            $redirectUrl = str_starts_with($location, 'http')
                ? $location
                : $this->baseUrl . $location;

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL            => $redirectUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => true,  // ✅ ambil header untuk debug
                CURLOPT_FOLLOWLOCATION => false, // ✅ jangan auto follow dulu
                CURLOPT_COOKIEJAR      => $this->cookieFile,
                CURLOPT_COOKIEFILE     => $this->cookieFile,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_USERAGENT      => $this->userAgent,
                CURLOPT_HTTPHEADER     => [
                    'Accept: text/html,application/xhtml+xml,*/*',
                    'Referer: ' . $this->baseUrl . '/Login/cek',
                ],
            ]);
            curl_exec($ch);
            $dashboardCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $dashboardUrl  = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
            curl_close($ch);

            $success = !str_contains($dashboardUrl, '/login');

            Log::info('Backoffice: dashboard redirect', [
                'http_code'   => $dashboardCode,
                'final_url'   => $dashboardUrl,
                'success'     => $success,
            ]);
        }

        if ($success) {
            Cache::put('backoffice_session_valid', true, now()->addHours(2));
        }

        return $success;
    }

    // ────────────────────────────────────────────
    // SEND PACKAGE
    // ────────────────────────────────────────────
    public function sendPackage(array $data): array
    {
        if (!$this->login()) {
            return ['success' => false, 'message' => 'Backoffice login failed'];
        }

        $payload = [
            'PackageID'        => '',
            'PackageCode'      => 'SUB' . now()->format('ymd') . '.ID',
            'CodeDest'         => $data['code_dest']     ?? 'ID',
            'PackageCode2'     => $data['package_code2'] ?? '',
            'TourCode'         => $data['tour_code']     ?? '',
            'online_pt_id'     => '',
            'PackageName'      => $data['package_name'],
            'PackagePax'       => $data['pax']           ?? 1,
            'PackageHeader'    => 'Header_bossku_tour.png',
            'PackageFooterINV' => 'footer_TT_Bossku.txt',
            'PackageFooterTT'  => 'footer_TT_Bossku.txt',
            'PackageNote'      => $data['note']          ?? '',
        ];

        Log::info('Backoffice: sending package_cu', ['payload' => $payload]);

        $result = $this->post('/transaction/package_cu', $payload);

        // Session expired → retry sekali
        if (isset($result['final_url']) && str_contains($result['final_url'], 'login')) {
            Log::warning('Backoffice: session expired, retrying...');
            Cache::forget('backoffice_session_valid');
            Cache::forget('backoffice_core_ci');

            if ($this->login(true)) {
                $result = $this->post('/transaction/package_cu', $payload);
            } else {
                return ['success' => false, 'message' => 'Re-login failed'];
            }
        }

        return $result;
    }

    // ────────────────────────────────────────────
    // HELPER POST
    // ────────────────────────────────────────────
    private function post(string $path, array $payload): array
    {
        $cachedCookie = Cache::get('backoffice_core_ci');

        if (!$cachedCookie) {
            Log::warning('Backoffice: no cookie in cache for post request');
            return ['success' => false, 'message' => 'No session cookie'];
        }

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $this->baseUrl . $path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($payload),
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: text/html,application/xhtml+xml,*/*',
                'Referer: ' . $this->baseUrl . '/dashboard',
                'Origin: ' . $this->baseUrl,
                // ✅ Set cookie langsung via header, tidak pakai file
                'Cookie: core_ci=' . $cachedCookie,
            ],
            // ✅ Tidak pakai COOKIEJAR/COOKIEFILE agar tidak tertimpa 'deleted'
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_USERAGENT      => $this->userAgent,
        ]);

        $response  = curl_exec($ch);
        $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $finalUrl  = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            Log::error('Backoffice cURL error', ['path' => $path, 'error' => $curlError]);
            return ['success' => false, 'message' => $curlError];
        }

        Log::info('Backoffice response', [
            'path'      => $path,
            'http_code' => $httpCode,
            'final_url' => $finalUrl,
            'response'  => substr($response ?? '', 0, 500),
        ]);

        return [
            'success'   => $httpCode >= 200 && $httpCode < 300,
            'http_code' => $httpCode,
            'final_url' => $finalUrl,
            'response'  => $response,
        ];
    }
}
