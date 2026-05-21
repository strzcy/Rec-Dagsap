<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dagsap Recruitment')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f3f4f6; }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="bg-primary shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-white text-xl font-bold">Dagsap Recruitment</a>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('frontend.lowongan') }}" class="text-white hover:text-gray-200">Cari Lowongan</a>
                    <a href="{{ route('admin.login') }}" class="text-white hover:text-gray-200">
                        <i class="fas fa-user-lock mr-1"></i> Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Dagsap Recruitment. All rights reserved.</p>
            <p class="text-gray-400 text-sm mt-2">Powered by Laravel</p>
        </div>
    </footer>
    
    @stack('scripts')
</body>
</html>