@extends('layouts.app')

@section('title', 'Dashboard Divisi')

@section('header', 'Dashboard Divisi')
@section('subheader', 'Selamat datang, ' . Auth::user()->name)

@section('content')
<div class="stats-grid mb-6" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <p class="text-3xl font-bold text-primary">{{ $totalPengajuan }}</p>
        <p class="text-gray-500 text-sm">Total Pengajuan</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <p class="text-3xl font-bold text-yellow-600">{{ $pendingPengajuan }}</p>
        <p class="text-gray-500 text-sm">Menunggu Approval</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <p class="text-3xl font-bold text-green-600">{{ $approvedPengajuan }}</p>
        <p class="text-gray-500 text-sm">Disetujui</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <p class="text-3xl font-bold text-red-600">{{ $rejectedPengajuan }}</p>
        <p class="text-gray-500 text-sm">Ditolak</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b">
        <h3 class="font-semibold">Pengajuan Terbaru</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs">Posisi</th>
                    <th class="px-4 py-2 text-left text-xs">Jenis</th>
                    <th class="px-4 py-2 text-left text-xs">Status</th>
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
                    <td class="px-4 py-2">{{ $pengajuan->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('divisi.pengajuan.show', $pengajuan) }}" class="text-primary hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr class="border-t">
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">Belum ada pengajuan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t">
        <a href="{{ route('divisi.pengajuan.create') }}" class="text-primary hover:underline">+ Buat Pengajuan Baru</a>
    </div>
</div>
@endsection