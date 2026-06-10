@extends('layouts.app')

@section('title', 'Verifikasi NIK')

@section('header', 'Verifikasi NIK')
@section('subheader', 'Masukkan NIK/NIP Anda untuk melihat riwayat pengajuan')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-id-card text-white text-2xl"></i>
            </div>
            <h2 class="text-xl font-semibold text-gray-800">Verifikasi NIK/NIP</h2>
            <p class="text-gray-500 text-sm mt-2">Masukkan NIK/NIP yang digunakan saat mengajukan PTK</p>
        </div>
        
        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif
        
        <form method="POST" action="{{ route('divisi.pengajuan.verify') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">NIK / NIP <span class="text-red-500">*</span></label>
                <input type="text" name="nik" required 
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary"
                       placeholder="Masukkan NIK/NIP Anda">
                <p class="text-xs text-gray-500 mt-1">Contoh: 1234567890</p>
            </div>
            
            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg hover:bg-primary-dark">
                <i class="fas fa-search mr-2"></i> Lihat Riwayat
            </button>
        </form>
        
        <div class="mt-4 text-center">
            <a href="{{ route('divisi.dashboard') }}" class="text-primary text-sm hover:underline">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection