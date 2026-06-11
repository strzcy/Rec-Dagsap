@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')

<div>
    <section class="hero-gradient text-primary py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-1xl font-bold mb-4">Selamat Datang di Dashboard User</h1>
            <p class="text-lg md:text-xl mb-8 opacity-90">Di dashboard ini, anda bisa mengajukan Permintaan Tenaga Kerja (PTK) Penambahan maupun Penggantian</p>
            <div>

            <div class="text-2xlbg-bl text-white px-4 py-2 rounded-lg" style="text-align:center;">
                <a href="{{ route('divisi.dashboard') }}" class=" px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark" style="text-align:center;">
                    Ajukan Form PTK
                </a>
            </div>                  
            </div>
        </div>
    </section>
</div>



<!-- Modal Popup Sukses Submit -->
@if(session('success_submit'))
<div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all">
        <div class="text-center p-6">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Berhasil!</h3>
            <p class="text-sm text-gray-500 mb-4">{{ session('success_message') }}</p>
            
            @php $ptkData = session('ptk_data'); @endphp
            @if($ptkData)
            <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left">
                <p class="text-xs text-gray-500 mb-2">Detail Pengajuan:</p>
                <div class="space-y-1 text-sm">
                    <p><span class="font-medium">Posisi:</span> {{ $ptkData['posisi'] }}</p>
                    <p><span class="font-medium">Divisi:</span> {{ $ptkData['divisi'] }}</p>
                    <p><span class="font-medium">Jumlah:</span> {{ $ptkData['jumlah'] }} orang</p>
                    <p><span class="font-medium">Tanggal Dibutuhkan:</span> {{ $ptkData['tanggal_dibutuhkan'] }}</p>
                </div>
            </div>
            @endif
            
            <div class="flex gap-3">
                <a href="{{ route('divisi.dashboard') }}" class="flex-1 bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition">
                    <i class="fas fa-home mr-2"></i> Ke Dashboard
                </a>
                <a href="{{ route('divisi.pengajuan.create') }}" class="flex-1 border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-plus-circle mr-2"></i> Buat Lagi
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Tutup modal jika klik di luar
    document.getElementById('successModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });
</script>
@endif
@endsection