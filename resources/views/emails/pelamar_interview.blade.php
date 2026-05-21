<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Jadwal Interview - Dagsap Recruitment</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #059669; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .info-box { background: white; padding: 15px; border-radius: 8px; margin: 15px 0; }
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
            <p>Anda dinyatakan <strong>LOLOS</strong> tahap psikotest dan berhak mengikuti interview.</p>
            
            <div class="info-box">
                <h4>Detail Interview:</h4>
                <p><strong>📅 Tanggal:</strong> {{ $tanggal }}</p>
                <p><strong>⏰ Waktu:</strong> {{ $waktu }}</p>
                <p><strong>📍 Lokasi:</strong> {{ $lokasi }}</p>
            </div>
            
            <p>Harap hadir tepat waktu dan membawa dokumen pendukung asli.</p>
            <p>Konfirmasi kehadiran Anda melalui WhatsApp yang akan kami kirimkan.</p>
            <p>Terima kasih.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Dagsap Recruitment. All rights reserved.</p>
        </div>
    </div>
</body>
</html>