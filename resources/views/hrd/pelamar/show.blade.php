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
<div class="flex justify-end space-x-3 mb-4 no-print">
    <a href="{{ route('hrd.pelamar.print', $pelamar) }}" target="_blank" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark">
        <i class="fas fa-print mr-2"></i> Cetak Data (A4)
    </a>
    <button onclick="window.print()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
        <i class="fas fa-print mr-2"></i> Print Halaman Ini
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
    
            @php
                $dataPasangan = is_array($detail->data_pasangan ?? null) ? $detail->data_pasangan : json_decode($detail->data_pasangan ?? '{}', true);
                $dataAnak = is_array($detail->data_anak ?? null) ? $detail->data_anak : json_decode($detail->data_anak ?? '[]', true);
                $riwayatPenyakitKeluarga = is_array($detail->riwayat_penyakit_keluarga ?? null) ? $detail->riwayat_penyakit_keluarga : json_decode($detail->riwayat_penyakit_keluarga ?? '[]', true);
                $dataOrangTua = is_array($detail->data_orang_tua ?? null) ? $detail->data_orang_tua : json_decode($detail->data_orang_tua ?? '{}', true);
                $kontakDarurat = is_array($detail->kontak_darurat ?? null) ? $detail->kontak_darurat : json_decode($detail->kontak_darurat ?? '{}', true);
                $saudaraKandung = is_array($detail->saudara_kandung ?? null) ? $detail->saudara_kandung : json_decode($detail->saudara_kandung ?? '[]', true);
            @endphp
    
            <!-- 1. Data Istri/Suami -->
            <div class="mt-3">
                <div class="font-semibold text-sm text-gray-700">1. Data Istri/Suami</div>
                @if($detail->punya_pasangan && !empty($dataPasangan) && isset($dataPasangan['nama_lengkap']))
                    <div class="grid grid-cols-2 gap-2 text-sm mt-1">
                        <div><span class="text-gray-500">Nama Lengkap:</span> {{ $dataPasangan['nama_lengkap'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Tempat/Tgl Lahir:</span> {{ $dataPasangan['tempat_lahir'] ?? '-' }}, {{ isset($dataPasangan['tanggal_lahir']) ? \Carbon\Carbon::parse($dataPasangan['tanggal_lahir'])->format('d/m/Y') : '-' }}</div>
                        <div><span class="text-gray-500">Tanggal Menikah:</span> {{ isset($dataPasangan['tanggal_menikah']) ? \Carbon\Carbon::parse($dataPasangan['tanggal_menikah'])->format('d/m/Y') : '-' }}</div>
                        <div><span class="text-gray-500">Agama:</span> {{ $dataPasangan['agama'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Alamat:</span> {{ $dataPasangan['alamat'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Pendidikan:</span> {{ $dataPasangan['pendidikan'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Pekerjaan:</span> {{ $dataPasangan['pekerjaan'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Jabatan:</span> {{ $dataPasangan['jabatan'] ?? '-' }}</div>
                    </div>
                @else
                    <div class="text-sm text-gray-500 italic">Tidak ada data pasangan (Status: {{ $detail->status_perkawinan ?? 'Lajang' }})</div>
                @endif
            </div>
    
            <!-- 2. Data Anak -->
            <div class="mt-3">
                <div class="font-semibold text-sm text-gray-700">2. Data Anak</div>
                @if($detail->punya_anak && !empty($dataAnak))
                    <div class="overflow-x-auto mt-1">
                        <table class="min-w-full text-xs border">
                            <thead class="bg-gray-50">
                                <tr><th class="px-2 py-1 border">No</th><th class="px-2 py-1 border">Nama</th><th class="px-2 py-1 border">L/P</th><th class="px-2 py-1 border">Tempat/Tgl Lahir</th><th class="px-2 py-1 border">Pendidikan</th></tr>
                            </thead>
                            <tbody>
                                @foreach($dataAnak as $idx => $anak)
                                <td><td class="px-2 py-1 border" align="center">{{ $idx+1 }}</td>
                                    <td class="px-2 py-1 border">{{ $anak['nama'] ?? '-' }}</td>
                                    <td class="px-2 py-1 border">{{ $anak['jenis_kelamin'] ?? '-' }}</td>
                                    <td class="px-2 py-1 border">{{ $anak['tempat_lahir'] ?? '-' }}, {{ isset($anak['tanggal_lahir']) ? \Carbon\Carbon::parse($anak['tanggal_lahir'])->format('d/m/Y') : '-' }}</td>
                                    <td class="px-2 py-1 border">{{ $anak['pendidikan'] ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-sm text-gray-500 italic">Tidak ada data anak</div>
                @endif
            </div>
    
            <!-- 3. Riwayat Penyakit Keluarga -->
            <div class="mt-3">
                <div class="font-semibold text-sm text-gray-700">3. Riwayat Penyakit Istri/Suami/Anak</div>
                @if(!empty($riwayatPenyakitKeluarga))
                    <div class="overflow-x-auto mt-1">
                        <table class="min-w-full text-xs border">
                            <thead class="bg-gray-50">
                                <tr><th class="px-2 py-1 border">No</th><th class="px-2 py-1 border">Nama</th><th class="px-2 py-1 border">Jenis Penyakit</th><th class="px-2 py-1 border">Hubungan</th><th class="px-2 py-1 border">Tahun Dirawat</th><th class="px-2 py-1 border">Tempat</th></tr>
                            </thead>
                            <tbody>
                                @foreach($riwayatPenyakitKeluarga as $idx => $penyakit)
                                <tr><td class="px-2 py-1 border" align="center">{{ $idx+1 }}</td>
                                    <td class="px-2 py-1 border">{{ $penyakit['nama'] ?? '-' }}</td>
                                    <td class="px-2 py-1 border">{{ $penyakit['jenis_penyakit'] ?? '-' }}</td>
                                    <td class="px-2 py-1 border">{{ $penyakit['hubungan'] ?? '-' }}</td>
                                    <td class="px-2 py-1 border">{{ $penyakit['tahun_dirawat'] ?? '-' }}</td>
                                    <td class="px-2 py-1 border">{{ $penyakit['tempat'] ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-sm text-gray-500 italic">Tidak ada riwayat penyakit</div>
                @endif
            </div>
    
            <!-- 4. Orang Tua (WAJIB DIISI) -->
            <div class="mt-3">
                <div class="font-semibold text-sm text-gray-700">4. Orang Tua</div>
                <div class="grid grid-cols-2 gap-3 text-sm mt-1">
                    <div class="border p-2">
                        <div class="font-medium text-primary">Ayah</div>
                        <div><span class="text-gray-500">Nama Lengkap:</span> {{ $dataOrangTua['ayah_nama'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Agama:</span> {{ $dataOrangTua['ayah_agama'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Usia:</span> {{ $dataOrangTua['ayah_usia'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Pekerjaan:</span> {{ $dataOrangTua['ayah_pekerjaan'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Alamat & No. Telp:</span> {{ $dataOrangTua['ayah_alamat'] ?? '-' }}</div>
                    </div>
                    <div class="border p-2">
                        <div class="font-medium text-primary">Ibu</div>
                        <div><span class="text-gray-500">Nama Lengkap:</span> {{ $dataOrangTua['ibu_nama'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Agama:</span> {{ $dataOrangTua['ibu_agama'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Usia:</span> {{ $dataOrangTua['ibu_usia'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Pekerjaan:</span> {{ $dataOrangTua['ibu_pekerjaan'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Alamat & No. Telp:</span> {{ $dataOrangTua['ibu_alamat'] ?? '-' }}</div>
                    </div>
                </div>
            </div>
    
            <!-- 5. Kontak Darurat -->
            <div class="mt-3">
                <div class="font-semibold text-sm text-gray-700">5. Kontak Darurat</div>
                @if(!empty($kontakDarurat) && isset($kontakDarurat['nama']))
                    <div class="grid grid-cols-2 gap-2 text-sm mt-1">
                        <div><span class="text-gray-500">Nama:</span> {{ $kontakDarurat['nama'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Hubungan:</span> {{ $kontakDarurat['hubungan'] ?? '-' }}</div>
                        <div class="col-span-2"><span class="text-gray-500">Alamat:</span> {{ $kontakDarurat['alamat'] ?? '-' }}</div>
                        <div><span class="text-gray-500">No. Telp:</span> {{ $kontakDarurat['no_telp'] ?? '-' }}</div>
                        <div><span class="text-gray-500">No. HP:</span> {{ $kontakDarurat['no_hp'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Pekerjaan:</span> {{ $kontakDarurat['pekerjaan'] ?? '-' }}</div>
                        <div><span class="text-gray-500">Jabatan:</span> {{ $kontakDarurat['jabatan'] ?? '-' }}</div>
                    </div>
                @else
                    <div class="text-sm text-gray-500 italic">Tidak ada data kontak darurat</div>
                @endif
            </div>
    
            <!-- 6. Saudara Kandung -->
            <div class="mt-3">
                <div class="font-semibold text-sm text-gray-700">6. Saudara Kandung</div>
                @if(!empty($saudaraKandung))
                    <div class="overflow-x-auto mt-1">
                        <table class="min-w-full text-xs border">
                            <thead class="bg-gray-50">
                                <tr><th class="px-2 py-1 border">No</th><th class="px-2 py-1 border">Nama</th><th class="px-2 py-1 border">L/P</th><th class="px-2 py-1 border">Usia</th><th class="px-2 py-1 border">Pendidikan</th><th class="px-2 py-1 border">Pekerjaan</th><th class="px-2 py-1 border">Hubungan</th></tr>
                            </thead>
                            <tbody>
                                @foreach($saudaraKandung as $idx => $saudara)
                                <tr><td class="px-2 py-1 border" align="center">{{ $idx+1 }}</td>
                                    <td class="px-2 py-1 border">{{ $saudara['nama'] ?? '-' }}</td>
                                    <td class="px-2 py-1 border">{{ $saudara['jenis_kelamin'] ?? '-' }}</td>
                                    <td class="px-2 py-1 border">{{ $saudara['usia'] ?? '-' }}</td>
                                    <td class="px-2 py-1 border">{{ $saudara['pendidikan'] ?? '-' }}</td>
                                    <td class="px-2 py-1 border">{{ $saudara['pekerjaan'] ?? '-' }}</td>
                                    <td class="px-2 py-1 border">{{ $saudara['hubungan'] ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-sm text-gray-500 italic">Tidak ada data saudara kandung</div>
                @endif
            </div>
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

<!-- Dokumen dengan Preview -->
<div class="bg-white rounded-lg shadow mt-6">
    <div class="p-4 border-b bg-primary text-white">
        <h3 class="font-semibold text-lg">Dokumen Lamaran</h3>
    </div>
    <div class="p-6">
        <!-- Preview CV -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">CV / Resume</label>
            @if($pelamar->cv_path)
                <div class="border rounded-lg p-3 bg-gray-50">
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center">
                            @php
                                $cvExtension = pathinfo($pelamar->cv_path, PATHINFO_EXTENSION);
                                $cvSize = 0;
                                if (Storage::disk('local')->exists($pelamar->cv_path)) {
                                    $cvSize = Storage::disk('local')->size($pelamar->cv_path);
                                } elseif (Storage::disk('public')->exists($pelamar->cv_path)) {
                                    $cvSize = Storage::disk('public')->size($pelamar->cv_path);
                                }
                            @endphp
                            @if($cvExtension == 'pdf')
                                <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                            @else
                                <i class="fas fa-file-word text-blue-500 text-2xl mr-3"></i>
                            @endif
                            <div>
                                <p class="text-sm font-medium">CV_{{ $pelamar->nama_lengkap }}.{{ $cvExtension }}</p>
                                <p class="text-xs text-gray-500">Ukuran: {{ $cvSize ? round($cvSize / 1024, 2) : 0 }} KB</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="previewFile('{{ route('hrd.pelamar.preview-cv', $pelamar) }}', 'CV', '{{ $cvExtension }}')" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                <i class="fas fa-eye mr-1"></i> Preview
                            </button>
                            <a href="{{ route('hrd.pelamar.download-cv', $pelamar) }}" class="bg-primary text-white px-3 py-1 rounded text-sm hover:bg-primary-dark">
                                <i class="fas fa-download mr-1"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-gray-500">Belum upload CV</p>
            @endif
        </div>
        
        <!-- Preview Ijazah -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Ijazah / Transkrip Nilai</label>
            @if($pelamar->ijazah_path)
                <div class="border rounded-lg p-3 bg-gray-50">
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center">
                            @php
                                $ijazahExtension = pathinfo($pelamar->ijazah_path, PATHINFO_EXTENSION);
                                $ijazahSize = 0;
                                if (Storage::disk('local')->exists($pelamar->ijazah_path)) {
                                    $ijazahSize = Storage::disk('local')->size($pelamar->ijazah_path);
                                } elseif (Storage::disk('public')->exists($pelamar->ijazah_path)) {
                                    $ijazahSize = Storage::disk('public')->size($pelamar->ijazah_path);
                                }
                            @endphp
                            @if($ijazahExtension == 'pdf')
                                <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                            @elseif(in_array($ijazahExtension, ['jpg', 'jpeg', 'png']))
                                <i class="fas fa-file-image text-green-500 text-2xl mr-3"></i>
                            @else
                                <i class="fas fa-file-alt text-blue-500 text-2xl mr-3"></i>
                            @endif
                            <div>
                                <p class="text-sm font-medium">Ijazah_{{ $pelamar->nama_lengkap }}.{{ $ijazahExtension }}</p>
                                <p class="text-xs text-gray-500">Ukuran: {{ $ijazahSize ? round($ijazahSize / 1024, 2) : 0 }} KB</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="previewFile('{{ route('hrd.pelamar.preview-ijazah', $pelamar) }}', 'Ijazah', '{{ $ijazahExtension }}')" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                <i class="fas fa-eye mr-1"></i> Preview
                            </button>
                            <a href="{{ route('hrd.pelamar.download-ijazah', $pelamar) }}" class="bg-primary text-white px-3 py-1 rounded text-sm hover:bg-primary-dark">
                                <i class="fas fa-download mr-1"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-gray-500">Belum upload Ijazah</p>
            @endif
        </div>
    </div>
</div>

<!-- Modal Preview File -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg w-full max-w-4xl max-h-[90vh] overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="font-semibold text-lg" id="previewTitle">Preview File</h3>
            <button onclick="closePreview()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-4 overflow-auto max-h-[calc(90vh-80px)]" id="previewContent">
            <div id="pdfViewer" class="hidden">
                <embed id="pdfEmbed" src="" type="application/pdf" class="w-full min-h-[600px]">
            </div>
            <div id="imageViewer" class="hidden">
                <img id="imagePreview" src="" class="max-w-full max-h-[600px] mx-auto">
            </div>
            <div id="unsupportedViewer" class="hidden text-center py-10">
                <i class="fas fa-file-alt text-6xl text-gray-400 mb-4"></i>
                <p class="text-gray-600">File tidak dapat ditampilkan secara langsung.</p>
                <a href="#" id="downloadLink" class="mt-4 inline-block bg-primary text-white px-4 py-2 rounded-lg">Download File</a>
            </div>
        </div>
    </div>
</div>      



<!-- Modal Reject (jika belum ada) -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Konfirmasi Penolakan</h3>
        <p>Apakah Anda yakin ingin menolak pelamar ini?</p>
        <div class="flex justify-end space-x-3 mt-6">
            <button onclick="closeRejectModal()" class="px-4 py-2 border rounded-lg">Batal</button>
            <form action="" method="POST" id="rejectForm">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Tolak</button>
            </form>
        </div>
    </div>
</div>

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
            <h3 class="font-semibold text-lg">Jadwal Psikotest & Interview</h3>
        </div>
        <div class="p-6">
            <form action="{{ route('hrd.pelamar.kirim-interview', $pelamar) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Tanggal Tahap Selanjutnya</label>
                    <input type="date" name="tanggal_interview" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Waktu Tahap Selanjutnya</label>
                    <input type="time" name="waktu_interview" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Lokasi Tahap Selanjutnya</label>
                    <input value="Online" type="text" name="lokasi_interview" class="w-full border rounded-lg px-3 py-2" placeholder="Alamat lengkap..." required>
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
    function previewFile(url, title, extension) {
        document.getElementById('previewTitle').innerText = 'Preview ' + title;
        
        // Sembunyikan semua viewer
        document.getElementById('pdfViewer').classList.add('hidden');
        document.getElementById('imageViewer').classList.add('hidden');
        document.getElementById('unsupportedViewer').classList.add('hidden');
        
        if (extension === 'pdf') {
            // Tampilkan PDF
            document.getElementById('pdfViewer').classList.remove('hidden');
            document.getElementById('pdfEmbed').src = url;
        } else if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(extension.toLowerCase())) {
            // Tampilkan Gambar
            document.getElementById('imageViewer').classList.remove('hidden');
            document.getElementById('imagePreview').src = url;
        } else {
            // File tidak didukung preview
            document.getElementById('unsupportedViewer').classList.remove('hidden');
            document.getElementById('downloadLink').href = url;
        }
        
        document.getElementById('previewModal').classList.remove('hidden');
        document.getElementById('previewModal').classList.add('flex');
    }
    
    function closePreview() {
        document.getElementById('previewModal').classList.add('hidden');
        document.getElementById('previewModal').classList.remove('flex');
        // Reset semua viewer
        document.getElementById('pdfEmbed').src = '';
        document.getElementById('imagePreview').src = '';
    }
    
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