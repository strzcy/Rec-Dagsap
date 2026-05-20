<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Lamaran - Dagsap Recruitment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 font-[Inter]">
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="bg-white rounded-xl shadow-md p-8 text-center">
            @if(session('success'))
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ session('success') }}</h1>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <p class="text-green-700">Silakan cek email Anda untuk informasi lebih lanjut.</p>
                </div>
            @elseif(session('error'))
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-times-circle text-red-500 text-4xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ session('error') }}</h1>
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <p class="text-red-700">Jangan menyerah! Tetap semangat untuk kesempatan berikutnya.</p>
                </div>
            @endif
            
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <p class="text-gray-600">Data lamaran Anda telah kami terima.</p>
                <p class="text-gray-600">Nomor Registrasi: <strong class="text-primary">#{{ str_pad($pelamar->id, 6, '0', STR_PAD_LEFT) }}</strong></p>
            </div>
            
            <a href="{{ url('/') }}" class="inline-block bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-dark transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>