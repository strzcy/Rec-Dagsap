@extends('layouts.app')

@section('title', 'Riwayat Pengajuan Tenaga Kerja')

@section('header', 'Riwayat Pengajuan Tenaga Kerja')
@section('subheader', 'Daftar semua permintaan tenaga kerja yang telah diajukan')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b flex justify-between items-center flex-wrap gap-2">
        <h2 class="text-lg font-semibold">Daftar Pengajuan</h2>
        <a href="{{ route('divisi.pengajuan.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark">
            + Pengajuan Baru
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posisi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Divisi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pengajuans as $index => $pengajuan)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-medium">{{ $pengajuan->posisi }}</td>
                    <td class="px-6 py-4">{{ $pengajuan->departemen->nama_divisi ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full {{ $pengajuan->jenis == 'penambahan' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $pengajuan->jenis == 'penambahan' ? 'Penambahan' : 'Penggantian' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $pengajuan->jumlah }}</td>
                    <td class="px-6 py-4">
                        @if($pengajuan->status == 'pending')
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        @elseif($pengajuan->status == 'disetujui')
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Disetujui</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $pengajuan->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('divisi.pengajuan.show', $pengajuan) }}" class="text-primary hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        Belum ada pengajuan. Silakan buat pengajuan baru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t">
        {{ $pengajuans->links() }}
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
            </div>
        </div>
    </div>
</div>

<script>
    function closeModal() {
        const modal = document.getElementById('successModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }
    
    // Tutup modal jika klik di luar
    document.getElementById('successModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });
</script>
@endif
@endsection