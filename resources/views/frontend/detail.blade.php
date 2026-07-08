@extends('layouts.nav-fe')

@section('title', $lowongan->judul . ' - Dagsap Recruitment')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl mt-16">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if($lowongan->banner_image)
            <img src="{{ asset($lowongan->banner_image) }}" alt="{{ $lowongan->judul }}" class="w-full h-48 object-cover">
        @endif
        
        <div class="p-6">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $lowongan->judul }}</h1>
                <div class="flex flex-wrap items-center text-gray-600 gap-2">
                    <span class="bg-primary-light text-primary px-3 py-1 rounded-full text-sm">
                        <i class="fas fa-building mr-1"></i> {{ $lowongan->pengajuan->divisi->nama_divisi ?? '-' }}
                    </span>
                    <span class="text-gray-400">•</span>
                    <span><i class="far fa-calendar-alt mr-1"></i> Ditutup: {{ \Carbon\Carbon::parse($lowongan->tanggal_selesai)->format('d M Y') }}</span>
                    <span class="text-gray-400">•</span>
                    <span><i class="fas fa-users mr-1"></i> Dibutuhkan: {{ $lowongan->pengajuan->jumlah }} orang</span>
                </div>
            </div>
            
            <!-- Deskripsi Pekerjaan -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-3 border-l-4 border-primary pl-3">Deskripsi Pekerjaan</h2>
                <div class="text-gray-700 leading-relaxed">
                    {!! nl2br(e($lowongan->deskripsi)) !!}
                </div>
            </div>
            
            <!-- Tugas dan Tanggung Jawab -->
            @php
                $tugas = is_array($lowongan->pengajuan->tugas) ? $lowongan->pengajuan->tugas : json_decode($lowongan->pengajuan->tugas, true);
            @endphp
            @if(!empty($tugas))
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-3 border-l-4 border-primary pl-3">Tugas dan Tanggung Jawab</h2>
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    @foreach($tugas as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <!-- Spesifikasi Calon -->
            @php
                $kriteria = is_array($lowongan->pengajuan->kriteria) ? $lowongan->pengajuan->kriteria : json_decode($lowongan->pengajuan->kriteria, true);
            @endphp
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-3 border-l-4 border-primary pl-3">Kualifikasi yang Dibutuhkan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-graduation-cap text-primary mt-1 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">Pendidikan Minimal</p>
                            <p class="font-medium">{{ $kriteria['pendidikan'] ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-book text-primary mt-1 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">Jurusan</p>
                            <p class="font-medium">{{ $kriteria['jurusan'] ?? 'Semua Jurusan' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-briefcase text-primary mt-1 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">Pengalaman Kerja</p>
                            <p class="font-medium">{{ $kriteria['pengalaman'] ?? '0' }} tahun</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-chart-line text-primary mt-1 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">IPK Minimal</p>
                            <p class="font-medium">{{ $kriteria['ipk'] ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="md:col-span-2 flex items-start">
                        <i class="fas fa-code text-primary mt-1 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">Keahlian yang Dibutuhkan</p>
                            <p class="font-medium">{{ $kriteria['keahlian'] ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Persyaratan Lainnya -->
            @php
                $persyaratan = is_array($lowongan->pengajuan->persyaratan) ? $lowongan->pengajuan->persyaratan : json_decode($lowongan->pengajuan->persyaratan, true);
            @endphp
            @if(!empty($persyaratan))
            <div class="mb-8">
                <!-- <h2 class="text-xl font-semibold text-gray-800 mb-3 border-l-4 border-primary pl-3">Persyaratan Lainnya</h2> -->
                <ul class="list-disc list-inside space-y-1 text-gray-700">
                    @foreach($persyaratan as $item)
                        <!-- <li>{{ $item }}</li> -->
                    @endforeach
                </ul>
            </div>
            @endif
            
            <!-- Tombol Lamar -->
            <div class="border-t pt-6">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <p class="text-yellow-800 text-sm">
                        <i class="fas fa-info-circle mr-2"></i>
                        Pastikan Anda memenuhi semua kualifikasi yang dibutuhkan sebelum melamar.
                    </p>
                </div>
                
                <a href="{{ route('frontend.apply', $lowongan) }}" 
                   class="inline-block bg-primary text-white px-8 py-3 rounded-lg hover:bg-primary-dark transition text-center w-full md:w-auto">
                    <i class="fas fa-paper-plane mr-2"></i> Lamar Sekarang →
                </a>
            </div>
        </div>
    </div>
    
    <div class="mt-6 text-center">
        <a href="{{ url('/') }}" class="text-primary hover:underline">
            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda
        </a>
    </div>
</div>
@endsection