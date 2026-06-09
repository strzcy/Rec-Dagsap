@extends('layouts.app')

@section('title', $lowongan->judul)

@section('header', 'Detail Lowongan')
@section('subheader', $lowongan->judul)

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        @if($lowongan->banner_image)
        <div class="mb-6">
            <img src="{{ Storage::url($lowongan->banner_image) }}" alt="Banner" class="w-full rounded-lg max-h-64 object-cover">
        </div>
        @endif
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 pb-6 border-b">
            <div>
                <label class="text-xs text-gray-500">Divisi</label>
                <p class="font-medium">{{ $lowongan->pengajuan->divisi->nama_divisi ?? '-' }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Status</label>
                <p>
                    <span class="px-2 py-1 text-xs rounded-full {{ $lowongan->status == 'publikasi' ? 'bg-green-100 text-green-800' : ($lowongan->status == 'draft' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800') }}">
                        {{ $lowongan->status }}
                    </span>
                </p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Tanggal Mulai</label>
                <p class="font-medium">{{ \Carbon\Carbon::parse($lowongan->tanggal_mulai)->format('d/m/Y') }}</p>
            </div>
            <div>
                <label class="text-xs text-gray-500">Tanggal Selesai</label>
                <p class="font-medium">{{ \Carbon\Carbon::parse($lowongan->tanggal_selesai)->format('d/m/Y') }}</p>
            </div>
        </div>
        
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Deskripsi Lowongan</h3>
            <div class="prose max-w-none">
                {!! nl2br(e($lowongan->deskripsi)) !!}
            </div>
        </div>
        
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Kriteria dari Pengajuan</h3>
            @php
                $kriteria = is_array($lowongan->pengajuan->kriteria) ? $lowongan->pengajuan->kriteria : json_decode($lowongan->pengajuan->kriteria, true);
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
                <div>
                    <label class="text-xs text-gray-500">Pendidikan Minimal</label>
                    <p>{{ $kriteria['pendidikan'] ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Jurusan</label>
                    <p>{{ $kriteria['jurusan'] ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Pengalaman Minimal</label>
                    <p>{{ $kriteria['pengalaman'] ?? '0' }} tahun</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">IPK Minimal</label>
                    <p>{{ $kriteria['ipk'] ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="text-xs text-gray-500">Keahlian</label>
                    <p>{{ $kriteria['keahlian'] ?? '-' }}</p>
                </div>
            </div>
        </div>
        
        <!-- Informasi Tambahan dari Pengajuan -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Informasi Pengajuan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
                <div>
                    <label class="text-xs text-gray-500">Nama Pemohon</label>
                    <p>{{ $lowongan->pengajuan->nama_pemohon ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">NIP/NIK Pemohon</label>
                    <p>{{ $lowongan->pengajuan->nip_pemohon ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Jabatan Pemohon</label>
                    <p>{{ $lowongan->pengajuan->jabatan_pemohon ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">No. HP Pemohon</label>
                    <p>{{ $lowongan->pengajuan->no_hp_pemohon ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Tanggal Dibutuhkan</label>
                    <p class="font-medium text-red-600">{{ $lowongan->pengajuan->tanggal_dibutuhkan ? \Carbon\Carbon::parse($lowongan->pengajuan->tanggal_dibutuhkan)->format('d/m/Y') : '-' }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Disetujui Oleh</label>
                    <p>{{ $lowongan->pengajuan->disetujui_oleh ?? '-' }}</p>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('hrd.lowongan.print', $lowongan) }}" target="_blank" 
               class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                <i class="fas fa-print mr-2"></i> Print PTK
            </a>
            <a href="{{ route('hrd.lowongan.edit', $lowongan) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                Edit
            </a>
            <a href="{{ route('hrd.lowongan.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                Kembali
            </a>
        </div>  
    </div>
</div>
@endsection