@extends('layouts.app')

@section('title', 'Dashboard Divisi')

@section('header', 'Dashboard Divisi')
@section('subheader', 'Selamat datang, ' . Auth::user()->name)

@section('content')
<div class="stats-grid mb-6" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <p class="text-3xl font-bold text-primary">{{ $totalPengajuan }}</p>
        <p class="text-gray-500 text-sm">Total Pengajuan</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <p class="text-3xl font-bold text-yellow-600">{{ $pendingPengajuan }}</p>
        <p class="text-gray-500 text-sm">Menunggu Approval</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <p class="text-3xl font-bold text-green-600">{{ $approvedPengajuan }}</p>
        <p class="text-gray-500 text-sm">Disetujui</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <p class="text-3xl font-bold text-red-600">{{ $rejectedPengajuan }}</p>
        <p class="text-gray-500 text-sm">Ditolak</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b">
        <h3 class="font-semibold">Pengajuan Terbaru</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs">Posisi</th>
                    <th class="px-4 py-2 text-left text-xs">Jenis</th>
                    <th class="px-4 py-2 text-left text-xs">Status</th>
                    <th class="px-4 py-2 text-left text-xs">Tanggal</th>
                    <th class="px-4 py-2 text-left text-xs">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentPengajuan as $pengajuan)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $pengajuan->posisi }}</td>
                    <td class="px-4 py-2">{{ $pengajuan->jenis }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded-full {{ $pengajuan->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($pengajuan->status == 'disetujui' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                            {{ $pengajuan->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $pengajuan->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('divisi.pengajuan.show', $pengajuan) }}" class="text-primary hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr class="border-t">
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">Belum ada pengajuan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t">
        <a href="{{ route('divisi.pengajuan.create') }}" class="text-primary hover:underline">+ Buat Pengajuan Baru</a>
    </div>
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