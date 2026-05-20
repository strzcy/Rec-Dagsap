<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dagsap Recruitment - Karir Bersama Dagsap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-gradient {
            background: linear-gradient(135deg, #424862 0%, #2C3550 100%);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <!-- Navbar Public -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-primary">Dagsap<span class="text-gray-600">Recruitment</span></a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.login') }}" class="text-gray-600 hover:text-primary transition">
                        <i class="fas fa-user-lock mr-1"></i> Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="hero-gradient text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Mulai Karir Bersama Dagsap</h1>
            <p class="text-lg md:text-xl mb-8 opacity-90">Bergabunglah dengan perusahaan terbaik dan kembangkan potensi Anda</p>
            <div class="max-w-xl mx-auto">
                <form action="{{ route('frontend.lowongan') }}" method="GET" class="flex flex-col md:flex-row gap-2">
                    <input type="text" name="search" placeholder="Cari posisi, divisi, atau kata kunci..." 
                           class="flex-1 px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary">
                    <button type="submit" class="bg-white text-primary px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        <i class="fas fa-search mr-2"></i> Cari Lowongan
                    </button>
                </form>
            </div>
        </div>
    </section>
    
    <!-- Lowongan Terbaru -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-4">Lowongan Terbaru</h2>
            <p class="text-center text-gray-600 mb-12">Temukan posisi yang sesuai dengan kualifikasi Anda</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($lowongans as $lowongan)
                <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover transition duration-300">
                    @if($lowongan->banner_image)
                    <img src="{{ Storage::url($lowongan->banner_image) }}" alt="{{ $lowongan->judul }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gradient-to-r from-primary to-primary-dark flex items-center justify-center">
                        <i class="fas fa-briefcase text-white text-5xl opacity-50"></i>
                    </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs text-primary bg-primary-light px-2 py-1 rounded-full">
                                {{ $lowongan->pengajuan->divisi->nama_divisi ?? '-' }}
                            </span>
                            <span class="text-xs text-gray-500">
                                <i class="far fa-calendar-alt mr-1"></i>
                                {{ \Carbon\Carbon::parse($lowongan->tanggal_selesai)->diffForHumans() }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $lowongan->judul }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit(strip_tags($lowongan->deskripsi), 100) }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500 text-sm">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                <span>Jakarta</span>
                            </div>
                            <a href="{{ route('frontend.apply', $lowongan) }}" 
                               class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition text-sm">
                                Lamar Sekarang →
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-briefcase text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Belum ada lowongan tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
            
            <div class="text-center mt-12">
                {{ $lowongans->links() }}
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Dagsap Recruitment. All rights reserved.</p>
            <p class="text-gray-400 text-sm mt-2">Powered by Laravel</p>
        </div>
    </footer>
</body>
</html>