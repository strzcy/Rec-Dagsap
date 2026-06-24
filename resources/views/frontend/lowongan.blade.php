@extends('layouts.frontend')
@section('title', 'Dagsap Recruitment - Daftar Lowongan')

@section('content')
<!-- Search Header -->
<section class="hero-gradient text-white pt-28 pb-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Temukan Karir Impian Anda</h1>
        <p class="text-gray-300 mb-8 max-w-xl mx-auto">Cari lowongan pekerjaan aktif di PT Dagsap Endura Eatore sesuai dengan keahlian Anda.</p>
        <div class="max-w-2xl mx-auto">
            <form action="{{ route('frontend.lowongan') }}" method="GET" class="flex flex-col sm:flex-row gap-2 bg-white/10 p-2 rounded-xl backdrop-blur-md border border-white/20">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari posisi, divisi, atau kata kunci..." 
                    class="flex-1 px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary bg-white">
                <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-lg font-semibold transition shadow-md flex items-center justify-center gap-2">
                    <i class="fas fa-search"></i> Cari
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Lowongan List -->
<section class="py-16 bg-gray-50 min-h-[50vh]">
    <div class="container mx-auto px-4">
        @if(request('search'))
            <div class="mb-8">
                <p class="text-gray-600">Menampilkan hasil pencarian untuk: <strong class="text-gray-800">"{{ request('search') }}"</strong></p>
                <a href="{{ route('frontend.lowongan') }}" class="text-primary hover:underline text-sm inline-flex items-center mt-1">
                    <i class="fas fa-times mr-1.5 text-xs"></i> Hapus Pencarian
                </a>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($lowongans as $lowongan)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover transition duration-300 border border-gray-100 flex flex-col justify-between">
                <div>
                    @if($lowongan->banner_image)
                    <img src="{{ Storage::url($lowongan->banner_image) }}" alt="{{ $lowongan->judul }}" class="w-full h-48 object-cover">
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
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit(strip_tags($lowongan->deskripsi), 120) }}</p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-4 border-t border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <a href="{{ route('frontend.detail', $lowongan) }}" class="text-primary font-semibold text-sm hover:underline flex items-center">
                        Detail Lowongan <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                <i class="fas fa-briefcase text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-bold text-gray-700 mb-1">Tidak Ada Lowongan</h3>
                <p class="text-gray-500 max-w-sm mx-auto">Maaf, kami tidak dapat menemukan lowongan aktif yang cocok dengan kriteria pencarian Anda.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-12">
            {{ $lowongans->links() }}
        </div>
    </div>
</section>
@endsection
