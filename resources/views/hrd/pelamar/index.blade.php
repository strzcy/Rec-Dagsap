@extends('layouts.app')

@section('title', 'Data Pelamar')

@section('header', 'Data Pelamar')
@section('subheader', 'Daftar semua pelamar yang melamar')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <input type="text" name="search" placeholder="Cari nama, email, atau telepon..." 
                   value="{{ request('search') }}" class="border rounded-lg px-3 py-2">
            <select name="lowongan_id" class="border rounded-lg px-3 py-2">
                <option value="">Semua Lowongan</option>
                @foreach($lowongans as $lowongan)
                <option value="{{ $lowongan->id }}" {{ request('lowongan_id') == $lowongan->id ? 'selected' : '' }}>
                    {{ $lowongan->judul }}
                </option>
                @endforeach
            </select>
            <select name="status" class="border rounded-lg px-3 py-2">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="lolos_tahap1" {{ request('status') == 'lolos_tahap1' ? 'selected' : '' }}>Lolos Tahap 1</option>
                <option value="psikotest" {{ request('status') == 'psikotest' ? 'selected' : '' }}>Psikotest</option>
                <option value="lolos_psikotest" {{ request('status') == 'lolos_psikotest' ? 'selected' : '' }}>Lolos Psikotest</option>
                <option value="interview" {{ request('status') == 'interview' ? 'selected' : '' }}>Interview</option>
                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">Filter</button>
            <a href="{{ route('hrd.pelamar.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg text-center">Reset</a>
        </form>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lowongan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kontak</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Lamar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pelamars as $index => $pelamar)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-medium">{{ $pelamar->nama_lengkap }}</td>
                    <td class="px-6 py-4">{{ $pelamar->lowongan->judul ?? '-' }}</td>
                    <td class="px-6 py-4">
                        {{ $pelamar->email }}<br>
                        <small class="text-gray-500">{{ $pelamar->no_telepon }}</small>
                    </td>
                    <td class="px-6 py-4">
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
                    <td class="px-6 py-4">{{ $pelamar->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('hrd.pelamar.show', $pelamar) }}" class="text-primary hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        Belum ada pelamar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t">
        {{ $pelamars->links() }}
    </div>
</div>
@endsection


