@extends('layouts.app')

@section('title', 'Approval Pengajuan Tenaga Kerja')

@section('header', 'Approval Pengajuan Tenaga Kerja')
@section('subheader', 'Review dan approve permintaan tenaga kerja dari divisi')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b">
        <form method="GET" class="flex gap-2">
            <select name="status" class="border rounded-lg px-3 py-2">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">Filter</button>
        </form>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Divisi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posisi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pengaju</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pengajuans as $index => $pengajuan)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">{{ $pengajuan->divisi->nama_divisi ?? '-' }}</td>
                    <td class="px-6 py-4 font-medium">{{ $pengajuan->posisi }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full {{ $pengajuan->jenis == 'penambahan' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $pengajuan->jenis == 'penambahan' ? 'Penambahan' : 'Penggantian' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $pengajuan->jumlah }}</td>
                    <td class="px-6 py-4">{{ $pengajuan->user->name ?? '-' }}</td>
                    <td class="px-6 py-4">
                        @if($pengajuan->status == 'pending')
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        @elseif($pengajuan->status == 'disetujui')
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Disetujui</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('management.pengajuan.show', $pengajuan) }}" class="text-primary hover:underline">Review</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        Tidak ada data pengajuan.
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