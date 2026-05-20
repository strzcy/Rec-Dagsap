<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        'primary-blue': '#424862',

                    },
                }
            }
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="file/bow.png" type="image/x-icon">  

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar-active {
            background-color: #DC2626;
            color: white;
        }
        .sidebar-active:hover {
            background-color: #B91C1C;
        }
    </style>

    @stack('styles')
</head>
    <body class="bg-gray-100">
    
        <!-- Top Navbar -->
        @include('layouts.navbar')
    
        <!-- Main Content -->
        <div class="flex">
            <!-- Sidebar (untuk admin) -->
            @auth
                @if(auth()->user()->isDivisi() || auth()->user()->isManagement() || auth()->user()->isHrd())
                    @include('layouts.sidebar')
                @endif
            @endauth
        
            <!-- Main Content Area -->
            <main class="flex-1 p-6">
                <!-- Breadcrumb -->
                @hasSection('breadcrumb')
                    <div class="mb-4">
                        @yield('breadcrumb')
                    </div>
                @endif
            
                <!-- Page Header -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">@yield('header')</h1>
                    <p class="text-gray-500 text-sm">@yield('subheader')</p>
                </div>
            
                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
            
                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
            
                @if($errors->any())
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4 rounded">
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
    
        <!-- Footer -->
        @include('layouts.footer')
    
        @stack('scripts')
    </body>
</html>



