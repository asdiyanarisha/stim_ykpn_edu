<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="/images/img/logo/LOGO STIM YPKN.png">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Mahasiswa Baru</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            color: #334155;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f4f6f8;
            padding: 40px 0;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            padding: 40px 35px;
        }
        .greeting {
            font-size: 15px;
            color: #1e293b;
            margin-bottom: 20px;
        }
        .greeting strong {
            font-weight: 700;
        }
        .paragraph {
            font-size: 14.5px;
            line-height: 1.6;
            color: #334155;
            margin-top: 0;
            margin-bottom: 16px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 24px 0;
        }
        .data-table td {
            border: 1px solid #e2e8f0;
            padding: 12px 16px;
            font-size: 14px;
            line-height: 1.5;
            vertical-align: middle;
        }
        .data-table td.label {
            color: #64748b;
            width: 35%;
        }
        .data-table td.value {
            color: #1e293b;
            font-weight: 500;
        }
        .email-link {
            color: #3b82f6;
            text-decoration: none;
        }
        .email-link:hover {
            text-decoration: underline;
        }
        .info-box {
            background-color: #fff7ed;
            border-left: 4px solid #f97316;
            padding: 16px 20px;
            margin: 24px 0;
            border-radius: 0 4px 4px 0;
        }
        .info-box-text {
            color: #9a3412;
            margin: 0;
            font-size: 13.5px;
            line-height: 1.6;
        }
        .info-box-text strong {
            color: #c2410c;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <!-- Greeting -->
            <div class="greeting">
                Halo <strong>{{ $pmb->nama_lengkap }}</strong>,
            </div>
            
            <!-- Opening -->
            <p class="paragraph">
                Terima kasih telah melakukan pendaftaran di Sekolah Tinggi Ilmu Manajemen YKPN (STIM YKPN) Yogyakarta. Kami mengonfirmasi bahwa data pendaftaran Anda telah berhasil kami terima.
            </p>
            <p class="paragraph">
                Berikut adalah ringkasan data pendaftaran Anda:
            </p>
            
            <!-- Table Summary -->
            <table class="data-table">
                <tr>
                    <td class="label">ID Pendaftaran</td>
                    <td class="value">{{ $pmb->id_pendaftar }}</td>
                </tr>
                <tr>
                    <td class="label">Jalur Registrasi</td>
                    <td class="value">{{ $pmb->jalur_registrasi }}</td>
                </tr>
                <tr>
                    <td class="label">Program Studi</td>
                    <td class="value">{{ $pmb->program_studi }}</td>
                </tr>
                <tr>
                    <td class="label">Nama Lengkap</td>
                    <td class="value">{{ $pmb->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td class="label">Asal Sekolah</td>
                    <td class="value">{{ $pmb->asal_sekolah }}</td>
                </tr>
                <tr>
                    <td class="label">No. HP / WhatsApp</td>
                    <td class="value">{{ $pmb->nomor_hp_wa }}</td>
                </tr>
                <tr>
                    <td class="label">Email</td>
                    <td class="value">
                        <a href="mailto:{{ $pmb->email }}" class="email-link">{{ $pmb->email }}</a>
                    </td>
                </tr>
            </table>
            
            <!-- Langkah Selanjutnya Box -->
            <div class="info-box">
                <p class="info-box-text">
                    <strong>Langkah Selanjutnya:</strong> Tim Panitia PMB kami akan segera melakukan verifikasi data dan berkas Anda. Kami akan menghubungi Anda kembali melalui WhatsApp atau Email untuk memberikan informasi tahapan berikutnya.
                </p>
            </div>
            
            <!-- Footer -->
            <p class="paragraph" style="margin-bottom: 0;">
                Jika ada kesalahan data atau Anda ingin bertanya tentang proses pendaftaran, silakan hubungi tim panitia PMB kami.
            </p>
        </div>
    </div>
</body>
</html>
