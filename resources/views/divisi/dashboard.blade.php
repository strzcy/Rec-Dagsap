@extends('layouts.app')

@section('title', 'Dashboard Divisi')

@section('header', 'Dashboard Divisi')
@section('subheader', 'Selamat datang, ' . Auth::user()->name)

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-full">
                <i class="fas fa-file-alt text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Total Pengajuan</p>
                <p class="text-2xl font-bold">{{ $totalPengajuan }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-yellow-100 rounded-full">
                <i class="fas fa-clock text-yellow-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Menunggu Approval</p>
                <p class="text-2xl font-bold">{{ $pendingPengajuan }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-full">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Disetujui</p>
                <p class="text-2xl font-bold">{{ $approvedPengajuan }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-red-100 rounded-full">
                <i class="fas fa-times-circle text-red-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Ditolak</p>
                <p class="text-2xl font-bold">{{ $rejectedPengajuan }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
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
                    </tr>
                    @empty
                    <tr class="border-t">
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">Belum ada pengajuan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t">
            <a href="{{ route('divisi.pengajuan.create') }}" class="text-primary hover:underline">+ Buat Pengajuan Baru</a>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b">
            <h3 class="font-semibold">Lowongan Aktif</h3>
        </div>
        <div class="p-6 text-center">
            <div class="text-4xl font-bold text-primary mb-2">{{ $activeLowongan }}</div>
            <p class="text-gray-500">Lowongan sedang berjalan</p>
        </div>
    </div>
</div>
@endsection