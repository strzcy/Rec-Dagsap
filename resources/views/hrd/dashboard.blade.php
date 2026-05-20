@extends('layouts.app')

@section('title', 'Dashboard HRD')

@section('header', 'Dashboard HRD')
@section('subheader', 'Selamat datang, ' . Auth::user()->name)

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
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
            <p class="text-3xl font-bold text-blue-600">{{ $totalPelamar }}</p>
            <p class="text-gray-500 text-sm">Total Pelamar</p>
        </div>
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
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Lowongan</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Tanggal Lamar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentPelamar as $pelamar)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $pelamar->nama_lengkap }}</td>
                    <td class="px-4 py-2">{{ $pelamar->lowongan->judul ?? '-' }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded-full 
                            @if($pelamar->status == 'pending') bg-gray-100 text-gray-800
                            @elseif($pelamar->status == 'lolos_tahap1') bg-blue-100 text-blue-800
                            @elseif($pelamar->status == 'psikotest') bg-yellow-100 text-yellow-800
                            @elseif($pelamar->status == 'lolos_psikotest') bg-green-100 text-green-800
                            @elseif($pelamar->status == 'interview') bg-purple-100 text-purple-800
                            @elseif($pelamar->status == 'diterima') bg-green-600 text-white
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ str_replace('_', ' ', $pelamar->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $pelamar->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection