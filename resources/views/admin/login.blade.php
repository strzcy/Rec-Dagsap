<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Recruitment Dagsap</title>
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
                }
            }
        }
    }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-[Inter]">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-building text-white text-2xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-primary">Dagsap Recruitment</h2>
                <p class="text-gray-600 mt-2">Portal User dan SDM</p>
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
                    <div class="relative flex items-center">
                        <input type="password" name="password" id="password"
                               class="w-full px-3 py-2 pr-10 border rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                               placeholder="Masukkan password" required>
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute right-3 text-gray-500 hover:text-primary focus:outline-none">
                            <i id="toggleIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg hover:bg-primary-dark transition transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
            </form>
            
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Ubah ikon jadi mata dicoret (eye-slash)
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                // Kembalikan ke ikon mata biasa
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>