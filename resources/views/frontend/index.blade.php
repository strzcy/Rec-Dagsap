<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dagsap Recruitment - Karir Bersama Dagsap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#424862',
                        'primary-dark': '#2C3550',
                        'primary-light': '#ddddff',
                        'primary-blue': '#424862',

                    },
                }
            }
        }
    </script>
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
<body id="tentang" class="bg-gray-50">
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-primary">Dagsap<span class="text-gray-600">Recruitment</span></a>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#tentang" class="text-white-600 hover:text-primary font-medium transition">Tentang</a>
                    <a href="#lowongan" class="text-white-600 hover:text-primary font-medium transition">Lowongan</a>
                    <a href="#kontak" class="text-white-600 hover:text-primary font-medium transition">Kontak</a>
                </div>

                <div class="md:hidden flex items-center">
                    <button id="hamburger-btn" class="text-white-600 focus:outline-none focus:text-primary">
                        <i class="fas fa-bars text-2xl" id="burger-icon"></i>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="hidden md:hidden mt-4 pt-4 border-t border-gray-100 flex flex-col space-y-3 pb-2">
                <a href="#tentang" class="text-white-600 hover:text-primary font-medium transition py-1">Tentang</a>
                <a href="#lowongan" class="text-white-600 hover:text-primary font-medium transition py-1">Lowongan</a>
                <a href="#kontak" class="text-white-600 hover:text-primary font-medium transition py-1">Kontak</a>
            </div>
        </div>
    </nav>
    
    <section class="hero-gradient text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Mulai Karir Bersama Dagsap</h1>
            <p class="text-lg md:text-xl mb-8 opacity-90">Bergabunglah dengan perusahaan terbaik dan kembangkan potensi Anda</p>
            <div class="max-w-xl mx-auto">
                <form action="{{ route('frontend.lowongan') }}" method="GET" class="flex flex-col md:flex-row gap-2">
                    <input type="text" name="search" placeholder="Cari posisi, divisi, atau kata kunci..." 
                           class="flex-1 px-4 py-3 rounded-lg text-white-800 focus:outline-none focus:ring-2 focus:ring-primary">
                    <button type="submit" class="bg-white text-primary px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow">
                        <i class="fas fa-search mr-2 text-black"></i> Cari Lowongan
                    </button>
                </form>
            </div>
        </div>
    </section>
    
    <section id="lowongan" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-white-800 mb-4">Lowongan Terbaru</h2>
            <p class="text-center text-white-600 mb-12">Temukan posisi yang sesuai dengan kualifikasi Anda</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($lowongans as $lowongan)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover transition duration-300 border border-gray-100">
                    @if($lowongan->banner_image)
                    <img src="{{ Storage::url($lowongan->banner_image) }}" alt="{{ $lowongan->judul }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gradient-to-r from-primary to-primary-dark flex items-center justify-center">
                        <i class="fas fa-briefcase text-white text-5xl opacity-40"></i>
                    </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs text-primary bg-primary-light px-2.5 py-1 rounded-full font-medium">
                                {{ $lowongan->pengajuan->divisi->nama_divisi ?? '-' }}
                            </span>
                            <span class="text-xs text-white-500">
                                <i class="far fa-calendar-alt mr-1"></i>
                                {{ \Carbon\Carbon::parse($lowongan->tanggal_selesai)->diffForHumans() }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-white-800 mb-2">{{ $lowongan->judul }}</h3>
                        <p class="text-white-600 text-sm mb-4 line-clamp-2">{{ Str::limit(strip_tags($lowongan->deskripsi), 100) }}</p>
                        <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                            <div class="flex items-center text-white-500 text-sm">
                                <i class="fas fa-map-marker-alt mr-1.5 text-primary"></i>
                                <span>Jakarta</span>
                            </div>
                            <a href="{{ route('frontend.detail', $lowongan) }}" class="text-primary font-semibold text-sm hover:underline flex items-center">
                                Detail Lowongan <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-briefcase text-6xl text-white-300 mb-4"></i>
                    <p class="text-white-500">Belum ada lowongan tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
            
            <div class="text-center mt-12">
                {{ $lowongans->links() }}
            </div>
        </div>
    </section>
    
    <footer id="kontak" class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-left mb-12">
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-primary rounded flex items-center justify-center text-white font-bold">D</div>
                        <div>
                            <h3 class="font-bold text-lg text-white tracking-wide">PT DAGSAP ENDURA EATORE</h3>
                            <p class="text-xs text-white-500 italic">Successed By Character</p>
                        </div>
                    </div>
                    <p class="text-sm text-white-600 leading-relaxed">
                        Dagsap Recruitment menjadi wadah Portal Unggulan yang menghasilkan sumber daya manusia Terampil, Entrepreneur, dan Profesional di bidangnya.
                    </p>
                    
                    <div class="w-full h-44 rounded-lg overflow-hidden shadow-sm border border-gray-300 relative group">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.178888062831!2d106.8778!3d-6.3708!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMjInMTQuOSJTIDEwNsKwNTInNDAuMSJF!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                            class="w-full h-full border-0" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        <a href="https://maps.google.com" target="_blank" class="absolute top-2 left-2 bg-white text-xs font-semibold px-2.5 py-1 rounded shadow flex items-center gap-1 hover:bg-gray-100 transition text-blue-600">
                            Maps <i class="fas fa-external-link-alt text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-lg text-white-900 mb-4 relative after:content-[''] after:block after:w-10 after:h-0.5 after:bg-primary after:mt-1">Navigasi</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#tentang" class="text-white-600 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Beranda</a></li>
                        <li><a href="#tentang" class="text-white-600 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Profil Perusahaan</a></li>
                        <li><a href="#lowongan" class="text-white-600 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Lowongan Aktif</a></li>
                        <li><a href="#" class="text-white-600 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Pengumuman</a></li>
                        <li><a href="#" class="text-white-600 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Buku Tamu</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-lg text-white-900 mb-4 relative after:content-[''] after:block after:w-10 after:h-0.5 after:bg-primary after:mt-1">Layanan dan Kolaborasi</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#" class="text-white-600 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Forum Diskusi</a></li>
                        <li><a href="#" class="text-white-600 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Portal Terpadu</a></li>
                        <li><a href="#" class="text-white-600 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Franchise</a></li>
                    </ul>
                </div>

            </div>

            <div class="border-t border-gray-200 pt-6 text-center text-sm text-white-500 flex flex-col sm:flex-row justify-between items-center gap-2">
                <p>&copy; {{ date('Y') }} Dagsap Recruitment. All rights reserved.</p>
                <p class="text-xs text-white-400">Powered by Laravel & Tailwind CSS</p>
            </div>
        </div>
    </footer>

    <script>
        const burgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const burgerIcon = document.getElementById('burger-icon');

        burgerBtn.addEventListener('click', () => {
            // Toggle visibility menu mobile
            mobileMenu.classList.toggle('hidden');
            
            // Animasi pergantian icon (dari baris tiga ke tanda silang 'X')
            if (mobileMenu.classList.contains('hidden')) {
                burgerIcon.className = 'fas fa-bars text-2xl';
            } else {
                burgerIcon.className = 'fas fa-xmark text-2xl';
            }
        });

        // Menutup menu mobile otomatis jika tautan menu diklik
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                burgerIcon.className = 'fas fa-bars text-2xl';
            });
        });
    </script>
</body>
</html>