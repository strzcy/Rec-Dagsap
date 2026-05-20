@extends('layouts.app')

@section('title', 'Detail Pengajuan')

@section('header', 'Detail Pengajuan Tenaga Kerja')
@section('subheader', 'Review detail permintaan tenaga kerja')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        <!-- Status Banner -->
        <div class="mb-6 p-4 rounded-lg {{ $pengajuan->status == 'pending' ? 'bg-yellow-50 border border-yellow-200' : ($pengajuan->status == 'disetujui' ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200') }}">
            <div class="flex items-center justify-between">
                <div>
                    <span class="font-semibold">Status: </span>
                    @if($pengajuan->status == 'pending')
                        <span class="text-yellow-700">Menunggu Approval</span>
                    @elseif($pengajuan->status == 'disetujui')
                        <span class="text-green-700">Disetujui oleh {{ $pengajuan->approvedBy->name ?? 'Management' }} pada {{ $pengajuan->approved_at ? $pengajuan->approved_at->format('d/m/Y H:i') : '-' }}</span>
                    @else
                        <span class="text-red-700">Ditolak</span>
                    @endif
                </div>
                @if($pengajuan->status == 'ditolak' && $pengajuan->alasan_penolakan)
                    <div class="text-sm text-red-600">
                        Alasan: {{ $pengajuan->alasan_penolakan }}
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Informasi Pengajuan -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 pb-6 border-b">
            <div>
                <label class="text-xs text-gray-500">Divisi Pengaju</label>
                <p class="font-medium">{{ $pengajuan->divisi->nama_divisi ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Diajukan Oleh</label>
                <p class="font-medium">{{ $pengajuan->user->name ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Tanggal Pengajuan</label>
                <p class="font-medium">{{ $pengajuan->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Jenis Kebutuhan</label>
                <p class="font-medium">{{ $pengajuan->jenis == 'penambahan' ? 'Penambahan Tenaga Kerja' : 'Penggantian Tenaga Kerja' }}</p>
            </div>
        </div>
        
        <!-- Detail Pekerjaan -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Detail Pekerjaan</h3>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="text-xs text-gray-500">Posisi</label>
                    <p class="font-medium">{{ $pengajuan->posisi }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Jumlah Dibutuhkan</label>
                    <p class="font-medium">{{ $pengajuan->jumlah }} orang</p>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="text-xs text-gray-500">Tugas dan Tanggung Jawab</label>
                <div class="mt-1 space-y-1">
                    @php
                        $tugas = json_decode($pengajuan->tugas, true) ?? [];
                    @endphp
                    @if(!empty($tugas))
                        @foreach($tugas as $item)
                            <p class="text-sm">• {{ $item }}</p>
                        @endforeach
                    @else
                        <p class="text-gray-500">-</p>
                    @endif
                </div>
            </div>
            
            <div class="mb-4">
                <label class="text-xs text-gray-500">Deskripsi Pekerjaan</label>
                <p class="mt-1 text-gray-700">{{ nl2br(e($pengajuan->deskripsi_pekerjaan)) ?: '-' }}</p>
            </div>
        </div>
        
        <!-- Spesifikasi Calon -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Spesifikasi Calon</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-gray-500">Pendidikan Minimal</label>
                    <p class="font-medium">{{ json_decode($pengajuan->kriteria, true)['pendidikan'] ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Pengalaman Kerja Minimal</label>
                    <p class="font-medium">{{ json_decode($pengajuan->kriteria, true)['pengalaman'] ?? '-' }} tahun</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Keahlian</label>
                    <p class="font-medium">{{ json_decode($pengajuan->kriteria, true)['keahlian'] ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">IPK Minimal</label>
                    <p class="font-medium">{{ json_decode($pengajuan->kriteria, true)['ipk'] ?? '-' }}</p>
                </div>
            </div>
        </div>
        
        <!-- Persyaratan -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Persyaratan Lainnya</h3>
            @php
                $persyaratan = json_decode($pengajuan->persyaratan, true) ?? [];
            @endphp
            @if(!empty($persyaratan))
                <ul class="list-disc list-inside space-y-1">
                    @foreach($persyaratan as $item)
                        <li class="text-gray-700">{{ $item }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">-</p>
            @endif
        </div>
        
        <!-- Action Buttons (only if status pending) -->
        @if($pengajuan->status == 'pending')
        <div class="flex justify-end space-x-3 pt-4 border-t">
            <button onclick="openRejectModal()" class="px-6 py-2 border border-red-500 text-red-500 rounded-lg hover:bg-red-50">
                Tolak
            </button>
            <form action="{{ route('management.pengajuan.approve', $pengajuan) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Setujui
                </button>
            </form>
        </div>
        @endif
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Tolak Pengajuan</h3>
        <form action="{{ route('management.pengajuan.reject', $pengajuan) }}" method="POST">
            @csrf
            <textarea name="alasan_penolakan" rows="4" class="w-full border rounded-lg px-3 py-2 mb-4" placeholder="Masukkan alasan penolakan..." required></textarea>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 border rounded-lg">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Kirim</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openRejectModal() {
        document.getElementById('rejectModal').classList.remove('hidden');
        document.getElementById('rejectModal').classList.add('flex');
    }
    
    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectModal').classList.remove('flex');
    }
</script>
@endpush
@endsection