<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\PartnerRegistrationMail;
use App\Models\Partnership;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PartnershipController extends Controller
{
    public function partner()
    {
        return view('partnership');
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'nama'           => 'required|string|min:2|max:100',
                'perusahaan' => 'sometimes|nullable|string|max:150',
                'email'          => 'required|email|max:150',
                'whatsapp'       => 'required|string|min:8|max:15|regex:/^[0-9]+$/',
                'kota'           => 'required|string|max:100',
                'namaBank'       => 'required|string|max:50',
                'nomorRekening'  => 'required|string|regex:/^[0-9]+$/|max:30',
                'namaRekening'   => 'required|string|max:100',
                'value'          => 'required|string|min:10',
                'agreements.accuracy' => 'required|accepted',
                'agreements.contact'  => 'required|accepted',
                'agreements.terms'    => 'required|accepted',
            ], [
                'nama.required'                => 'Nama lengkap wajib diisi.',
                'email.required'               => 'Alamat email wajib diisi.',
                'email.email'                  => 'Format email tidak valid.',
                'whatsapp.required'            => 'Nomor WhatsApp wajib diisi.',
                'whatsapp.regex'               => 'Nomor WhatsApp hanya boleh berisi angka.',
                'kota.required'                => 'Kota domisili wajib diisi.',
                'namaBank.required'            => 'Nama bank wajib diisi.',
                'nomorRekening.required'       => 'Nomor rekening wajib diisi.',
                'nomorRekening.regex'          => 'Nomor rekening hanya boleh berisi angka.',
                'namaRekening.required'        => 'Nama di rekening wajib diisi.',
                'value.required'               => 'Kolom motivasi wajib diisi.',
                'value.min'                    => 'Motivasi minimal 10 karakter.',
                'agreements.accuracy.accepted' => 'Semua persetujuan harus dicentang.',
                'agreements.contact.accepted'  => 'Semua persetujuan harus dicentang.',
                'agreements.terms.accepted'    => 'Semua persetujuan harus dicentang.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Data tidak valid. Periksa kembali isian formulir.',
                'errors'  => $e->errors(),
            ], 422);
        }

        if (Partnership::where('email', $validated['email'])->exists()) {
            return response()->json([
                'message' => 'Email ini sudah terdaftar sebagai Community Partner.',
            ], 409);
        }

        try {
            $partnership = Partnership::create([
                'nama'           => $validated['nama'],
                'perusahaan'     => $validated['perusahaan'] ?? null,
                'email'          => $validated['email'],
                'whatsapp'       => $validated['whatsapp'],
                'kota'           => $validated['kota'],
                'nama_bank'      => $validated['namaBank'],
                'nomor_rekening' => $validated['nomorRekening'],
                'nama_rekening'  => $validated['namaRekening'],
                'value'          => $validated['value'],
                'referral_code'  => $this->generateReferralCode($validated['nama']),
                'status'         => 'pending',
                'agr_accuracy'   => true,
                'agr_contact'    => true,
                'agr_terms'      => true,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        try {
            Mail::to($partnership->email)
                ->send(new PartnerRegistrationMail($partnership));

            $partnership->update(['email_sent_at' => now()]);
            Log::info("[Partnership] Email konfirmasi terkirim ke {$partnership->email}");
        } catch (\Throwable $e) {
            Log::error("[Partnership] Gagal kirim email ke {$partnership->email}: " . $e->getMessage());
        }

        return response()->json([
            'message'       => 'Pendaftaran berhasil diterima!',
            'partner_id'    => $partnership->id,
            'referral_code' => $partnership->referral_code,
        ], 201);
    }

    private function generateReferralCode(string $nama): string
    {
        $prefix   = 'BOSSKU';
        $initials = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $nama), 0, 3));

        do {
            $code = $prefix . '-' . $initials . strtoupper(Str::random(3));
        } while (Partnership::where('referral_code', $code)->exists());

        return $code;
    }
}
