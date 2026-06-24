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
@endsection