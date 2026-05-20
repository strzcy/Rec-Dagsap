@extends('layouts.app')

@section('title', 'Dashboard Management')

@section('header', 'Dashboard Management')
@section('subheader', 'Selamat datang, ' . Auth::user()->name)

@section('content')
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
            <p class="text-gray-500 text-sm">Pending</p>
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
        <h3 class="font-semibold">Pengajuan Terbaru Perlu Review</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">Divisi</th>
                    <th class="px-4 py-2 text-left">Posisi</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentPengajuan as $pengajuan)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $pengajuan->divisi->nama_divisi ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $pengajuan->posisi }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded-full {{ $pengajuan->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($pengajuan->status == 'disetujui' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                            {{ $pengajuan->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('management.pengajuan.show', $pengajuan) }}" class="text-primary hover:underline">Review</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection