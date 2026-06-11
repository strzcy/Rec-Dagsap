@extends('layouts.app')

@section('title', 'Approval Pengajuan Tenaga Kerja')

@section('header', 'Approval Pengajuan Tenaga Kerja')
@section('subheader', 'Review dan approve permintaan tenaga kerja dari divisi ' . ($divisi->nama_divisi ?? 'Anda'))

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">  
    <div class="p-4 border-b">
        <form method="GET" class="flex gap-2 flex-wrap">
            <select name="status" class="border rounded-lg px-3 py-2">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">Filter</button>
            @if(request('status'))
            <a href="{{ route('management.pengajuan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Reset</a>
            @endif
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
                @forelse($pengajuans as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                            {{ $item->divisi->nama_divisi ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium">{{ $item->posisi }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full {{ $item->jenis == 'penambahan' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $item->jenis == 'penambahan' ? 'Penambahan' : 'Penggantian' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $item->jumlah }}</td>
                    <td class="px-6 py-4">{{ $item->user->name ?? '-' }} ({{ $item->user->username ?? '-' }})</td>
                    <td class="px-6 py-4">
                        @if($item->status == 'pending')
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                        @elseif($item->status == 'disetujui')
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Disetujui</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('management.pengajuan.show', $item) }}" class="text-primary hover:underline">
                                @if($item->status == 'pending')
                                    <i class="fas fa-check-circle mr-1"></i> Review
                                @else
                                    <i class="fas fa-eye mr-1"></i> Detail
                                @endif
                            </a>
                            @if($item->status == 'disetujui')
                                @php
                                    $hrd = \App\Models\User::where('role', 'hrd')->first();
                                    $tanggalDibutuhkan = $item->tanggal_dibutuhkan ? date('d/m/Y', strtotime($item->tanggal_dibutuhkan)) : 'secepatnya';
                                    $pesan = "Permisi kami dari Departemen " . $item->divisi->nama_divisi . 
                                             " ingin memberi tahu bahwa kami membutuhkan tenaga kerja untuk bagian " . $item->posisi . 
                                             " dengan total " . $item->jumlah . " unit kerja, " .
                                             "dibutuhkan pada tanggal " . $tanggalDibutuhkan . ". " .
                                             "Mohon segera untuk memposting Lowongan Kerjanya ya, Terimakasih";
                                    $encodedPesan = urlencode($pesan);
                                    $noHrd = $hrd->no_telepon ?? '6281294491075';
                                    // Pastikan format 62, bukan 08
                                    if (substr($noHrd, 0, 1) == '0') {
                                        $noHrd = '62' . substr($noHrd, 1);
                                    }
                                @endphp
                                <a href="https://api.whatsapp.com/send?phone={{ $noHrd }}&text={{ $encodedPesan }}" 
                                   target="_blank"
                                   class="text-green-600 hover:text-green-800 ml-2"
                                   title="Ingatkan HRD">
                                    <i class="fab fa-whatsapp text-lg"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2 block"></i>
                        Tidak ada pengajuan dari divisi {{ $divisi->nama_divisi ?? '' }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($pengajuans->hasPages())
    <div class="p-4 border-t">
        {{ $pengajuans->links() }}
    </div>
    @endif
</div>
@endsection