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
        body {
            font-family: 'Inter', sans-serif;
        }

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
                    <a class="text-white text-xl font-bold">
                        Dagsap Recruitment
                    </a>
                </div>
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


    @stack('scripts')

</body>
</html>