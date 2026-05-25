@extends('layouts.app')

@section('title', 'Detail Pengajuan')

@section('header', 'Detail Pengajuan Tenaga Kerja')
@section('subheader', 'Lihat detail permintaan tenaga kerja')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        <!-- Status Banner -->
        <div class="mb-6 p-4 rounded-lg {{ $pengajuan->status == 'pending' ? 'bg-yellow-50 border border-yellow-200' : ($pengajuan->status == 'disetujui' ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200') }}">
            <div class="flex items-center justify-between flex-wrap">
                <div>
                    <span class="font-semibold">Status: </span>
                    @if($pengajuan->status == 'pending')
                        <span class="text-yellow-700">Menunggu Approval</span>
                    @elseif($pengajuan->status == 'disetujui')
                        <span class="text-green-700">Disetujui pada {{ $pengajuan->approved_at ? \Carbon\Carbon::parse($pengajuan->approved_at)->format('d/m/Y H:i') : '-' }}</span>
                    @else
                        <span class="text-red-700">Ditolak</span>
                    @endif
                </div>
                @if($pengajuan->status == 'ditolak' && $pengajuan->alasan_penolakan)
                    <div class="text-sm text-red-600 mt-2 md:mt-0">
                        <strong>Alasan:</strong> {{ $pengajuan->alasan_penolakan }}
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
                <p class="font-medium">{{ $pengajuan->user->name ?? '-' }} ({{ $pengajuan->user->username ?? '-' }})</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Tanggal Pengajuan</label>
                <p class="font-medium">{{ $pengajuan->created_at->format('d/m/Y H:i') }}</p>
            </div>
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
            <button onclick="openRejectModal()" class="px-6 py-2 border border-red-500 text-red-500 rounded-lg hover:bg-red-50">
                <i class="fas fa-times mr-2"></i> Tolak
            </button>
            <button onclick="openApproveModal()" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                <i class="fas fa-check mr-2"></i> Setujui
            </button>
        </div>

        <!-- Modal Approve -->
        <div id="approveModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold mb-4">Setujui Pengajuan</h3>
                <form action="{{ route('management.pengajuan.approve', $pengajuan) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Disetujui Oleh (Nama Lengkap) *</label>
                        <input type="text" name="disetujui_oleh" class="w-full border rounded-lg px-3 py-2" 
                               placeholder="Contoh: Budi Santoso, M.M." required>
                        <p class="text-xs text-gray-500 mt-1">Isi dengan nama lengkap yang menyetujui</p>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeApproveModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Setujui</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
        
        <!-- Tombol Ingatkan HRD - HANYA TAMPIL JIKA STATUS SUDAH DISETUJUI -->
        @if($pengajuan->status == 'disetujui')
        <div class="mt-4 pt-4 border-t">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center justify-between flex-wrap gap-3">
                    <div>
                        <i class="fas fa-bell text-blue-600 text-xl mr-2"></i>
                        <span class="font-medium text-blue-800">Pengajuan sudah disetujui!</span>
                        <p class="text-sm text-blue-600 mt-1">Ingatkan HRD untuk segera memposting lowongan ini.</p>
                    </div>
                    @php
                        $hrd = \App\Models\User::where('role', 'hrd')->first();
                        $tanggalDibutuhkan = $pengajuan->tanggal_dibutuhkan ? date('d/m/Y', strtotime($pengajuan->tanggal_dibutuhkan)) : 'secepatnya';
                        $pesan = "Permisi kami dari Management " . $pengajuan->divisi->nama_divisi . 
                                 " ingin memberi tahu bahwa kami membutuhkan tenaga kerja untuk bagian " . $pengajuan->posisi . 
                                 " dengan total " . $pengajuan->jumlah . " unit kerja, " .
                                 "dibutuhkan pada tanggal " . $tanggalDibutuhkan . ". " .
                                 "Mohon segera untuk memposting Lowongan Kerjanya ya, Terimakasih";
                        $encodedPesan = urlencode($pesan);
                        $noHrd = $hrd->no_telepon ?? '6281294491075';
                        // Pastikan format 62, bukan 08
                        if (substr($noHrd, 0, 1) == '0') {
                            $noHrd = '62' . substr($noHrd, 1);
                        }
                    @endphp
                    <a href="https://api.whatsapp.com/send?phone={{ $noHrd }}&text={{ $encodedPesan }}" 
                       target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        <i class="fab fa-whatsapp mr-2"></i>
                        Ingatkan HRD via WhatsApp
                    </a>
                </div>
            </div>
        </div>
        @endif
        
        <div class="flex justify-end pt-4">
            <a href="{{ route('management.pengajuan.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
</div>

<!-- Modal Reject -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Tolak Pengajuan</h3>
        <form action="{{ route('management.pengajuan.reject', $pengajuan) }}" method="POST">
            @csrf
            <textarea name="alasan_penolakan" rows="4" class="w-full border rounded-lg px-3 py-2 mb-4" placeholder="Masukkan alasan penolakan..." required></textarea>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Kirim</button>
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
    
    document.getElementById('rejectModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeRejectModal();
        }
    }

    function openApproveModal() {
        document.getElementById('approveModal').classList.remove('hidden');
        document.getElementById('approveModal').classList.add('flex');
    }

    function closeApproveModal() {
        document.getElementById('approveModal').classList.add('hidden');
        document.getElementById('approveModal').classList.remove('flex');
    }

    document.getElementById('approveModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeApproveModal();
        }
    });
    
    );
</script>
@endpush
@endsection