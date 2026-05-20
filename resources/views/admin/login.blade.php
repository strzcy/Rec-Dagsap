<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Recruitment Dagsap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 font-[Inter]">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-building text-white text-2xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-primary">Dagsap Recruitment</h2>
                <p class="text-gray-600 mt-2">Admin Area</p>
            </div>
            
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        <i class="fas fa-user mr-2"></i> Username
                    </label>
                    <input type="text" name="username" value="{{ old('username') }}" 
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                           placeholder="Masukkan username" required autofocus>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        <i class="fas fa-lock mr-2"></i> Password
                    </label>
                    <input type="password" name="password" 
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                           placeholder="Masukkan password" required>
                </div>
                
                <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg hover:bg-primary-dark transition transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
            </form>
            
            <div class="mt-6 text-center text-sm text-gray-600">
                <a href="{{ url('/') }}" class="text-primary hover:underline">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Halaman Utama
                </a>
            </div>
            
            <!-- Demo Credentials -->
            <div class="mt-8 pt-6 border-t">
                <p class="text-xs text-center text-gray-500 mb-3">Demo Credentials:</p>
                <div class="grid grid-cols-2 gap-2 text-xs">
                    <div class="bg-gray-50 p-2 rounded">
                        <p class="font-semibold">Management:</p>
                        <p>user: management</p>
                        <p>pass: password</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded">
                        <p class="font-semibold">HRD:</p>
                        <p>user: hrd</p>
                        <p>pass: password</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded">
                        <p class="font-semibold">Divisi TI:</p>
                        <p>user: ti</p>
                        <p>pass: password</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded">
                        <p class="font-semibold">Divisi SDM:</p>
                        <p>user: sdm</p>
                        <p>pass: password</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>