@extends('layouts.nav-fe')

@section('title', 'Hasil Lamaran - Dagsap Recruitment')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 mt-16">
    <div class="bg-white rounded-xl shadow-md p-8 max-w-md w-full text-center">
        @if(session('success'))
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check-circle text-green-500 text-4xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Terima Kasih!</h1>
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        @elseif(session('error'))
            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-times-circle text-red-500 text-4xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Mohon Maaf</h1>
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <p class="text-red-700">{{ session('error') }}</p>
            </div>
        @endif
        
        <div class="bg-gray-50 rounded-lg p-4 ">
            <p class="text-gray-600">Data lamaran Anda telah kami terima.</p>
            <p class="text-gray-600 mt-1">Nomor Registrasi: <strong class="text-primary">#{{ str_pad($pelamar->id, 6, '0', STR_PAD_LEFT) }}</strong></p>
            
            @if($pelamar->status == 'lolos_tahap1')
                <div class="mt-3 p-3 bg-blue-50 rounded-lg">
                    <p class="text-blue-700 text-sm">
                        <i class="fas fa-star mr-1"></i> Selamat! Anda lolos seleksi administrasi.
                    </p>
                </div>
                @elseif($pelamar->status == 'psikotest')
                <p>Silakan melanjutkan ke tahap berikutnya yaitu <strong>Psikotest Online</strong>.</p>
                <p>Klik link di bawah ini untuk mengikuti psikotest:</p>
                <!-- <p>Atau copy link berikut: <br> <small></small></p>
                <p>Pastikan anda mengerjakan psikotest dengan jujur dan teliti.</p> -->
                <p>Terima kasih.</p> 
                
            @endif
                        
        </div>
        
        <div class="flex flex-col space-y-3">
            @if($pelamar->status == 'lolos_tahap1' && !$hasDetail)
                <a href="{{ URL::signedRoute('frontend.apply.detail_form', $pelamar) }}" 
                   class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-dark transition">
                    <i class="fas fa-arrow-right mr-2"></i> Lanjutkan ke Tahap Selanjutnya
                </a>
                @elseif($pelamar->status == 'psikotest')
                <p style="text-decoration: underline; text-align: center;">
                    <a  href="https://docs.google.com/forms/d/19zIXmhy6yHoOe7g7OBYPpyEU-1m8kPOiHnDuJBksk40/" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-dark transition">Mulai Psikotest</a>
                </p> <br>
            @endif
            <a href="{{ url('/') }}"  class="text-primary hover:underline">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection