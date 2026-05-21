<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Selamat! Anda Diterima</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #059669; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Dagsap Recruitment</h2>
        </div>
        <div class="content">
            <h3>Selamat, {{ $pelamar->nama_lengkap }}!</h3>
            <p>Dengan penuh sukacita kami informasikan bahwa Anda <strong>DITERIMA</strong> untuk bergabung di Dagsap.</p>
            <p>Tim HRD akan segera menghubungi Anda untuk proses onboarding lebih lanjut.</p>
            <p>Selamat bergabung dan selamat bekerja!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Dagsap Recruitment. All rights reserved.</p>
        </div>
    </div>
</body>
</html>