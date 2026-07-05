@extends('layouts.app')

@section('title', 'Dashboard HRD')

@section('header', 'Dashboard HRD')
@section('subheader', 'Selamat datang, ' . Auth::user()->name)

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-center">
            <p class="text-3xl font-bold text-primary">{{ $totalLowongan }}</p>
            <p class="text-gray-500 text-sm">Total Lowongan</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-center">
            <p class="text-3xl font-bold text-green-600">{{ $activeLowongan }}</p>
            <p class="text-gray-500 text-sm">Lowongan Aktif</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-center">
            <p class="text-3xl font-bold text-yellow-600">{{ $closedLowongan }}</p>
            <p class="text-gray-500 text-sm">Lowongan Ditutup</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-center">
            <p class="text-3xl font-bold text-blue-600">{{ $totalPelamar }}</p>
            <p class="text-gray-500 text-sm">Total Pelamar</p>
        </div>
    </div>
</div>

<!-- Pengajuan yang sudah disetujui dan belum dibuat lowongan -->
@if($pendingLowongan->count() > 0)
<div class="bg-white rounded-lg shadow mb-6">
    <div class="p-4 border-b bg-yellow-50">
        <h3 class="font-semibold text-yellow-800">
            <i class="fas fa-bell mr-2"></i>
            Pengajuan yang Perlu Diposting ({{ $pendingLowongan->count() }})
        </h3>
        <p class="text-sm text-yellow-600 mt-1">Pengajuan berikut sudah disetujui management, segera buat lowongan!</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs">Divisi</th>
                    <th class="px-4 py-2 text-left text-xs">Posisi</th>
                    <th class="px-4 py-2 text-left text-xs">Jumlah</th>
                    <th class="px-4 py-2 text-left text-xs">Tanggal Dibutuhkan</th>
                    <th class="px-4 py-2 text-left text-xs">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingLowongan as $pengajuan)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $pengajuan->divisi->nama_divisi ?? '-' }}</td>
                    <td class="px-4 py-2 font-medium">{{ $pengajuan->posisi }}</td>
                    <td class="px-4 py-2">{{ $pengajuan->jumlah }} orang</td>
                    <td class="px-4 py-2">{{ $pengajuan->tanggal_dibutuhkan ? \Carbon\Carbon::parse($pengajuan->tanggal_dibutuhkan)->format('d/m/Y') : '-' }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('hrd.lowongan.create') }}?pengajuan_id={{ $pengajuan->id }}" 
                           class="bg-primary text-white px-3 py-1 rounded text-sm hover:bg-primary-dark">
                            Buat Lowongan
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="font-semibold">Lowongan Terbaru</h3>
            <a href="{{ route('hrd.lowongan.index') }}" class="text-primary text-sm">Lihat semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs">Judul</th>
                        <th class="px-4 py-2 text-left text-xs">Status</th>
                        <th class="px-4 py-2 text-left text-xs">Deadline</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentLowongan as $lowongan)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $lowongan->judul }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-xs rounded-full {{ $lowongan->status == 'publikasi' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $lowongan->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($lowongan->tanggal_selesai)->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr class="border-t">
                        <td colspan="3" class="px-4 py-4 text-center text-gray-500">Belum ada lowongan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="font-semibold">Pelamar Terbaru</h3>
            <a href="{{ route('hrd.pelamar.index') }}" class="text-primary text-sm">Lihat semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs">Nama</th>
                        <th class="px-4 py-2 text-left text-xs">Lowongan</th>
                        <th class="px-4 py-2 text-left text-xs">Organisasi</th>
                        <th class="px-4 py-2 text-left text-xs">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentPelamar as $pelamar)
                    <tr class="border-t">
                        <td class="px-4 py-2 font-medium">{{ $pelamar->nama_lengkap }}</td>
                        <td class="px-4 py-2">{{ $pelamar->lowongan->judul ?? '-' }}</td>
                        <td class="px-4 py-2">
                            @if($pelamar->detail && !empty($pelamar->detail->organisasi))
                                @php
                                    $organisasi = is_array($pelamar->detail->organisasi) ? $pelamar->detail->organisasi : json_decode($pelamar->detail->organisasi, true);
                                @endphp
                                @if(!empty($organisasi))
                                    <div class="space-y-1">
                                        @foreach($organisasi as $org)
                                            @if(is_array($org))
                                                <div class="text-xs text-gray-600">
                                                    <span class="font-medium text-gray-800">{{ $org['nama'] ?? '-' }}</span>
                                                    @if(!empty($org['jabatan'])) <span class="text-gray-500">({{ $org['jabatan'] }})</span> @endif
                                                </div>
                                            @else
                                                <div class="text-xs text-gray-600">{{ $org }}</div>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($pelamar->status == 'pending') bg-gray-100 text-gray-800
                                @elseif($pelamar->status == 'lolos_tahap1') bg-blue-100 text-blue-800
                                @elseif($pelamar->status == 'lolos_psikotest') bg-green-100 text-green-800
                                @elseif($pelamar->status == 'diterima') bg-green-600 text-white
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ str_replace('_', ' ', $pelamar->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr class="border-t">
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">Belum ada pelamar</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection