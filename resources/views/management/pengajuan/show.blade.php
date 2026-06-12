@extends('layouts.app')

@section('title', 'Detail Pengajuan')

@section('header', 'Detail Pengajuan Tenaga Kerja')
@section('subheader', 'Lihat detail permintaan tenaga kerja')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        <!-- Informasi Pengajuan -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 pb-6 border-b">
            <div>
                <label class="text-xs text-gray-500">Nama Pemohon</label>
                <p class="font-medium">{{ $pengajuan->nama_pemohon ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Departemen</label>
                <p class="font-medium">{{ $pengajuan->divisi->nama_divisi ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Jabatan</label>
                <p class="font-medium">{{ $pengajuan->jabatan_pemohon ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">No. HP</label>
                <p class="font-medium">{{ $pengajuan->no_hp_pemohon ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">NIP/NIK</label>
                <p class="font-medium">{{ $pengajuan->nip_pemohon ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Tanggal Pengajuan</label>
                <p class="font-medium">{{ $pengajuan->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB</p>
            </div>
        </div>


        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 pb-6 border-b">
            <div>
                <label class="text-xs text-gray-500">Tanggal Dibutuhkan</label>
                <p class="font-medium">{{ $pengajuan->tanggal_dibutuhkan ? \Carbon\Carbon::parse($pengajuan->tanggal_dibutuhkan)->format('d/m/Y') : '-' }}</p>
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
                <div>
                    <label class="text-xs text-gray-500">Jenis Kebutuhan</label>
                    <p class="font-medium">{{ $pengajuan->jenis == 'penambahan' ? 'Penambahan Tenaga Kerja' : 'Penggantian Tenaga Kerja' }}</p>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="text-xs text-gray-500">Tugas dan Tanggung Jawab</label>
                <div class="mt-1 space-y-1">
                    @php
                        $tugas = is_array($pengajuan->tugas) ? $pengajuan->tugas : json_decode($pengajuan->tugas, true);
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
            @php
                $kriteria = is_array($pengajuan->kriteria) ? $pengajuan->kriteria : json_decode($pengajuan->kriteria, true);
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-gray-500">Pendidikan Minimal</label>
                    <p class="font-medium">{{ $kriteria['pendidikan'] ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Jurusan</label>
                    <p class="font-medium">{{ $kriteria['jurusan'] ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Pengalaman Kerja Minimal</label>
                    <p class="font-medium">{{ $kriteria['pengalaman'] ?? '0' }} tahun</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">IPK Minimal</label>
                    <p class="font-medium">{{ $kriteria['ipk'] ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="text-xs text-gray-500">Keahlian yang Dibutuhkan</label>
                    <p class="font-medium">{{ $kriteria['keahlian'] ?? '-' }}</p>
                </div>
            </div>
        </div>
        
        <!-- Persyaratan -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Persyaratan Lainnya</h3>
            @php
                $persyaratan = is_array($pengajuan->persyaratan) ? $pengajuan->persyaratan : json_decode($pengajuan->persyaratan, true);
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

        
        <!-- ACTION BUTTONS -->
        @if($pengajuan->status == 'pending')
        <div class="flex justify-end space-x-3 pt-4 border-t">
            <button type="button" onclick="openRejectModal()" class="px-6 py-2 border border-red-500 text-red-500 rounded-lg hover:bg-red-50">
                <i class="fas fa-times mr-2"></i> Tolak
            </button>
            <button type="button" onclick="openApproveModal()" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                <i class="fas fa-check mr-2"></i> Setujui
            </button>
        </div>
        @endif
        
        <div style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">

            <div>
                <a href="{{ route('management.pengajuan.index') }}"
                   class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            <div class="no-print">
                <a href="{{ route('management.pengajuan.print', $pengajuan) }}"
                   target="_blank"
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    <i class="fas fa-print mr-2"></i> Print PTK
                </a>
            </div>

        </div>
    </div>
</div>

<!-- Approve Modal -->
<div id="approveModal" class="fixed inset-0 bg-gray-600/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg max-w-md w-full mx-4 overflow-hidden border border-gray-100">
        <div class="p-6 text-left">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-check-circle text-green-600"></i> Setujui Pengajuan
            </h3>
            <form action="{{ route('management.pengajuan.approve', $pengajuan) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penyetuju</label>
                    <input type="text" name="disetujui_oleh" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none" value="{{ Auth::user()->name }}">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                    <input type="text" name="jabatan_penyetuju" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none" placeholder="Contoh: Manager FAT">
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" onclick="closeApproveModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-50 text-gray-700 font-medium">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium">Setujui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg max-w-md w-full mx-4 overflow-hidden border border-gray-100">
        <div class="p-6 text-left">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-times-circle text-red-600"></i> Tolak Pengajuan
            </h3>
            <form action="{{ route('management.pengajuan.reject', $pengajuan) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan</label>
                    <textarea name="alasan_penolakan" required rows="4" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none" placeholder="Masukkan alasan penolakan..."></textarea>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" onclick="closeRejectModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-50 text-gray-700 font-medium">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>    
    function openApproveModal() {
        const modal = document.getElementById('approveModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }
    
    function closeApproveModal() {
        const modal = document.getElementById('approveModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }
    
    function openRejectModal() {
        const modal = document.getElementById('rejectModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }
    
    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }
    
    // Close modal when clicking outside
    document.getElementById('approveModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeApproveModal();
        }
    });
    
    document.getElementById('rejectModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeRejectModal();
        }
    });
</script>
@endpush
@endsection
