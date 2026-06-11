@extends('layouts.app')

@section('title', 'Data PTK')

@section('header', 'Data Permintaan Tenaga Kerja')
@section('subheader', 'Semua pengajuan PTK dari berbagai divisi')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b">
        <form method="GET" class="flex gap-3 flex-wrap">
            <select name="status" class="border rounded-lg px-3 py-2">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            
            <select name="divisi" class="border rounded-lg px-3 py-2">
                <option value="">Semua Divisi</option>
                @foreach($divisis as $divisi)
                    <option value="{{ $divisi->id }}" {{ request('divisi') == $divisi->id ? 'selected' : '' }}>
                        {{ $divisi->nama_divisi }}
                    </option>
                @endforeach
            </select>
            
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">Filter</button>
            <a href="{{ route('hrd.ptk.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Reset</a>
        </form>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. PTK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Divisi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posisi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemohon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($ptkList as $index => $ptk)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $index + $ptkList->firstItem() }}</td>
                    <td class="px-6 py-4 font-mono text-sm">PTK-{{ str_pad($ptk->id, 6, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-6 py-4">{{ $ptk->departemen->nama_divisi ?? '-' }}</td>
                    <td class="px-6 py-4 font-medium">{{ $ptk->posisi }}</td>
                    <td class="px-6 py-4">{{ $ptk->jumlah }}</td>
                    <td class="px-6 py-4">{{ $ptk->nama_pemohon ?? '-' }}</td>
                    <td class="px-6 py-4">
                        @if($ptk->status == 'pending')
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        @elseif($ptk->status == 'disetujui')
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Disetujui</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $ptk->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('hrd.ptk.show', $ptk) }}" class="text-primary hover:underline">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data PTK
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t">
        {{ $ptkList->links() }}
    </div>
</div>
@endsection