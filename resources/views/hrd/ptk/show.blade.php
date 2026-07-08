@extends('layouts.app')

@section('title', 'Detail PTK')

@section('header', 'Detail Permintaan Tenaga Kerja')
@section('subheader', 'Lihat detail permintaan tenaga kerja')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        <!-- Informasi Pengajuan -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 pb-6 border-b">
            <div>
                <label class="text-xs text-gray-500">No. PTK</label>
                <p class="font-medium font-mono">PTK-{{ str_pad($ptk->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Nama Pemohon</label>
                <p class="font-medium">{{ $ptk->nama_pemohon ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Departemen</label>
                <p class="font-medium">{{ $ptk->departemen->nama_divisi ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Jabatan</label>
                <p class="font-medium">{{ $ptk->jabatan_pemohon ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">NIP/NIK</label>
                <p class="font-medium">{{ $ptk->nip_pemohon ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">No. HP</label>
                <p class="font-medium">{{ $ptk->no_hp_pemohon ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Tanggal Pengajuan</label>
                <p class="font-medium">{{ $ptk->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Status</label>
                <p>
                    @if($ptk->status == 'pending')
                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                    @elseif($ptk->status == 'disetujui')
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Disetujui</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Ditolak</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b">
            <div>
                <label class="text-xs text-gray-500">Tanggal Dibutuhkan</label>
                <p class="font-medium">{{ $ptk->tanggal_dibutuhkan ? \Carbon\Carbon::parse($ptk->tanggal_dibutuhkan)->format('d/m/Y') : '-' }}</p>
            </div>
            @if($ptk->status == 'disetujui')
            <div>
                <label class="text-xs text-gray-500">Disetujui Oleh</label>
                <p class="font-medium">{{ $ptk->disetujui_oleh ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Jabatan Penyetuju</label>
                <p class="font-medium">{{ $ptk->jabatan_penyetuju ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Tanggal Disetujui</label>
                <p class="font-medium">{{ $ptk->approved_at ? \Carbon\Carbon::parse($ptk->approved_at)->format('d/m/Y H:i') : '-' }} WIB</p>
            </div>
            @endif
        </div>
        
        <!-- Detail Pekerjaan -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Detail Pekerjaan</h3>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="text-xs text-gray-500">Posisi</label>
                    <p class="font-medium">{{ $ptk->posisi }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Area Penempatan</label>
                    <p class="font-medium">{{ $ptk->area_penempatan ?? '-' }}</p>
                </div>
                @if($ptk->toko_penempatan)
                <div>
                    <label class="text-xs text-gray-500">Toko Penempatan</label>
                    <p class="font-medium">{{ $ptk->toko_penempatan }}</p>
                </div>
                @endif
                <div>
                    <label class="text-xs text-gray-500">Jumlah Dibutuhkan</label>
                    <p class="font-medium">{{ $ptk->jumlah }} orang</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Jenis Kebutuhan</label>
                    <p class="font-medium">{{ $ptk->jenis == 'penambahan' ? 'Penambahan Tenaga Kerja' : 'Penggantian Tenaga Kerja' }}</p>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="text-xs text-gray-500">Tugas dan Tanggung Jawab</label>
                <div class="mt-1 space-y-1">
                    @php
                        $tugas = is_array($ptk->tugas) ? $ptk->tugas : json_decode($ptk->tugas, true);
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
                <p class="mt-1 text-gray-700">{{ nl2br(e($ptk->deskripsi_pekerjaan)) ?: '-' }}</p>
            </div>
        </div>
        
        <!-- Spesifikasi Calon -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Spesifikasi Calon</h3>
            @php
                $kriteria = is_array($ptk->kriteria) ? $ptk->kriteria : json_decode($ptk->kriteria, true);
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
                $persyaratan = is_array($ptk->persyaratan) ? $ptk->persyaratan : json_decode($ptk->persyaratan, true);
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

        <!-- Lampiran Dokumen -->
        @if($ptk->lampiran_path && file_exists(public_path($ptk->lampiran_path)))
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Dokumen Pendukung</h3>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center justify-between flex-wrap gap-3">
                    <div class="flex items-center">
                        @php
                            $ext = strtolower($ptk->lampiran_jenis ?? pathinfo($ptk->lampiran_nama, PATHINFO_EXTENSION));
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
                            <p class="font-medium">{{ $ptk->lampiran_nama ?? 'Dokumen' }}</p>
                            <p class="text-xs text-gray-500">{{ strtoupper($ext) }}</p>
                            <p class="text-xs text-gray-500">
                                Jenis: {{ $ptk->jenis == 'penambahan' ? 'Komitmen Kerja' : 'Surat Resign' }}
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="previewLampiran('{{ asset($ptk->lampiran_path) }}', '{{ $ptk->lampiran_nama }}')" 
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                            <i class="fas fa-eye mr-2"></i> Preview
                        </button>
                        <a href="{{ asset($ptk->lampiran_path) }}" download="{{ $ptk->lampiran_nama }}" 
                           class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition">
                            <i class="fas fa-download mr-2"></i> Download
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Dokumen Pendukung</h3>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 text-center text-gray-400">
                <i class="fas fa-file fa-2x mb-2 block"></i>
                <p>Belum ada dokumen pendukung</p>
            </div>
        </div>
        @endif

        <!-- Modal Preview Lampiran (sama seperti di management) -->
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
                        <p class="text-gray-600">File tidak dapat ditampilkan secara langsung.</p>
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
        
                document.getElementById('lampiranPdfViewer').classList.add('hidden');
                document.getElementById('lampiranImageViewer').classList.add('hidden');
                document.getElementById('lampiranDocxViewer').classList.add('hidden');
        
                if (ext === 'pdf') {
                    document.getElementById('lampiranPdfViewer').classList.remove('hidden');
                    document.getElementById('lampiranPdfEmbed').src = url;
                } else if (['png', 'jpg', 'jpeg', 'gif', 'webp'].includes(ext)) {
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
    
            document.getElementById('lampiranModal')?.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeLampiranPreview();
                }
            });
        </script>

        <!-- CATATAN PTK -->
        @if($ptk->catatan_ptk)
        <div class="mt-6 pt-4 border-t">
            <h3 class="text-lg font-semibold mb-3">Catatan PTK</h3>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <div class="flex-1">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $ptk->catatan_ptk }}</p>
                    </div>
                    <div class="text-right text-xs text-gray-500 ml-4 flex-shrink-0">
                        @if($ptk->catatan_diubah_at)
                            <p>Catatan diubah pada</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($ptk->catatan_diubah_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB</p>
                            <p>oleh <strong>{{ $ptk->catatan_diubah_oleh }}</strong></p>
                            <p class="text-xs text-gray-400">{{ $ptk->catatan_jabatan_diubah }}</p>
                        @else
                            <p>Catatan ditambahkan pada</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($ptk->catatan_dibuat_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB</p>
                            <p>oleh <strong>{{ $ptk->catatan_dibuat_oleh }}</strong></p>
                            <p class="text-xs text-gray-400">{{ $ptk->catatan_jabatan_dibuat }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Tombol Kembali & Print -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
            <div>
                <a href="{{ route('hrd.ptk.index') }}"
                   class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            <div class="no-print">
                <a href="{{ route('hrd.ptk.print', $ptk) }}"
                   target="_blank"
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    <i class="fas fa-print mr-2"></i> Print PTK
                </a>
            </div>
        </div>
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