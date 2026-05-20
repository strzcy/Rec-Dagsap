@extends('layouts.app')

@section('title', 'Riwayat Pengajuan Tenaga Kerja')

@section('header', 'Riwayat Pengajuan Tenaga Kerja')
@section('subheader', 'Daftar semua permintaan tenaga kerja yang telah diajukan')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b flex justify-between items-center">
        <h2 class="text-lg font-semibold">Daftar Pengajuan</h2>
        <a href="{{ route('divisi.pengajuan.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark">
            + Pengajuan Baru
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posisi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pengajuans as $index => $pengajuan)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-medium">{{ $pengajuan->posisi }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full {{ $pengajuan->jenis == 'penambahan' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $pengajuan->jenis == 'penambahan' ? 'Penambahan' : 'Penggantian' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $pengajuan->jumlah }}</td>
                    <td class="px-6 py-4">
                        @if($pengajuan->status == 'pending')
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                        @elseif($pengajuan->status == 'disetujui')
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Disetujui</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $pengajuan->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('divisi.pengajuan.show', $pengajuan) }}" class="text-primary hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        Belum ada pengajuan. Silakan buat pengajuan baru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t">
        {{ $pengajuans->links() }}
    </div>
</div>
@endsection
