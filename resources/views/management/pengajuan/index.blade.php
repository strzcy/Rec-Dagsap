<td class="px-6 py-4">
    <div class="flex space-x-2">
        <a href="{{ route('management.pengajuan.show', $pengajuan) }}" class="text-primary hover:underline">
            @if($pengajuan->status == 'pending')
                <i class="fas fa-check-circle mr-1"></i> Review
            @else
                <i class="fas fa-eye mr-1"></i> Detail
            @endif
        </a>
        @if($pengajuan->status == 'disetujui')
            @php
                $hrd = \App\Models\User::where('role', 'hrd')->first();
                $pesan = "Permisi kami dari Management " . $pengajuan->divisi->nama_divisi . 
                         " ingin memberi tahu bahwa pada tanggal " . date('d/m/Y H:i', strtotime($pengajuan->approved_at ?? now())) . 
                         " kami membutuhkan tenaga kerja untuk bagian " . $pengajuan->posisi . 
                         " dengan total " . $pengajuan->jumlah . " unit kerja, " .
                         "mohon segera untuk memposting Lowongan Kerjanya ya, Terimakasih";
                $encodedPesan = urlencode($pesan);
                $noHrd = $hrd->no_telepon ?? '6281294491075';
            @endphp
            <a href="https://api.whatsapp.com/send?phone={{ $noHrd }}&text={{ $encodedPesan }}" 
               target="_blank"
               class="text-green-600 hover:text-green-800"
               title="Ingatkan HRD">
                <i class="fab fa-whatsapp text-lg"></i>
            </a>
        @endif
    </div>
</td>