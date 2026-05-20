@extends('layouts.frontend-app')

@section('title', $lowongan->judul)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if($lowongan->banner_image)
        <img src="{{ Storage::url($lowongan->banner_image) }}" alt="{{ $lowongan->judul }}" class="w-full h-64 object-cover">
        @endif
        
        <div class="p-6">
            <div class="mb-4">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $lowongan->judul }}</h1>
                <div class="flex items-center text-gray-600">
                    <i class="fas fa-building mr-2"></i>
                    <span>{{ $lowongan->pengajuan->divisi->nama_divisi ?? '-' }}</span>
                    <span class="mx-2">•</span>
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span>Ditutup: {{ \Carbon\Carbon::parse($lowongan->tanggal_selesai)->format('d M Y') }}</span>
                </div>
            </div>
            
            <div class="prose max-w-none mb-6">
                <h3 class="text-xl font-semibold mb-3">Deskripsi Pekerjaan</h3>
                <p>{{ nl2br(e($lowongan->deskripsi)) }}</p>
            </div>
            
            <div class="border-t pt-6">
                <a href="{{ route('frontend.apply', $lowongan) }}" 
                   class="inline-block bg-primary text-white px-8 py-3 rounded-lg hover:bg-primary-dark transition">
                    Lamar Sekarang →
                </a>
            </div>
        </div>
    </div>
</div>
@endsection