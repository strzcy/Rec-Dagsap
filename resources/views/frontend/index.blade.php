@extends('layouts.frontend')

@section('title', 'Dagsap Recruitment - Karir Bersama Dagsap')

@section('content')
<section class="hero-gradient text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <br>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Mulai Karir Bersama PT Dagsap Endura Eatore</h1>
        <p class="text-lg md:text-xl mb-8 opacity-90">Bergabunglah dengan perusahaan kami dan kembangkan potensi Anda</p>
        <div class="max-w-xl mx-auto">
            <form action="{{ route('frontend.lowongan') }}" method="GET" class="flex flex-col md:flex-row gap-2">
                <input type="text" name="search" placeholder="Cari posisi, divisi, atau kata kunci..." 
                    class="flex-1 px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary">
                <button type="submit" class="bg-white text-primary px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow">
                    <i class="fas fa-search mr-2"></i> Cari Lowongan
                </button>
            </form>
        </div>
    </div>
</section>

<section id="lowongan" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-4">Lowongan Terbaru</h2>
        <p class="text-center text-gray-600 mb-12">Temukan posisi yang sesuai dengan kualifikasi Anda</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($lowongans as $lowongan)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover transition duration-300 border border-gray-100">
                @if($lowongan->banner_image)
                    <img src="{{ asset($lowongan->banner_image) }}" alt="{{ $lowongan->judul }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gradient-to-r from-primary to-primary-dark flex items-center justify-center">
                        <i class="fas fa-briefcase text-white text-5xl opacity-40"></i>
                    </div>
                @endif
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs text-primary bg-primary-light px-2.5 py-1 rounded-full font-medium">
                            {{ $lowongan->pengajuan->divisi->nama_divisi ?? '-' }}
                        </span>
                        <span class="text-xs text-gray-500">
                            <i class="far fa-calendar-alt mr-1"></i>
                            {{ \Carbon\Carbon::parse($lowongan->tanggal_selesai)->diffForHumans() }}
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $lowongan->judul }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit(strip_tags($lowongan->deskripsi), 100) }}</p>
                    <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                        <a href="{{ route('frontend.detail', $lowongan) }}" class="text-primary font-semibold text-sm hover:underline flex items-center">
                            Detail Lowongan <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-briefcase text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Belum ada lowongan tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-12">
            {{ $lowongans->links() }}
        </div>
    </div>
</section>
@endsection