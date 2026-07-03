@extends('layouts.app')

@section('title', 'Detail Pengajuan')

@section('header', 'Detail Pengajuan Tenaga Kerja')
@section('subheader', 'Lihat detail permintaan tenaga kerja')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        <!-- Informasi Pengajuan -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 ">
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

            <div>
                <label class="text-xs text-gray-500">Status</label>
                <p>
                    @if($pengajuan->status == 'pending')
                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                    @elseif($pengajuan->status == 'disetujui')
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Disetujui</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Ditolak</span>
                    @endif
                </p>
            </div>
        </div>


        @if($pengajuan->status == 'disetujui')
        <div class="grid grid-cols-2 gap-4 mb-6  pt-6 border-t">
            <div>
                <label class="text-xs text-gray-500">Disetujui Oleh</label>
                <p class="font-medium">{{ $pengajuan->disetujui_oleh ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Jabatan Penyetuju</label>
                <p class="font-medium">{{ $pengajuan->jabatan_penyetuju ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Tanggal Disetujui</label>
                <p class="font-medium">{{ $pengajuan->approved_at ? \Carbon\Carbon::parse($pengajuan->approved_at)->format('d/m/Y H:i') : '-' }} WIB</p>
            </div>
        </div>
        @endif


        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 pb-6 border-b pt-6 border-t">
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
                    <label class="text-xs text-gray-500">Area Penempatan</label>
                    <p class="font-medium">{{ $pengajuan->area_penempatan ?? '-' }}</p>
                </div>
                @if($pengajuan->toko_penempatan)
                <div>
                    <label class="text-xs text-gray-500">Toko Penempatan</label>
                    <p class="font-medium">{{ $pengajuan->toko_penempatan }}</p>
                </div>
                @endif
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

        <!-- CATATAN PTK -->
        <div class="mt-6 pt-4 border-t">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold">Catatan PTK</h3>
                <button onclick="openCatatanModal()" 
                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition text-sm">
                    <i class="fas fa-edit mr-2"></i> 
                    {{ $pengajuan->catatan_ptk ? 'Edit Catatan' : 'Tambah Catatan' }}
                </button>
            </div>
    
            <!-- Tampilkan Catatan -->
            @if($pengajuan->catatan_ptk)
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <div class="flex-1">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $pengajuan->catatan_ptk }}</p>
                    </div>
                    <div class="text-right text-xs text-gray-500 ml-4 flex-shrink-0">
                        @if($pengajuan->catatan_diubah_at)
                            <p><i class="fas fa-edit mr-1"></i> Catatan diubah pada</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($pengajuan->catatan_diubah_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB</p>
                            <p>oleh <strong>{{ $pengajuan->catatan_diubah_oleh }}</strong></p>
                            <p class="text-xs text-gray-400">{{ $pengajuan->catatan_jabatan_diubah }}</p>
                        @else
                            <p><i class="fas fa-plus-circle mr-1"></i> Catatan ditambahkan pada</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($pengajuan->catatan_dibuat_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB</p>
                            <p>oleh <strong>{{ $pengajuan->catatan_dibuat_oleh }}</strong></p>
                            <p class="text-xs text-gray-400">{{ $pengajuan->catatan_jabatan_dibuat }}</p>
                        @endif
                        @if($pengajuan->catatan_ptk)
                        <button onclick="if(confirm('Hapus catatan ini?')) document.getElementById('hapus-catatan-form').submit();" 
                                class="text-red-500 hover:text-red-700 text-xs mt-2">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center text-gray-400">
                <i class="fas fa-sticky-note text-2xl mb-2 block"></i>
                <p>Belum ada catatan untuk PTK ini</p>
            </div>
            @endif
        </div>

        <!-- MODAL CATATAN -->
        <div id="catatanModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900" id="catatanModalTitle">
                        {{ $pengajuan->catatan_ptk ? 'Edit Catatan' : 'Tambah Catatan' }}
                    </h3>
                    <button onclick="closeCatatanModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
        
                <form action="{{ route('management.pengajuan.catatan', $pengajuan) }}" method="POST" id="catatanForm">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                            <input type="text" name="catatan_nama" id="catatan_nama" required 
                                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary"
                                   placeholder="Masukkan nama Anda">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan <span class="text-red-500">*</span></label>
                            <input type="text" name="catatan_jabatan" id="catatan_jabatan" required 
                                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary"
                                   placeholder="Masukkan jabatan Anda">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Isi Catatan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="catatan_ptk" id="catatan_ptk" rows="5" 
                                  class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary"
                                  placeholder="Tuliskan catatan untuk PTK ini...">{{ $pengajuan->catatan_ptk ?? '' }}</textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeCatatanModal()" 
                                class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                            <i class="fas fa-save mr-2"></i> 
                            {{ $pengajuan->catatan_ptk ? 'Update Catatan' : 'Simpan Catatan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form Hapus Catatan -->
        <form id="hapus-catatan-form" action="{{ route('management.pengajuan.catatan.hapus', $pengajuan) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        @push('scripts')
        <script>
            function openCatatanModal() {
                const modal = document.getElementById('catatanModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.getElementById('catatan_ptk').focus();
            }
    
            function closeCatatanModal() {
                const modal = document.getElementById('catatanModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
    
            // Tutup modal jika klik di luar
            document.getElementById('catatanModal')?.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeCatatanModal();
                }
            });
        </script>
        @endpush
        <!-- Lampiran Dokumen -->
        @if($pengajuan->lampiran_path)
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Dokumen Pendukung</h3>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center justify-between flex-wrap gap-3">
                    <div class="flex items-center">
                        @php
                            $ext = strtolower($pengajuan->lampiran_jenis ?? pathinfo($pengajuan->lampiran_nama, PATHINFO_EXTENSION));
                        @endphp
                        @if($ext == 'pdf')
                            <i class="fas fa-file-pdf text-red-500 text-3xl mr-3"></i>
                        @elseif(in_array($ext, ['png', 'jpg', 'jpeg']))
                            <i class="fas fa-file-image text-green-500 text-3xl mr-3"></i>
                        @elseif($ext == 'docx' || $ext == 'doc')
                            <i class="fas fa-file-word text-blue-500 text-3xl mr-3"></i>
                        @else
                            <i class="fas fa-file text-gray-500 text-3xl mr-3"></i>
                        @endif
                        <div>
                            <p class="font-medium">{{ $pengajuan->lampiran_nama ?? 'Dokumen' }}</p>
                            <p class="text-xs text-gray-500">
                                {{ strtoupper($ext) }} • 
                                {{ Storage::disk('public')->exists($pengajuan->lampiran_path) ? round(Storage::disk('public')->size($pengajuan->lampiran_path) / 1024, 2) : 0 }} KB
                            </p>
                            <p class="text-xs text-gray-500">
                                Jenis: {{ $pengajuan->jenis == 'penambahan' ? 'Komitmen Target' : 'Surat Resign' }}
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="previewLampiran('{{ Storage::url($pengajuan->lampiran_path) }}', '{{ $pengajuan->lampiran_nama }}')" 
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                            <i class="fas fa-eye mr-2"></i> Preview
                        </button>
                        <a href="{{ Storage::url($pengajuan->lampiran_path) }}" download="{{ $pengajuan->lampiran_nama }}" 
                           class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition">
                            <i class="fas fa-download mr-2"></i> Download
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        
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
                    <input type="text" name="disetujui_oleh" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none" >
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
<!-- Modal Approve -->
<div id="approveModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Setujui Pengajuan</h3>
        <form action="{{ route('management.pengajuan.approve', $pengajuan) }}" method="POST" id="approveForm">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Disetujui Oleh (Nama Lengkap) <span class="text-red-500">*</span></label>
                <input type="text" name="disetujui_oleh" class="w-full border rounded-lg px-3 py-2" 
                       placeholder="Contoh: Budi Santoso, M.M." required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan Penyetuju <span class="text-red-500">*</span></label>
                <input type="text" name="jabatan_penyetuju" class="w-full border rounded-lg px-3 py-2" 
                       placeholder="Contoh: Manager Operasional" required>
                <p class="text-xs text-gray-500 mt-1">Isi dengan jabatan Anda saat ini</p>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeApproveModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Setujui</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Reject -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Tolak Pengajuan</h3>
        <form action="{{ route('management.pengajuan.reject', $pengajuan) }}" method="POST" id="rejectForm">
            @csrf
            <textarea name="alasan_penolakan" rows="4" class="w-full border rounded-lg px-3 py-2 mb-4" placeholder="Masukkan alasan penolakan..." required></textarea>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Kirim</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Preview Lampiran -->
<div id="lampiranModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg w-full max-w-4xl max-h-[90vh] overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="font-semibold text-lg" id="lampiranModalTitle">Preview Dokumen</h3>
            <button onclick="closeLampiranPreview()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-4 overflow-auto max-h-[calc(90vh-80px)]">
            <div id="lampiranPdfViewer" class="hidden">
                <embed id="lampiranPdfEmbed" src="" type="application/pdf" class="w-full min-h-[600px]">
            </div>
            <div id="lampiranImageViewer" class="hidden">
                <img id="lampiranImagePreview" src="" class="max-w-full max-h-[600px] mx-auto">
            </div>
            <div id="lampiranDocxViewer" class="hidden text-center py-10">
                <i class="fas fa-file-word text-6xl text-blue-400 mb-4"></i>
                <p class="text-gray-600">File DOCX tidak dapat ditampilkan secara langsung.</p>
                <p class="text-sm text-gray-500 mt-2">Silakan download untuk melihat isi file.</p>
                <a href="#" id="lampiranDownloadLink" download class="mt-4 inline-block bg-primary text-white px-6 py-2 rounded-lg">
                    <i class="fas fa-download mr-2"></i> Download File
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function previewLampiran(url, filename) {
        const ext = filename.split('.').pop().toLowerCase();
        document.getElementById('lampiranModalTitle').textContent = 'Preview: ' + filename;
        
        // Sembunyikan semua viewer
        document.getElementById('lampiranPdfViewer').classList.add('hidden');
        document.getElementById('lampiranImageViewer').classList.add('hidden');
        document.getElementById('lampiranDocxViewer').classList.add('hidden');
        
        if (ext === 'pdf') {
            document.getElementById('lampiranPdfViewer').classList.remove('hidden');
            document.getElementById('lampiranPdfEmbed').src = url;
        } else if (['png', 'jpg', 'jpeg'].includes(ext)) {
            document.getElementById('lampiranImageViewer').classList.remove('hidden');
            document.getElementById('lampiranImagePreview').src = url;
        } else {
            document.getElementById('lampiranDocxViewer').classList.remove('hidden');
            document.getElementById('lampiranDownloadLink').href = url;
        }
        
        document.getElementById('lampiranModal').classList.remove('hidden');
        document.getElementById('lampiranModal').classList.add('flex');
    }
    
    function closeLampiranPreview() {
        document.getElementById('lampiranModal').classList.add('hidden');
        document.getElementById('lampiranModal').classList.remove('flex');
        document.getElementById('lampiranPdfEmbed').src = '';
        document.getElementById('lampiranImagePreview').src = '';
    }
</script>
@endsection
