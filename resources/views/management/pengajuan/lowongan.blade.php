<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Lowongan - Dagsap Recruitment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f3f4f6; }
        .card-hover:hover { transform: translateY(-5px); transition: all 0.3s ease; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="bg-primary shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-white text-xl font-bold">Dagsap Recruitment</a>
                <a href="{{ route('admin.login') }}" class="text-white hover:text-gray-200">
                    <i class="fas fa-user-lock mr-1"></i> Admin
                </a>
            </div>
        </div>
    </nav>
    
    <div class="container mx-auto px-4 py-8">
        <!-- Search Form -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <form method="GET" class="flex flex-col md:flex-row gap-3">
                <input type="text" name="search" placeholder="Cari posisi, divisi, atau kata kunci..." 
                       value="{{ request('search') }}"
                       class="flex-1 border rounded-lg px-4 py-3 focus:outline-none focus:border-primary">
                <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-dark">
                    <i class="fas fa-search mr-2"></i> Cari
                </button>
                @if(request('search'))
                <a href="{{ route('frontend.lowongan') }}" class="bg-gray-500 text-white px-4 py-3 rounded-lg hover:bg-gray-600 text-center">
                    Reset
                </a>
                @endif
            </form>
        </div>
        
        <!-- Results -->
        <h2 class="text-xl font-semibold mb-4">Hasil Pencarian</h2>
        
        @if($lowongans->isEmpty())
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">Tidak ada lowongan yang ditemukan.</p>
            <a href="{{ route('frontend.home') }}" class="text-primary hover:underline mt-2 inline-block">Kembali ke Beranda</a>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($lowongans as $lowongan)
            <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover transition duration-300">
                @if($lowongan->banner_image)
                <img src="{{ Storage::url($lowongan->banner_image) }}" alt="{{ $lowongan->judul }}" class="w-full h-40 object-cover">
                @else
                <div class="w-full h-40 bg-gradient-to-r from-primary to-primary-dark flex items-center justify-center">
                    <i class="fas fa-briefcase text-white text-4xl opacity-50"></i>
                </div>
                @endif
                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-primary bg-primary-light px-2 py-1 rounded-full">
                            {{ $lowongan->pengajuan->divisi->nama_divisi ?? '-' }}
                        </span>
                        <span class="text-xs text-gray-500">
                            <i class="far fa-calendar-alt mr-1"></i>
                            {{ \Carbon\Carbon::parse($lowongan->tanggal_selesai)->diffForHumans() }}
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">{{ $lowongan->judul }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit(strip_tags($lowongan->deskripsi), 100) }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>Jakarta</span>
                        </div>
                        <a href="{{ route('frontend.apply', $lowongan) }}" 
                           class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition text-sm">
                            Lamar →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $lowongans->links() }}
        </div>
        @endif
    </div>
    
    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Dagsap Recruitment. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>