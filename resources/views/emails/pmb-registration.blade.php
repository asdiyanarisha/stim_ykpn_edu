<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Mahasiswa Baru</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333333;
            margin: 0;
            padding: 0;
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
            border: 1px solid #e2e8f0;
        }
        .email-header {
            background-color: #0b1d33;
            padding: 25px 20px;
            text-align: center;
            border-bottom: 4px solid #f18721;
        }
        .email-header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 20px;
            font-weight: 700;
        }
        .email-header p {
            color: #a0aec0;
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .email-body {
            padding: 30px 25px;
            line-height: 1.6;
            font-size: 14px;
            color: #2d3748;
        }
        .email-body p {
            margin-bottom: 16px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border: 1px solid #e2e8f0;
        }
        .data-table td {
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
        }
        .data-table tr:nth-child(odd) {
            background-color: #f8fafc;
        }
        .data-table td:first-child {
            font-weight: bold;
            width: 35%;
            color: #4a5568;
        }
        .data-table td a {
            color: #3182ce;
            text-decoration: none;
        }
        .warning-box {
            background-color: #fffaf0;
            border-left: 4px solid #ed8936;
            padding: 15px;
            margin: 20px 0;
            font-size: 13px;
            color: #9c4221;
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
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <!-- Header -->
            <!-- <div class="email-header">
                <h1>STIM YKPN Yogyakarta</h1>
                <p>Pendaftaran Mahasiswa Baru (PMB)</p>
            </div> -->
            
            <!-- Body -->
            <div class="email-body">
                <p>Halo <strong>{{ $pmb->nama_lengkap }}</strong>,</p>
                <p>Terima kasih telah melakukan pendaftaran di Sekolah Tinggi Ilmu Manajemen YKPN (STIM YKPN) Yogyakarta. Kami mengonfirmasi bahwa data pendaftaran Anda telah berhasil kami terima.</p>
                <p>Berikut adalah ringkasan data pendaftaran Anda:</p>
                
                <table class="data-table">
                    <tr>
                        <td>ID Pendaftaran</td>
                        <td>{{ $pmb->id_pendaftar }}</td>
                    </tr>
                    <tr>
                        <td>Jalur Registrasi</td>
                        <td>{{ $pmb->jalur_registrasi }}</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>{{ $pmb->program_studi }}</td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>{{ $pmb->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td>Asal Sekolah</td>
                        <td>{{ $pmb->asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <td>No. HP / WhatsApp</td>
                        <td>{{ $pmb->nomor_hp_wa }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><a href="mailto:{{ $pmb->email }}">{{ $pmb->email }}</a></td>
                    </tr>
                </table>
                
                <div class="warning-box">
                    <strong>Langkah Selanjutnya:</strong> Tim Panitia PMB kami akan segera melakukan verifikasi data dan berkas Anda. Kami akan menghubungi Anda kembali melalui WhatsApp atau Email untuk memberikan informasi tahapan berikutnya.
                </div>
                
                <p>Jika ada kesalahan data atau Anda ingin bertanya tentang proses pendaftaran, silakan hubungi tim panitia PMB kami.</p>
            </div>
            
            <!-- Footer -->
            <div class="email-footer">
                <p>Email ini terkirim secara otomatis, mohon untuk tidak membalas email ini.</p>
                <p>Copyright &copy; {{ date('Y') }} STIM YKPN</p>
            </div>
        </div>
    </div>
</body>
</html>
