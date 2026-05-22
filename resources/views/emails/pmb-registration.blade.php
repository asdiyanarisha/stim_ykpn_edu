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
        .email-body {
            padding: 30px 25px;
            line-height: 1.6;
            font-size: 14px;
            color: #2d3748;
        }
        .email-body p {
            margin-bottom: 16px;
        }
        .email-body .highlight {
            font-weight: bold;
            font-size: 15px;
            margin: 20px 0;
            padding: 12px 15px;
            background-color: #f8fafc;
            border-left: 4px solid #f18721;
            font-family: monospace;
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
            <div class="email-header">
                <h1>Pendaftaran Mahasiswa Baru</h1>
            </div>
            
            <!-- Body -->
            <div class="email-body">
                <p>Hai {{ $pmb->nama_lengkap }},</p>
                <div class="highlight">
                    Nomor pendaftaran anda : {{ $pmb->id_pendaftar }}
                </div>
                <p>Anda telah berhasil mendaftar sebagai Calon Mahasiswa Baru di STIM YKPN Yogyakarta.</p>
                <p>Untuk proses selanjutnya akan dihubungi oleh panitia penerimaan mahasiswa baru. Melalui nomor telepon yang telah anda daftarkan.</p>
                <p>Terima kasih.</p>
            </div>
            
            <!-- Footer -->
            <div class="email-footer">
                <p>Email ini terkirim secara otomatis, mohon untuk tidak membalas email ini.</p>
                <p>Copyright &copy; 2026 STIM YKPN</p>
            </div>
        </div>
    </div>
</body>
</html>
