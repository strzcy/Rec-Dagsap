<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Recruitment Dagsap')</title>

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            padding-bottom: 0;
        }
        
        /* DESKTOP STYLES (≥768px) */
        @media (min-width: 768px) {
            .mobile-bottom-nav {
                display: none !important;
            }
            .desktop-sidebar {
                display: block !important;
            }
            .main-content {
                margin-bottom: 0 !important;
                padding: 1.5rem !important;
            }
            .stats-grid {
                grid-template-columns: repeat(4, 1fr) !important;
            }
        }
        
        /* MOBILE STYLES (<) */
        @media (max-width: 1245px) {
            .desktop-sidebar {
                display: none !important;
            }
            .mobile-bottom-nav {
                display: block !important;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: white;
                box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
                z-index: 50;
                padding-bottom: env(safe-area-inset-bottom);
            }

            .mb-4.page-header.pt-14 {
                padding-top: 70px;
            }

            .flex-1.min-h-screen.main-content {
                width: 100%;
                justify-content: center;
            }

            .main-content {
                padding: 1rem !important;
                margin-bottom: 70px !important;
            }
            /* Grid stats jadi 2x2 di mobile */
            .stats-grid {
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.75rem !important;
            }
            .stats-card {
                padding: 1rem !important;
            }
            .stats-number {
                font-size: 1.5rem !important;
            }
            .stats-label {
                font-size: 0.7rem !important;
            }
            /* Tabel scroll horizontal */
            .table-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                margin: 0 -1rem;
                padding: 0 1rem;
            }
            table {
                min-width: 600px;
            }
            /* Card layout */
            .card-grid {
                grid-template-columns: 1fr !important;
            }
            /* Form grid */
            .form-grid {
                grid-template-columns: 1fr !important;
            }
            /* Typography */
            h1 {
                font-size: 1.25rem !important;
            }
            h2 {
                font-size: 1.125rem !important;
            }
            .page-header {
                margin-bottom: 1rem !important;
            }
            /* Buttons lebih besar untuk touch */
            button, .btn, a.btn {
                min-height: 44px;
            }
            input, select, textarea {
                font-size: 16px !important;
            }
        }
        
        /* Active sidebar menu */
        .sidebar-active {
            background-color: #DC2626;
            color: white;
        }
        .sidebar-active:hover {
            background-color: #B91C1C;
        }
        
        /* Card hover effect */
        .card-hover:hover {
            transform: translateY(-2px);
            transition: all 0.2s ease;
        }
        
        /* Scrollbar styling */
        .table-wrapper::-webkit-scrollbar {
            height: 4px;
        }
        .table-wrapper::-webkit-scrollbar-track {
            background: #e5e7eb;
            border-radius: 10px;
        }
        .table-wrapper::-webkit-scrollbar-thumb {
            background: #424862;
            border-radius: 10px;
        }
        
        /* Footer styling */
        footer {
            margin-top: 2rem;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-100">
    <!-- Top Navbar -->
    @include('layouts.navbar')

    <!-- Desktop Layout with Sidebar -->
    <div class="flex">
        <!-- Desktop Sidebar -->
        <div class="desktop-sidebar pt-12 hidden md:block">
            @auth
                @if(auth()->user()->isDivisi() || auth()->user()->isManagement() || auth()->user()->isHrd())
                    @include('layouts.sidebar')
                @endif
            @endauth
        </div>

        <!-- Main Content Area -->
        <main class="flex-1 min-h-screen main-content">
            <!-- Breadcrumb -->
            @hasSection('breadcrumb')
                <div class="mb-4">
                    @yield('breadcrumb')
                </div>
            @endif

            <!-- Page Header -->
            <div class="mb-4 page-header pt-14">
                <h1 class="text-xl md:text-2xl font-bold text-gray-800">@yield('header')</h1>
                <p class="text-gray-500 text-xs md:text-sm">@yield('subheader')</p>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 md:p-4 mb-4 rounded text-sm" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 md:p-4 mb-4 rounded text-sm" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-3 md:p-4 mb-4 rounded text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </main>
    </div>

    <!-- Mobile Bottom Navigation -->
    @auth
        @if(auth()->user()->isDivisi() || auth()->user()->isManagement() || auth()->user()->isHrd())
            <div class="mobile-bottom-nav">
                @include('layouts.mobile-bottom-nav')
            </div>
        @endif
    @endauth

    <!-- Footer -->
    @include('layouts.footer')
    
    <!-- Mobile menu toggle script -->
    <script>
        // Mobile menu toggle for navbar
        const mobileMenuBtn = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>

    @stack('scripts')
</body>
</html>