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
                <div class="flex items-center">
                    <a class="text-white text-xl font-bold">Dagsap Recruitment</a>
                </div>

                <div class="md:hidden flex items-center">
                    <button id="hamburger-btn" class="text-gray-600 focus:outline-none">
                        <i class="fas fa-bars text-2xl" id="burger-icon"></i>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="hidden md:hidden mt-4 pt-4 border-t border-gray-100 flex flex-col space-y-3 pb-2">
                <a href="{{ url('/#tentang') }}" class="text-gray-600 hover:text-primary font-medium transition py-1">Tentang</a>
                <a href="{{ url('/#lowongan') }}" class="text-gray-600 hover:text-primary font-medium transition py-1">Lowongan</a>
                <a href="{{ url('/#kontak') }}" class="text-gray-600 hover:text-primary font-medium transition py-1">Kontak</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-primary shadow-inner mt-auto py-4">
        <div class="container mx-auto px-4">
            <div class="text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} Dagsap Recruitment System. All rights reserved.</p>
                <p class="text-xs mt-1">Powered by Laravel</p>
            </div>
        </div>
    </footer>
    <script>
        const burgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const burgerIcon = document.getElementById('burger-icon');

        if (burgerBtn) {
            burgerBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                if (mobileMenu.classList.contains('hidden')) {
                    burgerIcon.className = 'fas fa-bars text-2xl';
                } else {
                    burgerIcon.className = 'fas fa-xmark text-2xl';
                }
            });
        }

        const mobileLinks = mobileMenu ? mobileMenu.querySelectorAll('a') : [];
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                if (burgerIcon) burgerIcon.className = 'fas fa-bars text-2xl';
            });
        });
    </script>
    @stack('scripts')
</body>
</html>