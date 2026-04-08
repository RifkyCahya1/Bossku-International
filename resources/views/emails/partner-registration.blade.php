<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Partner Diterima</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f5f5f4;
            color: #1c1917;
        }

        .wrapper {
            max-width: 580px;
            margin: 32px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e7e5e4;
        }

        .header {
            background: #1c1917;
            padding: 40px;
        }

        .header .eyebrow {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #78716c;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 26px;
            font-weight: 600;
            color: #fafaf9;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .header p {
            font-size: 14px;
            color: #78716c;
        }

        .status-bar {
            background: #fef9ee;
            border-bottom: 1px solid #fde68a;
            padding: 14px 40px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #d97706;
            flex-shrink: 0;
        }

        .status-bar p {
            font-size: 13px;
            color: #92400e;
        }

        .body {
            padding: 36px 40px;
        }

        .greeting {
            font-size: 15px;
            color: #57534e;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .referral-box {
            border: 1px solid #e7e5e4;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            text-align: center;
        }

        .referral-box .label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #a8a29e;
            margin-bottom: 14px;
        }

        .referral-code {
            font-family: 'Courier New', monospace;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 5px;
            color: #d97706;
            background: #fef9ee;
            border: 1px solid #fde68a;
            border-radius: 8px;
            padding: 12px 20px;
            display: inline-block;
            margin-bottom: 12px;
        }

        .referral-box .note {
            font-size: 12px;
            color: #a8a29e;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #fafaf9;
            border-radius: 10px;
            padding: 16px 12px;
            text-align: center;
        }

        .stat-value {
            font-size: 18px;
            font-weight: 700;
            color: #1c1917;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 11px;
            color: #a8a29e;
            line-height: 1.4;
        }

        .divider {
            height: 1px;
            background: #f5f5f4;
            margin-bottom: 28px;
        }

        .section-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #a8a29e;
            margin-bottom: 14px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 28px;
        }

        .data-table tr {
            border-bottom: 1px solid #f5f5f4;
        }

        .data-table tr:last-child {
            border-bottom: none;
        }

        .data-table td {
            padding: 9px 0;
            font-size: 13px;
        }

        .data-table .key {
            color: #a8a29e;
            width: 40%;
        }

        .data-table .val {
            color: #1c1917;
            font-weight: 600;
            text-align: right;
        }

        .steps {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 28px;
        }

        .step {
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .step-num {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 1px solid #e7e5e4;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 11px;
            font-weight: 600;
            color: #78716c;
        }

        .step-title {
            font-size: 14px;
            font-weight: 600;
            color: #1c1917;
            margin-bottom: 3px;
        }

        .step-desc {
            font-size: 13px;
            color: #a8a29e;
        }

        .warning {
            background: #fafaf9;
            border-left: 2px solid #d97706;
            padding: 14px 16px;
            font-size: 12px;
            color: #78716c;
            line-height: 1.7;
        }

        .footer {
            border-top: 1px solid #f5f5f4;
            padding: 24px 40px;
            text-align: center;
        }

        .footer p {
            font-size: 12px;
            color: #a8a29e;
            line-height: 1.8;
        }

        .footer a {
            color: #d97706;
            text-decoration: none;
        }

        .footer-divider {
            height: 1px;
            background: #f5f5f4;
            margin: 16px 0;
        }

        @media (max-width: 480px) {

            .body,
            .footer,
            .header,
            .status-bar {
                padding-left: 24px;
                padding-right: 24px;
            }

            .stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <div class="header">
            <p class="eyebrow">BossKu Tours — Partnership Program</p>
            <h1>Pendaftaran diterima</h1>
            <p>Runner Support & Travel Series</p>
        </div>

        <div class="status-bar">
            <div class="status-dot"></div>
            <p><strong>Menunggu evaluasi</strong> — Tim kami meninjau data Anda dalam 1×24 jam kerja</p>
        </div>

        <div class="body">

            <p class="greeting">Halo, <strong>{{ $partnership->nama }}</strong> — terima kasih telah mendaftar sebagai Community Partner BossKu Tours. Data Anda sedang dalam proses evaluasi.</p>

            <div class="referral-box">
                <p class="label">Kode Referral Anda</p>
                <div class="referral-code">{{ $partnership->referral_code ?? 'PENDING' }}</div>
                <p class="note">Aktif setelah pendaftaran disetujui</p>
            </div>

            <div class="stats">
                <div class="stat-card">
                    <div class="stat-value">Rp 100K</div>
                    <div class="stat-label">Fee per pax</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">Rp 150K</div>
                    <div class="stat-label">Diskon klien</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">7 Hari</div>
                    <div class="stat-label">Transfer fee post-event</div>
                </div>
            </div>

            <div class="divider"></div>

            <p class="section-label">Data Pendaftaran</p>
            <table class="data-table">
                <tr>
                    <td class="key">Nama</td>
                    <td class="val">{{ $partnership->nama }}</td>
                </tr>
                <tr>
                    <td class="key">Email</td>
                    <td class="val">{{ $partnership->email }}</td>
                </tr>
                <tr>
                    <td class="key">WhatsApp</td>
                    <td class="val">+62{{ $partnership->whatsapp }}</td>
                </tr>
                <tr>
                    <td class="key">Kota</td>
                    <td class="val">{{ $partnership->kota }}</td>
                </tr>
                @if($partnership->perusahaan)
                <tr>
                    <td class="key">Komunitas / Org</td>
                    <td class="val">{{ $partnership->perusahaan }}</td>
                </tr>
                @endif
                <tr>
                    <td class="key">Rekening</td>
                    <td class="val">{{ $partnership->nama_bank }} · {{ $partnership->nomor_rekening }}</td>
                </tr>
            </table>

            <div class="divider"></div>

            <p class="section-label">Langkah Selanjutnya</p>
            <div class="steps">
                <div class="step">
                    <div class="step-num">1</div>
                    <div>
                        <p class="step-title">Evaluasi tim dalam 1×24 jam kerja</p>
                        <p class="step-desc">Kami meninjau kelayakan dan data yang Anda kirimkan.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-num">2</div>
                    <div>
                        <p class="step-title">Kami kirim flyer & materi promosi</p>
                        <p class="step-desc">Setelah disetujui, tim kami mengirim aset promosi dan instruksi onboarding via WhatsApp & email.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-num">3</div>
                    <div>
                        <p class="step-title">Mulai bagikan kode referral</p>
                        <p class="step-desc">Rekomendasikan ke komunitas Anda dan mulai kumpulkan fee.</p>
                    </div>
                </div>
            </div>

            <div class="warning">
                Kode referral hanya berlaku untuk booking yang mencantumkan kode saat checkout. Booking tanpa kode tidak otomatis teratribusikan ke Anda.
            </div>

        </div>

        <div class="footer">
            <p>
                <strong style="color:#1c1917;">BossKu Tours</strong> — Runner Support & Travel Series<br>
                <a href="mailto:bosskutourandtravel@gmail.com">bosskutourandtravel@gmail.com</a>
            </p>
            <div class="footer-divider"></div>
            <p>Email ini dikirim otomatis. Mohon tidak membalas langsung.<br>
                © {{ date('Y') }} BossKu Tours — All rights reserved.</p>
        </div>

    </div>
</body>

</html>