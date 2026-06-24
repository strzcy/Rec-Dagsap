@extends('layouts.frontend')

@section('title', 'Hasil Lamaran - Dagsap Recruitment')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 mt-16">
    <div class="bg-white rounded-xl shadow-md p-8 max-w-md w-full text-center">
        <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-times-circle text-red-500 text-4xl"></i>
        </div>
        
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Mohon Maaf</h1>
        
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <p class="text-red-700">{{ session('error') }}</p>
                @if(session('reason'))
                    <p class="text-red-600 text-sm mt-2">{{ session('reason') }}</p>
                @endif
            </div>
        @endif
        
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <p class="text-gray-600">Terima kasih atas minat Anda untuk bergabung dengan Dagsap.</p>
            <p class="text-gray-600 mt-2">Jangan berkecil hati, masih banyak lowongan lain yang mungkin sesuai dengan kualifikasi Anda.</p>
        </div>
        
        <div class="flex flex-col space-y-3">
            <a href="{{ url('/') }}" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-dark transition">
                <i class="fas fa-home mr-2"></i> Kembali ke Beranda
            </a>
            <a href="{{ route('frontend.lowongan') }}" class="text-primary hover:underline">
                Lihat Lowongan Lainnya
            </a>
        </div>
    </div>
</div>
@endsection