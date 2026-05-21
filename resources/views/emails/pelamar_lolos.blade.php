<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Selamat! Anda Lolos Seleksi Administrasi</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #424862; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .button { display: inline-block; background: #424862; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
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
            <p>Anda dinyatakan <strong>LOLOS</strong> seleksi administrasi untuk posisi yang anda lamar.</p>
            <p>Silakan melanjutkan ke tahap berikutnya yaitu <strong>Psikotest Online</strong>.</p>
            <p>Klik link di bawah ini untuk mengikuti psikotest:</p>
            <p style="text-align: center;">
                <a href="{{ $psikotestLink }}" class="button">Mulai Psikotest</a>
            </p>
            <p>Atau copy link berikut: <br> <small>{{ $psikotestLink }}</small></p>
            <p>Pastikan anda mengerjakan psikotest dengan jujur dan teliti.</p>
            <p>Terima kasih.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Dagsap Recruitment. All rights reserved.</p>
        </div>
    </div>
</body>
</html>