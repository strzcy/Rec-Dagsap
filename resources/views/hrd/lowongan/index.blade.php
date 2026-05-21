@extends('layouts.app')

@section('title', 'Kelola Lowongan')

@section('header', 'Kelola Lowongan')
@section('subheader', 'Daftar semua lowongan pekerjaan')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b flex justify-between items-center flex-wrap gap-2">
        <h2 class="text-lg font-semibold">Daftar Lowongan</h2>
        <a href="{{ route('hrd.lowongan.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark">
            + Lowongan Baru
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Divisi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($lowongans as $index => $lowongan)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-medium">{{ $lowongan->judul }}</td>
                    <td class="px-6 py-4">{{ $lowongan->pengajuan->divisi->nama_divisi ?? '-' }}</td>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($lowongan->tanggal_mulai)->format('d/m/Y') }} - 
                        {{ \Carbon\Carbon::parse($lowongan->tanggal_selesai)->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full {{ $lowongan->status == 'publikasi' ? 'bg-green-100 text-green-800' : ($lowongan->status == 'draft' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800') }}">
                            {{ $lowongan->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('hrd.lowongan.show', $lowongan) }}" class="text-primary hover:underline">Detail</a>
                        <a href="{{ route('hrd.lowongan.edit', $lowongan) }}" class="text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('hrd.lowongan.destroy', $lowongan) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus lowongan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        Belum ada lowongan. Silakan buat lowongan baru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t">
        {{ $lowongans->links() }}
    </div>
</div>
@endsection