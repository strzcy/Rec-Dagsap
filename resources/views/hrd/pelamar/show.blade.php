@extends('layouts.app')

@section('title', 'Detail Pelamar')

@section('header', 'Detail Pelamar')
@section('subheader', 'Informasi lengkap pelamar')

@push('styles')
<style>
    @media print {
        .no-print { display: none !important; }
        body { background: white; padding: 20px; }
        .bg-white { background: white !important; box-shadow: none !important; }
        .shadow { box-shadow: none !important; }
        .rounded-lg { border-radius: 0 !important; }
    }
    .detail-section {
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
    }
    .detail-section h4 {
        color: #424862;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }
</style>
@endpush

@section('content')
<!-- Tombol Print -->
<div class="flex justify-end mb-4 no-print">
    <button onclick="window.print()" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark">
        <i class="fas fa-print mr-2"></i> Print / Cetak Data Pelamar
    </button>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Informasi Pelamar Ringkas -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Data Diri Ringkas</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="text-xs text-gray-500">Nama Lengkap</label><p class="font-medium">{{ $pelamar->nama_lengkap }}</p></div>
                    <div><label class="text-xs text-gray-500">Email</label><p class="font-medium">{{ $pelamar->email }}</p></div>
                    <div><label class="text-xs text-gray-500">No Telepon/WA</label><p class="font-medium">{{ $pelamar->no_telepon }}</p></div>
                    <div><label class="text-xs text-gray-500">Tempat, Tanggal Lahir</label><p class="font-medium">{{ $pelamar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pelamar->tanggal_lahir)->format('d/m/Y') }}</p></div>
                    <div class="md:col-span-2"><label class="text-xs text-gray-500">Alamat</label><p class="font-medium">{{ $pelamar->alamat }}</p></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Status Lamaran -->
    <div>
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Status Lamaran</h3>
            </div>
            <div class="p-6">
                <span class="px-3 py-1 rounded-full text-sm 
                    @if($pelamar->status == 'pending') bg-gray-100 text-gray-800
                    @elseif($pelamar->status == 'lolos_tahap1') bg-blue-100 text-blue-800
                    @elseif($pelamar->status == 'lolos_psikotest') bg-green-100 text-green-800
                    @elseif($pelamar->status == 'diterima') bg-green-600 text-white
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ str_replace('_', ' ', ucfirst($pelamar->status)) }}
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Data Lengkap dari DetailPelamar -->
@if($pelamar->detail)
<div class="bg-white rounded-lg shadow mt-6">
    <div class="p-4 border-b bg-primary text-white">
        <h3 class="font-semibold text-lg">Data Lengkap Pelamar (Formulir A-L)</h3>
    </div>
    <div class="p-6">
        @php $detail = $pelamar->detail; @endphp
        
        <!-- A. DATA PRIBADI -->
        <div class="detail-section">
            <h4>A. DATA PRIBADI</h4>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-sm">
                <div><strong>Nama Lengkap:</strong> {{ $detail->nama_lengkap ?? '-' }}</div>
                <div><strong>Jenis Kelamin:</strong> {{ $detail->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                <div><strong>Tempat/Tgl Lahir:</strong> {{ $detail->tempat_lahir ?? '-' }}, {{ $detail->tanggal_lahir ? \Carbon\Carbon::parse($detail->tanggal_lahir)->format('d/m/Y') : '-' }}</div>
                <div><strong>Tinggi/Berat:</strong> {{ $detail->tinggi_badan ?? '-' }} cm / {{ $detail->berat_badan ?? '-' }} kg</div>
                <div><strong>Agama:</strong> {{ $detail->agama ?? '-' }}</div>
                <div><strong>Golongan Darah:</strong> {{ $detail->golongan_darah ?? '-' }}</div>
                <div><strong>Status Perkawinan:</strong> {{ $detail->status_perkawinan ?? '-' }}</div>
                <div><strong>No. KTP:</strong> {{ $detail->no_ktp ?? '-' }}</div>
                <div><strong>No. HP:</strong> {{ $detail->no_hp ?? '-' }}</div>
                <div><strong>Email:</strong> {{ $detail->email ?? '-' }}</div>
                <div><strong>Hobby:</strong> {{ $detail->hobby ?? '-' }}</div>
                <div class="col-span-2"><strong>Alamat Tinggal:</strong> {{ $detail->alamat_tinggal ?? '-' }}</div>
                <div class="col-span-2"><strong>Alamat KTP:</strong> {{ $detail->alamat_ktp ?? '-' }}</div>
            </div>
        </div>
        
        <!-- B. PENDIDIKAN -->
        <div class="detail-section">
            <h4>B. RIWAYAT PENDIDIKAN</h4>
            @if($detail->pendidikan_formal)
            <div class="overflow-x-auto mb-3">
                <table class="min-w-full text-sm border">
                    <thead class="bg-gray-50"><tr><th class="px-2 py-1 border">Tingkat</th><th class="px-2 py-1 border">Sekolah</th><th class="px-2 py-1 border">Jurusan</th><th class="px-2 py-1 border">Tahun Lulus</th><th class="px-2 py-1 border">IPK</th></tr></thead>
                    <tbody>
                        @foreach($detail->pendidikan_formal as $pend)
                        <tr><td class="px-2 py-1 border">{{ $pend['tingkat'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $pend['nama_sekolah'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $pend['jurusan'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $pend['tahun_lulus'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $pend['ipk'] ?? '-' }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            
            @if($detail->pelatihan)
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border">
                    <thead class="bg-gray-50"><tr><th class="px-2 py-1 border">Pelatihan</th><th class="px-2 py-1 border">Lembaga</th><th class="px-2 py-1 border">Tahun</th><th class="px-2 py-1 border">Sertifikat</th></tr></thead>
                    <tbody>
                        @foreach($detail->pelatihan as $latih)
                        <tr><td class="px-2 py-1 border">{{ $latih['nama'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $latih['lembaga'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $latih['tgl_selesai'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $latih['sertifikat'] ?? '-' }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
        
        <!-- C. KETERAMPILAN & D. BAHASA -->
        <div class="detail-section">
            <h4>C. KETERAMPILAN &amp; D. BAHASA ASING</h4>
            @if($detail->keterampilan)
            <div class="mb-2"><strong>Keterampilan:</strong>
                @foreach($detail->keterampilan as $skill)
                <span class="inline-block bg-gray-100 px-2 py-1 rounded text-sm mr-1">{{ $skill['nama'] ?? '-' }} ({{ $skill['tingkat'] ?? '-' }})</span>
                @endforeach
            </div>
            @endif
            @if($detail->bahasa_asing)
            <div><strong>Bahasa Asing:</strong>
                @foreach($detail->bahasa_asing as $bhs)
                <span class="inline-block bg-gray-100 px-2 py-1 rounded text-sm mr-1">{{ $bhs['nama'] ?? '-' }} (Baca:{{ $bhs['membaca'] ?? '-' }}/Bicara:{{ $bhs['berbicara'] ?? '-' }}/Tulis:{{ $bhs['menulis'] ?? '-' }})</span>
                @endforeach
            </div>
            @endif
        </div>
        
        <!-- E. KEKUATAN & KELEMAHAN -->
        <div class="detail-section">
            <h4>E. KEKUATAN &amp; KELEMAHAN</h4>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div><strong>Kekuatan:</strong> {{ $detail->kekuatan ?? '-' }}</div>
                <div><strong>Kelemahan:</strong> {{ $detail->kelemahan ?? '-' }}</div>
            </div>
        </div>
        
        <!-- F. RIWAYAT PEKERJAAN -->
        <div class="detail-section">
            <h4>F. RIWAYAT PEKERJAAN</h4>
            @if($detail->pengalaman_kerja)
            <div class="overflow-x-auto mb-2">
                <table class="min-w-full text-sm border">
                    <thead class="bg-gray-50"><tr><th class="px-2 py-1 border">Perusahaan</th><th class="px-2 py-1 border">Jabatan</th><th class="px-2 py-1 border">Periode</th><th class="px-2 py-1 border">Gaji</th><th class="px-2 py-1 border">Alasan Keluar</th></tr></thead>
                    <tbody>
                        @foreach($detail->pengalaman_kerja as $kerja)
                        <tr><td class="px-2 py-1 border">{{ $kerja['perusahaan'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $kerja['jabatan'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $kerja['tgl_masuk'] ?? '-' }} s/d {{ $kerja['tgl_keluar'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $kerja['gaji'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $kerja['alasan_keluar'] ?? '-' }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            @if($detail->bidang_minat)
            <div><strong>Bidang Minat:</strong> {{ implode(', ', $detail->bidang_minat) }}</div>
            @endif
        </div>
        
        <!-- G. REFERENSI -->
        <div class="detail-section">
            <h4>G. REFERENSI</h4>
            @if($detail->referensi)
            <div class="overflow-x-auto mb-2">
                <table class="min-w-full text-sm border">
                    <thead class="bg-gray-50"><tr><th class="px-2 py-1 border">Nama</th><th class="px-2 py-1 border">Alamat</th><th class="px-2 py-1 border">No. Telp</th><th class="px-2 py-1 border">Hubungan</th><th class="px-2 py-1 border">Lama Kenal</th></tr></thead>
                    <tbody>
                        @foreach($detail->referensi as $ref)
                        <tr><td class="px-2 py-1 border">{{ $ref['nama'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $ref['alamat'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $ref['telp'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $ref['hubungan'] ?? '-' }}</td><td class="px-2 py-1 border">{{ $ref['lama_kenal'] ?? '-' }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            <div><strong>Punya Saudara di Perusahaan:</strong> {{ $detail->punya_saudara_di_perusahaan ? 'Ya' : 'Tidak' }}</div>
        </div>
        
        <!-- H. RIWAYAT KESEHATAN -->
        <div class="detail-section">
            <h4>H. RIWAYAT KESEHATAN</h4>
            <div class="grid grid-cols-1 gap-2 text-sm">
                <div><strong>Pernah Sakit Berat:</strong> {{ $detail->pernah_sakit_berat ? 'Ya' : 'Tidak' }} @if($detail->sakit_berat_keterangan) - {{ $detail->sakit_berat_keterangan }} @endif</div>
                <div><strong>Penyakit Keturunan:</strong> {{ $detail->punya_penyakit_keturunan ? 'Ya' : 'Tidak' }} @if($detail->penyakit_keturunan_keterangan) - {{ $detail->penyakit_keturunan_keterangan }} @endif</div>
                <div><strong>Pakai Kacamata:</strong> {{ $detail->pakai_kacamata ? 'Ya' : 'Tidak' }} @if($detail->ukuran_kacamata) - {{ $detail->ukuran_kacamata }} @endif</div>
                <div><strong>Punya Alergi:</strong> {{ $detail->punya_alergi ? 'Ya' : 'Tidak' }} @if($detail->alergi_keterangan) - {{ $detail->alergi_keterangan }} @endif</div>
            </div>
        </div>
        
        <!-- I. DATA KELUARGA -->
        <div class="detail-section">
            <h4>I. DATA KELUARGA</h4>
            @if($detail->data_pasangan)
            <div class="mb-2"><strong>Pasangan:</strong> {{ json_encode($detail->data_pasangan) }}</div>
            @endif
            @if($detail->data_orang_tua)
            <div class="mb-2"><strong>Orang Tua:</strong> {{ json_encode($detail->data_orang_tua) }}</div>
            @endif
        </div>
        
        <!-- J. REMUNERASI & K. WAKTU & L. PERNYATAAN -->
        <div class="detail-section">
            <h4>J. REMUNERASI, K. WAKTU, L. PERNYATAAN</h4>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div><strong>Gaji Diharapkan:</strong> {{ $detail->gaji_diharapkan ?? '-' }}</div>
                <div><strong>Waktu Bergabung:</strong> {{ $detail->waktu_bergabung ?? '-' }}</div>
                <div><strong>Pernyataan Setuju:</strong> {{ $detail->pernyataan_setuju ? 'Ya' : 'Tidak' }}</div>
                <div><strong>Tempat/Tgl Pernyataan:</strong> {{ $detail->tempat_pernyataan ?? '-' }}, {{ $detail->tanggal_pernyataan ? \Carbon\Carbon::parse($detail->tanggal_pernyataan)->format('d/m/Y') : '-' }}</div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Status Update & Jadwal Interview (sama seperti sebelumnya) -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6 no-print">
    <!-- Update Status -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b">
            <h3 class="font-semibold text-lg">Update Status</h3>
        </div>
        <div class="p-6">
            <form action="{{ route('hrd.pelamar.update-status', $pelamar) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status" class="w-full border rounded-lg px-3 py-2">
                        <option value="pending" {{ $pelamar->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="lolos_tahap1" {{ $pelamar->status == 'lolos_tahap1' ? 'selected' : '' }}>Lolos Tahap 1</option>
                        <option value="psikotest" {{ $pelamar->status == 'psikotest' ? 'selected' : '' }}>Psikotest</option>
                        <option value="lolos_psikotest" {{ $pelamar->status == 'lolos_psikotest' ? 'selected' : '' }}>Lolos Psikotest</option>
                        <option value="interview" {{ $pelamar->status == 'interview' ? 'selected' : '' }}>Interview</option>
                        <option value="diterima" {{ $pelamar->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ $pelamar->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Catatan</label>
                    <textarea name="catatan" rows="3" class="w-full border rounded-lg px-3 py-2">{{ $pelamar->catatan }}</textarea>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg">Update Status</button>
            </form>
        </div>
    </div>
    
    <!-- Jadwal Interview -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b">
            <h3 class="font-semibold text-lg">Jadwal Interview</h3>
        </div>
        <div class="p-6">
            <form action="{{ route('hrd.pelamar.kirim-interview', $pelamar) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Tanggal Interview</label>
                    <input type="date" name="tanggal_interview" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Waktu Interview</label>
                    <input type="time" name="waktu_interview" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Lokasi Interview</label>
                    <input type="text" name="lokasi_interview" class="w-full border rounded-lg px-3 py-2" placeholder="Alamat lengkap..." required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Catatan Tambahan</label>
                    <textarea name="catatan" rows="2" class="w-full border rounded-lg px-3 py-2" placeholder="Persiapan yang harus dibawa dll..."></textarea>
                </div>
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
                    <i class="fab fa-whatsapp mr-2"></i> Kirim Jadwal via WhatsApp
                </button>
            </form>
            
            @if(session('whatsapp_url'))
            <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded">
                <p class="text-green-700 mb-2">Klik tombol di bawah untuk mengirim pesan WhatsApp:</p>
                <a href="{{ session('whatsapp_url') }}" target="_blank" class="block text-center bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
                    <i class="fab fa-whatsapp mr-2"></i> Buka WhatsApp
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openRejectModal() {
        document.getElementById('rejectModal').classList.remove('hidden');
        document.getElementById('rejectModal').classList.add('flex');
    }
    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectModal').classList.remove('flex');
    }
</script>
@endpush