@extends('layouts.app')

@section('title', 'Dashboard Departemen')

@section('header', 'Dashboard Departemen')
@section('subheader', 'Selamat datang, ' . Auth::user()->name)

@section('content')
@if(isset($error))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
    {{ $error }}
</div>
@else
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-center">
            <p class="text-3xl font-bold text-primary">{{ $totalPengajuan }}</p>
            <p class="text-gray-500 text-sm">Total Pengajuan</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-center">
            <p class="text-3xl font-bold text-yellow-600">{{ $pendingPengajuan }}</p>
            <p class="text-gray-500 text-sm">Perlu Disetujui</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-center">
            <p class="text-3xl font-bold text-green-600">{{ $approvedPengajuan }}</p>
            <p class="text-gray-500 text-sm">Disetujui</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-center">
            <p class="text-3xl font-bold text-red-600">{{ $rejectedPengajuan }}</p>
            <p class="text-gray-500 text-sm">Ditolak</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b">
        <h3 class="font-semibold">Pengajuan Terbaru - Divisi {{ $divisi->nama_divisi ?? '' }}</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs">Posisi</th>
                    <th class="px-4 py-2 text-left text-xs">Jenis</th>
                    <th class="px-4 py-2 text-left text-xs">Status</th>
                    <th class="px-4 py-2 text-left text-xs">Pemohon</th>
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
                    <td class="px-4 py-2">{{ $pengajuan->nama_pemohon ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $pengajuan->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('management.pengajuan.show', $pengajuan) }}" class="text-primary hover:underline">
                            @if($pengajuan->status == 'pending')
                                Review
                            @else
                                Lihat
                            @endif
                        </a>
                    </td>
                </tr>
                @empty
                <tr class="border-t">
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2 block"></i>
                        Belum ada pengajuan dari divisi {{ $divisi->nama_divisi ?? '' }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pendingPengajuan > 0)
    <div class="p-4 border-t">
        <a href="{{ route('management.pengajuan.index') }}?status=pending" class="text-primary hover:underline">
            Lihat semua pengajuan yang perlu disetujui →
        </a>
    </div>
    @endif
</div>
@endif
@endsection