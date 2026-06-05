@extends('layouts.nav-fe')

@section('title', 'Login Admin - Dagsap Recruitment')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 mt-16">
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
        
        <div class="mt-6 text-center text-sm text-gray-600">
            <a href="{{ url('/') }}" class="text-primary hover:underline">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Halaman Utama
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
@endpush
@endsection