<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran Mahasiswa Baru</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333333;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f4f6f8;
            padding: 20px 0;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
        .email-header {
            background-color: #0b1d33; /* Dark Navy matching school logo */
            padding: 30px 20px;
            text-align: center;
            border-bottom: 4px solid #f18721; /* Orange divider */
        }
        .email-header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .email-header p {
            color: #a0aec0;
            margin: 5px 0 0 0;
            font-size: 13px;
        }
        .email-body {
            padding: 30px 25px;
        }
        .email-body h2 {
            color: #0b1d33;
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 15px;
        }
        .email-body p {
            font-size: 14px;
            line-height: 1.6;
            color: #4a5568;
            margin-bottom: 20px;
        }
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            background-color: #f8fafc;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .detail-table th, .detail-table td {
            padding: 12px 15px;
            text-align: left;
            font-size: 14px;
        }
        .detail-table th {
            width: 35%;
            color: #718096;
            font-weight: 600;
            border-bottom: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            background-color: #edf2f7;
        }
        .detail-table td {
            color: #2d3748;
            border-bottom: 1px solid #e2e8f0;
        }
        .detail-table tr:last-child th, .detail-table tr:last-child td {
            border-bottom: none;
        }
        .cta-box {
            background-color: #fffff0;
            border-left: 4px solid #f18721;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 0 4px 4px 0;
        }
        .cta-box p {
            margin: 0;
            font-size: 13px;
            color: #744210;
            font-weight: 500;
        }
        .email-footer {
            background-color: #edf2f7;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #718096;
            border-top: 1px solid #e2e8f0;
        }
        .email-footer p {
            margin: 5px 0;
        }
        .email-footer a {
            color: #f18721;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <!-- Header -->
            <div class="email-header">
                <h1>STIM YKPN Yogyakarta</h1>
                <p>Pendaftaran Mahasiswa Baru (PMB)</p>
            </div>
            
            <!-- Body -->
            <div class="email-body">
                <h2>Halo {{ $pmb->nama_lengkap }},</h2>
                <p>Terima kasih telah melakukan pendaftaran di Sekolah Tinggi Ilmu Manajemen YKPN (STIM YKPN) Yogyakarta. Kami mengonfirmasi bahwa data pendaftaran Anda telah berhasil kami terima.</p>
                
                <p>Berikut adalah ringkasan data pendaftaran Anda:</p>
                
                <table class="detail-table">
                    <tr>
                        <th>Jalur Registrasi</th>
                        <td>{{ $pmb->jalur_registrasi }}</td>
                    </tr>
                    <tr>
                        <th>Program Studi</th>
                        <td>{{ $pmb->program_studi }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $pmb->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Asal Sekolah</th>
                        <td>{{ $pmb->asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <th>No. HP / WhatsApp</th>
                        <td>{{ $pmb->nomor_hp_wa }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $pmb->email }}</td>
                    </tr>
                </table>
                
                <div class="cta-box">
                    <p>Langkah Selanjutnya: Tim Panitia PMB kami akan segera melakukan verifikasi data dan berkas Anda. Kami akan menghubungi Anda kembali melalui WhatsApp atau Email untuk memberikan informasi tahapan berikutnya.</p>
                </div>
                
                <p>Jika ada kesalahan data atau Anda ingin bertanya tentang proses pendaftaran, silakan hubungi tim PMB kami dengan membalas email ini atau menghubungi WhatsApp resmi kami.</p>
                
                <p>Salam hangat,<br><strong>Panitia PMB STIM YKPN Yogyakarta</strong></p>
            </div>
            
            <!-- Footer -->
            <div class="email-footer">
                <p><strong>Sekolah Tinggi Ilmu Manajemen YKPN Yogyakarta</strong></p>
                <p>Jl. Palagan Tentara Pelajar KM 7, Yogyakarta</p>
                <p>Website: <a href="https://stimykpn.ac.id" target="_blank">stimykpn.ac.id</a> | Hubungi Kami: <a href="https://wa.me/6281390001974" target="_blank">+62 813-9000-1974</a></p>
                <p style="margin-top: 15px; font-size: 11px; color: #a0aec0;">Email ini dikirim secara otomatis oleh sistem PMB STIM YKPN.</p>
            </div>
        </div>
    </div>
</body>
</html>
