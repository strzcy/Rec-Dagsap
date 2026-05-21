<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Informasi Hasil Seleksi</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #dc2626; color: white; padding: 20px; text-align: center; }
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
            <h3>Halo, {{ $pelamar->nama_lengkap }}</h3>
            <p>Terima kasih atas minat Anda untuk bergabung dengan Dagsap.</p>
            <p>Setelah melalui proses seleksi administrasi, kami informasikan bahwa Anda <strong>BELUM MEMENUHI</strong> kriteria yang dibutuhkan untuk posisi yang anda lamar.</p>
            <p>Jangan berkecil hati, masih banyak kesempatan lain yang bisa Anda coba di masa mendatang.</p>
            <p>Tetap semangat!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Dagsap Recruitment. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 