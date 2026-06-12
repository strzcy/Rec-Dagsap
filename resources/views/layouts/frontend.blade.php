<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dagsap Recruitment - Karir Bersama Dagsap')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#424862',
                        'primary-dark': '#2C3550',
                        'primary-light': '#ddddff',
                    },
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @stack('styles')
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-gradient {
            background: linear-gradient(135deg, #424862 0%, #2C3550 100%);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.2);
        }
        .step-active {
            background-color: #424862;
            color: white;
        }
        .step-completed {
            background-color: #10b981;
            color: white;
        }
        .step-pending {
            background-color: #e5e7eb;
            color: #6b7280;
        }
    </style>
</head>
<body id="tentang" class="bg-gray-50">
    <nav class="bg-primary shadow-lg fixed top-0 left-0 w-full z-50">
        <div class="px-4">
            <div class="flex justify-between items-center py-3">

                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-white text-xl font-bold">
                        Dagsap Recruitment
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ url('/#tentang') }}"
                       class="text-white hover:text-gray-300 font-medium transition">
                        Tentang
                    </a>

                    <a href="{{ url('/#lowongan') }}"
                       class="text-white hover:text-gray-300 font-medium transition">
                        Lowongan
                    </a>

                    <a href="{{ url('/#kontak') }}"
                       class="text-white hover:text-gray-300 font-medium transition">
                        Kontak
                    </a>
                </div>

                <!-- Mobile Hamburger -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-white focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>

            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-3">
                <div class="pt-2 pb-3 space-y-2">

                    <a href="{{ url('/#tentang') }}"
                       class="block text-white hover:text-gray-200 px-2 py-1">
                        Tentang
                    </a>

                    <a href="{{ url('/#lowongan') }}"
                       class="block text-white hover:text-gray-200 px-2 py-1">
                        Lowongan
                    </a>

                    <a href="{{ url('/#kontak') }}"
                       class="block text-white hover:text-gray-200 px-2 py-1">
                        Kontak
                    </a>

                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer id="kontak" class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-left mb-12">
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-primary rounded flex items-center justify-center text-white font-bold">D</div>
                        <div>
                            <h3 class="font-bold text-lg text-white tracking-wide">PT DAGSAP ENDURA EATORE</h3>
                            <p class="text-xs text-gray-400 italic">Successed By Character</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Dagsap Recruitment menjadi wadah Portal Unggulan yang menghasilkan sumber daya manusia Terampil, Entrepreneur, dan Profesional di bidangnya.
                    </p>
                    
                    <div class="w-full h-44 rounded-lg overflow-hidden shadow-sm border border-gray-700 relative group">
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
                    <h3 class="font-bold text-lg text-white mb-4 relative after:content-[''] after:block after:w-10 after:h-0.5 after:bg-primary after:mt-1">Navigasi</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ url('/#tentang') }}" class="text-gray-400 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Beranda</a></li>
                        <li><a href="{{ url('/#tentang') }}" class="text-gray-400 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Profil Perusahaan</a></li>
                        <li><a href="{{ url('/#lowongan') }}" class="text-gray-400 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Lowongan Aktif</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Pengumuman</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Buku Tamu</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-lg text-white mb-4 relative after:content-[''] after:block after:w-10 after:h-0.5 after:bg-primary after:mt-1">Layanan dan Kolaborasi</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Forum Diskusi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Portal Terpadu</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition flex items-center gap-1"><i class="fas fa-chevron-right text-[10px] opacity-50"></i> Franchise</a></li>
                    </ul>
                </div>

            </div>

            <div class="border-t border-gray-700 pt-6 text-center text-sm text-gray-500 flex flex-col sm:flex-row justify-between items-center gap-2">
                <p>&copy; {{ date('Y') }} Dagsap Recruitment. All rights reserved.</p>
                <p class="text-xs text-gray-600">Powered by Laravel & Tailwind CSS</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-button')?.addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>