<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Isian Data Pelamar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial Narrow', 'Sans-Serif';
            background: #f4f4ff6e;
            padding: 30px 20px;
            display: flex;
            justify-content: center;
            font-size: 16px;
        }

        .print-wrapper {
            background: white;
            max-width: 1000px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 4px;
        }

        .form-cetak {
            padding: 25px 30px 40px 30px;
        }

        /* HEADER TABLE */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .header-table td {
            border: 1px solid #000;
            padding: 8px 6px;
            vertical-align: middle;
        }

        .logo-cell {
            width: 150px;
            text-align: center;
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .company-name {
            font-size: 16px;
            margin-top: 4px;
            white-space: nowrap;
            line-height: 1;
        }

        .title-cell {
            font-size: 20px;
            font-weight: normal;
            text-align: center;
        }

        .info-cell, .value-cell {
            font-size: 14px;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        .detail-table td {
            padding: 5px 4px;
            vertical-align: top;
        }

        /* LOGIKA BOX ANTI-POTONG (Dinamis Otomatis) */
        .section {
            margin-top: 18px;
            line-height: 1.2;
            page-break-inside: avoid; /* Untuk browser lama */
            break-inside: avoid;      /* Standar modern: mencegah box terpotong di tengah halaman */
        }

        .section-title {
            font-weight: bold;
            margin: 12px 0 12px 0;
            font-size: 18px;
            border-left: 4px solid #000;
            padding-left: 8px;
        }

        .sub-section-title {
            font-weight: 600;
            margin: 10px 0 5px 0;
            font-size: 17px;
            color: #000000c4;
        }

        ol {
            margin-left: 28px;
            margin-top: 5px;
        }

        ol li {
            margin-bottom: 6px;
        }

        /* Grid Table untuk data tabel */
        .grid-table {
            font-weight: normal;
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            margin-top: 5px;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .grid-table th, .grid-table td {
            border: 0.5px solid #000;
            padding: 4px;
            vertical-align: top;
        }

        .grid-table th {
            font-weight: normal;
            text-align: center;
            vertical-align: middle;
        }

        /* AREA TANDA TANGAN */
        .signature-area {
            display: flex;
            justify-content: space-between;
            margin-top: 80px;
            gap: 20px;
            width: 100%;
        }

        .sign-box {
            text-align: left;
            width: 300px;
        }

        .sign-name {
            margin-top: 55px;
            padding-top: 6px;
            font-weight: 500;
            width: 100%;
            margin-bottom: 4px;
        }

        .signan {
            border-bottom: 1px solid black;
        }

        .sign-box b {
            font-size: 11px;
        }

        /* TOMBOL PRINT */
        .print-btn {
            position: fixed;
            bottom: 5%;
            right: 15%;
            background: #2C3550;
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 40px;
            font-weight: bold;
            cursor: pointer;
            font-family: sans-serif;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        .print-btn:hover {
            background: #1f445f;
        }

        /* MEDIA PRINT */
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            .print-wrapper {
                box-shadow: none;
                margin: 0 auto;
                width: 100%;
            }
            .form-cetak {
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
            @page {
                size: A4;
                margin: 1.5cm;
            }
        }
        
    </style>
</head>
<body>

<div class="print-wrapper">
    <div class="form-cetak">
        
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <div class="logo-container">
                        <img src="{{ asset('storage/logo.png') }}" alt="logo dagsap" width="70">
                        <div class="company-name">
                            PT. Dagsap Endura Eatore
                        </div>
                    </div>
                </td>
                <td class="title-cell" style="font-weight: bold;">
                    FORM<br>ISIAN DATA PELAMAR
                </td>
                <td class="info-cell">
                    Nomor Dokumen<br>Revisi<br>Tanggal Efektif<br>Halaman
                </td>
                <td class="value-cell">
                    FRM.HRD.05.05<br>00<br>06 Mei 2013<br>1 dari 3
                </td>
            </tr>
        </table>

        @php 
            $detail = $pelamar->detail;

            // Helper untuk decode JSON
            $pendidikanFormal = is_array($detail->pendidikan_formal ?? null) ? $detail->pendidikan_formal : json_decode($detail->pendidikan_formal ?? '[]', true);
            $pelatihan = is_array($detail->pelatihan ?? null) ? $detail->pelatihan : json_decode($detail->pelatihan ?? '[]', true);
            $keterampilan = is_array($detail->keterampilan ?? null) ? $detail->keterampilan : json_decode($detail->keterampilan ?? '[]', true);
            $bahasaAsing = is_array($detail->bahasa_asing ?? null) ? $detail->bahasa_asing : json_decode($detail->bahasa_asing ?? '[]', true);
            $pengalamanKerja = is_array($detail->pengalaman_kerja ?? null) ? $detail->pengalaman_kerja : json_decode($detail->pengalaman_kerja ?? '[]', true);
            $referensi = is_array($detail->referensi ?? null) ? $detail->referensi : json_decode($detail->referensi ?? '[]', true);
        @endphp

        <div class="detail-table" style="margin-bottom: 15px;">
            <table style="width: 100%;">
                <tr>
                    <td width="150"><strong>Posisi yang dilamar</strong></td>
                    <td width="10">:</td>
                    <td><strong>{{ $pelamar->lowongan->judul ?? '-' }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="section" style="line-height:0.7;">
            <div class="section-title">A. DATA PRIBADI</div>
            <table class="detail-table" style="text-transform: capitalize; margin-bottom:0;">
                <tr>
                    <td width="150">1. Nama Lengkap</td><td width="10">:</td><td width="350">{{ $detail->nama_lengkap ?? $pelamar->nama_lengkap }}</td>
                    <td width="120" style="white-space:nowrap;">Jenis Kelamin</td><td width="10">:</td><td>{{ ($detail->jenis_kelamin ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td>2. Tempat/Tgl Lahir</td><td>:</td><td>{{ $detail->tempat_lahir ?? '-' }}, {{ $pelamar->tanggal_lahir ? \Carbon\Carbon::parse($pelamar->tanggal_lahir)->format('d/m/Y') : '-' }}</td>
                    <td>Tinggi Badan</td><td>:</td><td>{{ $detail->tinggi_badan ?? '-' }} cm</td>
                </tr>
                <tr>
                    <td>3. Kewarganegaraan</td><td>:</td><td>{{ $detail->kewarganegaraan ?? 'Indonesia' }}</td>
                    <td>Berat Badan</td><td>:</td><td>{{ $detail->berat_badan ?? '-' }} kg</td>
                </tr>
                <tr>
                    <td>4. Agama</td><td>:</td><td>{{ $detail->agama ?? '-' }}</td>
                    <td>Gol. Darah</td><td>:</td><td>{{ $detail->golongan_darah ?? '-' }}</td>
                </tr>
            </table>
            
            <table class="detail-table">
                <tr>
                    <td width="150" style="line-height: 1.5; margin-top:0;">5. Alamat Tinggal</td><td width="10">:</td><td>{{ $detail->alamat_tinggal ?? $pelamar->alamat }}</td>
                </tr>
            </table>
            <table class="detail-table" style="margin-left: 100px; width: 95%;">
                <tr>
                    <td width="100">RT/RW</td><td width="10">:</td><td width="150">{{ $detail->rt_rw_tinggal ?? '-' }}</td>
                    <td width="100">Kelurahan</td><td width="10">:</td><td>{{ $detail->kelurahan_tinggal ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Kecamatan</td><td>:</td><td>{{ $detail->kecamatan_tinggal ?? '-' }}</td>
                    <td>Kabupaten</td><td>:</td><td>{{ $detail->kabupaten_tinggal ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Kota</td><td>:</td><td>{{ $detail->kota_tinggal ?? '-' }}</td>
                    <td>Propinsi</td><td>:</td><td>{{ $detail->provinsi_tinggal ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Kode Pos</td><td>:</td><td>{{ $detail->kode_pos_tinggal ?? '-' }}</td>
                    <td>No. Telp</td><td>:</td><td>-</td>
                </tr>
                <tr>
                    <td>No. HP</td><td>:</td><td>{{ $detail->no_hp ?? $pelamar->no_telepon }}</td>
                    <td>No. WA</td><td>:</td><td>{{ $detail->no_wa ?? '-' }}</td>
                </tr>
            </table>
            <table class="detail-table">
                <tr>
                    <td width="150" style="line-height: 1.5; margin-top:0;">6. Alamat KTP</td><td width="10">:</td><td>{{ $detail->alamat_ktp ?? '-' }}</td>
                </tr>
            </table>

            <table class="detail-table" style="margin-left: 100px; width: 95%;">
                <tr>
                    <td width="100">RT/RW</td><td width="10">:</td><td width="150">{{ $detail->rt_rw_ktp ?? '-' }}</td>
                    <td width="100">Kelurahan</td><td width="10">:</td><td>{{ $detail->kelurahan_ktp ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Kecamatan</td><td>:</td><td>{{ $detail->kecamatan_ktp ?? '-' }}</td>
                    <td>Kabupaten</td><td>:</td><td>{{ $detail->kabupaten_ktp ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Kota</td><td>:</td><td>{{ $detail->kota_ktp ?? '-' }}</td>
                    <td>Propinsi</td><td>:</td><td>{{ $detail->provinsi_ktp ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Kode Pos</td><td>:</td><td>{{ $detail->kode_pos_ktp ?? '-' }}</td>
                    <td>No. Telp</td><td>:</td><td>-</td>
                </tr>
            </table>

            <table class="detail-table">
                <tr>
                    <td width="180">7. No. KTP/Passport</td><td width="10">:</td><td width="250">{{ $detail->no_ktp ?? '-' }}</td>
                    <td width="120">Dikeluarkan di</td><td width="10">:</td><td>{{ $detail->dikeluarkan_di ?? '-' }}</td>
                </tr>
                <tr><td>8. No. NPWP</td><td>:</td><td colspan="4">{{ $detail->no_npwp ?? '-' }}</td></tr>
                <tr><td>9. No. BPJS Kes/TK</td><td>:</td><td colspan="4">{{ $detail->no_bpjs_ketenagakerjaan ?? '-' }}</td></tr>
                <tr><td>10. Status Perkawinan</td><td>:</td><td colspan="4">{{ $detail->status_perkawinan ?? '-' }}</td></tr>
                <tr><td>11. Email</td><td>:</td><td colspan="4">{{ $detail->email ?? $pelamar->email }}</td></tr>
                <tr><td>12. Hobby</td><td>:</td><td colspan="4">{{ $detail->hobby ?? '-' }}</td></tr>
                <tr><td>13. Organisasi</td><td>:</td><td colspan="4">{{ $detail->organisasi ?? '-' }}</td></tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">B. RIWAYAT PENDIDIKAN</div>
            <div class="sub-section-title">1. Pendidikan Formal :</div>
            <table class="grid-table">
                <thead>
                    <tr>
                        <th width="100">Tingkat Pendidikan</th>
                        <th>Nama Sekolah</th>
                        <th width="80">Kota</th>
                        <th width="100">Jurusan</th>
                        <th width="60">Tahun Masuk</th>
                        <th width="60">Tahun Lulus</th>
                        <th width="50">IPK</th>
                        <th width="80">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $tingkatList = ['SLTP', 'SMU', 'DIPLOMA', 'S1', 'S2'];
                    @endphp
                    @foreach($tingkatList as $tingkat)
                        @php
                            $found = collect($pendidikanFormal)->firstWhere('tingkat', $tingkat);
                        @endphp
                        <tr>
                            <td>{{ $tingkat }}</td>
                            <td>{{ $found['nama_sekolah'] ?? '' }}</td>
                            <td>{{ $found['kota'] ?? '' }}</td>
                            <td>{{ $found['jurusan'] ?? '' }}</td>
                            <td>{{ $found['tahun_masuk'] ?? '' }}</td>
                            <td>{{ $found['tahun_lulus'] ?? '' }}</td>
                            <td>{{ $found['ipk'] ?? '' }}</td>
                            <td>{{ $tingkat == 'DIPLOMA' ? 'D1/D2/D3' : '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="sub-section-title">2. Pelatihan / Kursus :</div>
            <table class="grid-table">
                <thead>
                    <tr>
                        <th width="40">No.</th>
                        <th>Nama Pelatihan/Kursus</th>
                        <th width="80">Tgl. Mulai</th>
                        <th width="80">Tgl. Selesai</th>
                        <th>Lembaga Penyelenggara</th>
                        <th width="70">Sertifikat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelatihan as $idx => $p)
                    <tr>
                        <td align="center">{{ $idx+1 }}</td>
                        <td>{{ $p['nama'] ?? '' }}</td>
                        <td>{{ $p['tgl_mulai'] ?? '' }}</td>
                        <td>{{ $p['tgl_selesai'] ?? '' }}</td>
                        <td>{{ $p['lembaga'] ?? '' }}</td>
                        <td>{{ $p['sertifikat'] ?? '' }}</td>
                    </tr>
                    @empty
                        @for($i=0; $i<4; $i++)
                        <tr><td align="center">{{ $i+1 }}</td><td colspan="5">-</td></tr>
                        @endfor
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="section-title">C. KETERAMPILAN</div>
            <table class="grid-table">
                <thead>
                    <tr>
                        <th width="40">No.</th>
                        <th>Jenis Keterampilan</th>
                        <th width="100">Cukup Mahir</th>
                        <th width="100">Mahir</th>
                        <th width="100">Sangat Mahir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($keterampilan as $idx => $skill)
                    <tr>
                        <td align="center">{{ $idx+1 }}</td>
                        <td>{{ $skill['nama'] ?? '' }}</td>
                        <td align="center">{{ ($skill['tingkat'] ?? '') == 'Cukup Mahir' ? '✓' : '' }}</td>
                        <td align="center">{{ ($skill['tingkat'] ?? '') == 'Mahir' ? '✓' : '' }}</td>
                        <td align="center">{{ ($skill['tingkat'] ?? '') == 'Sangat Mahir' ? '✓' : '' }}</td>
                    </tr>
                    @empty
                        @for($i=0; $i<4; $i++)
                        <tr><td align="center">{{ $i+1 }}</td><td colspan="4">-</td></tr>
                        @endfor
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="section-title">D. BAHASA ASING <span style="font-size: 10px;">(diisi dengan baik sekali, baik, atau cukup)</span></div>
            <table class="grid-table">
                <thead>
                    <tr>
                        <th width="40">No.</th>
                        <th>Jenis Bahasa</th>
                        <th width="120">Membaca</th>
                        <th width="120">Berbicara</th>
                        <th width="120">Menulis</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bahasaAsing as $idx => $bhs)
                    <tr>
                        <td align="center">{{ $idx+1 }}</td>
                        <td>{{ $bhs['nama'] ?? '' }}</td>
                        <td>{{ $bhs['membaca'] ?? '' }}</td>
                        <td>{{ $bhs['berbicara'] ?? '' }}</td>
                        <td>{{ $bhs['writes'] ?? $bhs['menulis'] ?? '' }}</td>
                    </tr>
                    @empty
                        @for($i=0; $i<3; $i++)
                        <tr><td align="center">{{ $i+1 }}</td><td colspan="4">-</td></tr>
                        @endfor
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="section-title">E. KEKUATAN &amp; KELEMAHAN</div>
            <table class="grid-table">
                <thead>
                    <tr>
                        <th width="40">No.</th>
                        <th>Kekuatan / Kelebihan</th>
                        <th>Kelemahan / Kekurangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td align="center">1</td><td>{{ $detail->kekuatan ?? '' }}</td><td>{{ $detail->kelemahan ?? '' }}</td></tr>
                    <tr><td align="center">2</td><td>-</td><td>-</td></tr>
                    <tr><td align="center">3</td><td>-</td><td>-</td></tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="section-title">F. RIWAYAT PEKERJAAN</div>
            <div class="sub-section-title">1. Pengalaman kerja sebelumnya <i>(urutkan dari yang terbaru)</i></div>
            <table class="grid-table">
                <thead>
                    <tr>
                        <th width="40">No.</th>
                        <th>Nama Perusahaan</th>
                        <th width="80">Tgl. Masuk</th>
                        <th width="80">Tgl. Keluar</th>
                        <th>Jabatan & Tugas Utama</th>
                        <th width="80">Gaji Terakhir</th>
                        <th width="100">Alasan Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengalamanKerja as $idx => $kerja)
                    <tr>
                        <td align="center">{{ $idx+1 }}</td>
                        <td>{{ $kerja['perusahaan'] ?? '' }}</td>
                        <td>{{ $kerja['tgl_masuk'] ?? '' }}</td>
                        <td>{{ $kerja['tgl_keluar'] ?? '' }}</td>
                        <td>{{ $kerja['jabatan'] ?? '' }}</td>
                        <td>{{ $kerja['gaji'] ?? '' }}</td>
                        <td>{{ $kerja['alasan_keluar'] ?? '' }}</td>
                    </tr>
                    @empty
                        @for($i=0; $i<4; $i++)
                        <tr><td align="center">{{ $i+1 }}</td><td colspan="6">-</td></tr>
                        @endfor
                    @endforelse
                </tbody>
            </table>

            <div class="sub-section-title">2. Bidang minat pada pekerjaan :</div>
            @php
                $bidangMinat = is_array($detail->bidang_minat ?? null) ? $detail->bidang_minat : [];
            @endphp
            <div style="padding-left: 20px; font-size: 16px; line-height: 1.5;">
                ( {{ in_array('Logistic & Distribution', $bidangMinat) ? '✓' : ' ' }} ) Logistic & Distribution &nbsp;&nbsp;
                ( {{ in_array('Sales/Marketing', $bidangMinat) ? '✓' : ' ' }} ) Sales/Marketing &nbsp;&nbsp;
                ( {{ in_array('Finance, Accounting, & Tax', $bidangMinat) ? '✓' : ' ' }} ) Finance, Accounting, & Tax &nbsp;&nbsp;
                ( {{ in_array('Production', $bidangMinat) ? '✓' : ' ' }} ) Production<br>
                ( {{ in_array('Business Development', $bidangMinat) ? '✓' : ' ' }} ) Business Development &nbsp;&nbsp;
                ( {{ in_array('Human Resources', $bidangMinat) ? '✓' : ' ' }} ) Human Resources &nbsp;&nbsp;
                ( {{ in_array('General Affair', $bidangMinat) ? '✓' : ' ' }} ) General Affair &nbsp;&nbsp;
                ( {{ in_array('QAQC', $bidangMinat) ? '✓' : ' ' }} ) QAQC<br>
                ( {{ in_array('Information Technology', $bidangMinat) ? '✓' : ' ' }} ) Information Technology &nbsp;&nbsp;
                ( {{ in_array('Product Development', $bidangMinat) ? '✓' : ' ' }} ) Product Development &nbsp;&nbsp;
                ( ) Lain : 
            </div>
        </div>

        <div class="section">
            <div class="section-title">G. REFERENSI</div>
            <table class="grid-table">
                <thead>
                    <tr>
                        <th width="40">No.</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat Lengkap</th>
                        <th width="110">No. Telp/HP</th>
                        <th width="90">Hubungan</th>
                        <th width="70">Lama Kenal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($referensi as $idx => $ref)
                    <tr>
                        <td align="center">{{ $idx+1 }}</td>
                        <td>{{ $ref['nama'] ?? '' }}</td>
                        <td>{{ $ref['alamat'] ?? '' }}</td>
                        <td>{{ $ref['telp'] ?? '' }}</td>
                        <td>{{ $ref['hubungan'] ?? '' }}</td>
                        <td>{{ $ref['lama_kenal'] ?? '' }}</td>
                    </tr>
                    @empty
                        @for($i=0; $i<2; $i++)
                        <tr><td align="center">{{ $i+1 }}</td><td colspan="5">-</td></tr>
                        @endfor
                    @endforelse
                </tbody>
            </table>

            <div style="margin-top: 10px;">
                Apakah Anda mempunyai saudara/kenalan yang bekerja di perusahaan kami? 
                ( {{ ($detail->punya_saudara_di_perusahaan ?? false) ? '✓' : ' ' }} ) ya ( {{ !($detail->punya_saudara_di_perusahaan ?? false) ? '✓' : ' ' }} ) tidak
            </div>
        </div>

        <div class="section" style="line-height: 1.4;">
            <div class="section-title">H. RIWAYAT KESEHATAN</div>
            
            <div style="margin-bottom: 12px;">
                <div>1. Apakah Anda pernah menderita sakit berat dan dirawat di rumah sakit selama 2 years terakhir?</div>
                <div>( {{ ($detail->pernah_sakit_berat ?? false) ? '✓' : '' }} ) ya ( {{ !($detail->pernah_sakit_berat ?? false) ? '✓' : '' }} ) tidak</div>
                <div style="border-bottom: 1px dotted #999; margin-top: 5px; padding: 3px;">: {{ $detail->sakit_berat_keterangan ?? '' }}</div>
            </div>

            <div style="margin-bottom: 12px;">
                <div>2. Apakah Anda mempunyai penyakit keturunan, cacat keturunan atau cacat akibat kecelakaan?</div>
                <div>( {{ ($detail->punya_penyakit_keturunan ?? false) ? '✓' : '' }} ) ya ( {{ !($detail->punya_penyakit_keturunan ?? false) ? '✓' : '' }} ) tidak</div>
                <div style="border-bottom: 1px dotted #999; margin-top: 5px; padding: 3px;">: {{ $detail->penyakit_keturunan_keterangan ?? '' }}</div>
            </div>

            <div style="margin-bottom: 12px;">
                <div>3. Apakah Anda mempunyai gangguan penglihatan/memakai kacamata?</div>
                <div>( {{ ($detail->pakai_kacamata ?? false) ? '✓' : '' }} ) ya ( {{ !($detail->pakai_kacamata ?? false) ? '✓' : '' }} ) tidak</div>
                <div style="border-bottom: 1px dotted #999; margin-top: 5px; padding: 3px;">: {{ $detail->ukuran_kacamata ?? '' }}</div>
            </div>

            <div style="margin-bottom: 12px;">
                <div>4. Apakah Anda mempunyai alergi?</div>
                <div>( {{ ($detail->punya_alergi ?? false) ? '✓' : '' }} ) ya ( {{ !($detail->punya_alergi ?? false) ? '✓' : '' }} ) tidak</div>
                <div style="border-bottom: 1px dotted #999; margin-top: 5px; padding: 3px;">: {{ $detail->alergi_keterangan ?? '' }}</div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">I. DATA KELUARGA</div>
    
            @php
                $dataPasangan = is_array($detail->data_pasangan ?? null) ? $detail->data_pasangan : json_decode($detail->data_pasangan ?? '{}', true);
                $dataAnak = is_array($detail->data_anak ?? null) ? $detail->data_anak : json_decode($detail->data_anak ?? '[]', true);
                $riwayatPenyakitKeluarga = is_array($detail->riwayat_penyakit_keluarga ?? null) ? $detail->riwayat_penyakit_keluarga : json_decode($detail->riwayat_penyakit_keluarga ?? '[]', true);
                $dataOrangTua = is_array($detail->data_orang_tua ?? null) ? $detail->data_orang_tua : json_decode($detail->data_orang_tua ?? '{}', true);
                $kontakDarurat = is_array($detail->kontak_darurat ?? null) ? $detail->kontak_darurat : json_decode($detail->kontak_darurat ?? '{}', true);
                $saudaraKandung = is_array($detail->saudara_kandung ?? null) ? $detail->saudara_kandung : json_decode($detail->saudara_kandung ?? '[]', true);
            @endphp
    
            <div class="sub-section-title" style="margin-top: 10px;">1. Data Istri/Suami</div>
            @if(($detail->punya_pasangan ?? false) && !empty($dataPasangan))
                <table class="detail-table">
                    <tr>
                        <td width="180">a. Nama Lengkap</td><td width="10">:</td><td>{{ $dataPasangan['nama_lengkap'] ?? '-' }}</td>
                        <td width="120">b. Tempat/Tgl Lahir</td><td width="10">:</td><td>{{ $dataPasangan['tempat_lahir'] ?? '-' }}, {{ isset($dataPasangan['tanggal_lahir']) ? \Carbon\Carbon::parse($dataPasangan['tanggal_lahir'])->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>c. Tgl. Menikah</td><td>:</td><td>{{ isset($dataPasangan['tanggal_menikah']) ? \Carbon\Carbon::parse($dataPasangan['tanggal_menikah'])->format('d/m/Y') : '-' }}</td>
                        <td>d. Agama</td><td>:</td><td>{{ $dataPasangan['agama'] ?? '-' }}</td>
                    </tr>
                    <tr><td colspan="6">e. Alamat Tinggal : {{ $dataPasangan['alamat'] ?? '-' }}</td></tr>
                </table>
        
                <table class="detail-table" style="margin-left: 20px; width: 95%;">
                    <tr>
                        <td width="100">RT/RW</td><td width="10">:</td><td width="150">{{ $dataPasangan['rt_rw'] ?? '-' }}</td>
                        <td width="100">Kelurahan</td><td width="10">:</td><td>{{ $dataPasangan['kelurahan'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td><td>:</td><td>{{ $dataPasangan['kecamatan'] ?? '-' }}</td>
                        <td>Kabupaten</td><td>:</td><td>{{ $dataPasangan['border_kecamatan'] ?? $dataPasangan['kabupaten'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Kota</td><td>:</td><td>{{ $dataPasangan['kota'] ?? '-' }}</td>
                        <td>Propinsi</td><td>:</td><td>{{ $dataPasangan['provinsi'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Kode Pos</td><td>:</td><td>{{ $dataPasangan['kode_pos'] ?? '-' }}</td>
                        <td>No. Telp</td><td>:</td><td>{{ $dataPasangan['no_telp'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>No. HP</td><td>:</td><td>{{ $dataPasangan['no_hp'] ?? '-' }}</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>f. Pendidikan</td><td>:</td><td>{{ $dataPasangan['pendidikan'] ?? '-' }}</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>g. Pekerjaan</td><td>:</td><td>{{ $dataPasangan['pekerjaan'] ?? '-' }}</td>
                        <td>Jabatan</td><td>:</td><td>{{ $dataPasangan['jabatan'] ?? '-' }}</td>
                    </tr>
                </table>
            @else
                <div style="padding: 10px; background: #f9f9f9; margin-bottom: 10px;">
                    <p>Tidak ada data pasangan (Status: {{ $detail->status_perkawinan ?? 'Lajang' }})</p>
                </div>
            @endif
    
            <div class="sub-section-title" style="margin-top: 10px;">2. Data Pribadi Anak</div>
            @if(($detail->punya_anak ?? false) && !empty($dataAnak))
                <table class="grid-table">
                    <thead>
                        <tr><th width="40">No.</th><th>Nama Lengkap</th><th width="50">L/P</th><th>Tempat/Tanggal Lahir</th><th>Pendidikan</th></tr>
                    </thead>
                    <tbody>
                        @foreach($dataAnak as $idx => $anak)
                        <tr>
                            <td align="center">{{ $idx+1 }}</td>
                            <td>{{ $anak['nama'] ?? '-' }}</td>
                            <td align="center">{{ $anak['jenis_kelamin'] ?? '-' }}</td>
                            <td>{{ $anak['tempat_lahir'] ?? '-' }}, {{ isset($anak['tanggal_lahir']) ? \Carbon\Carbon::parse($anak['tanggal_lahir'])->format('d/m/Y') : '-' }}</td>
                            <td>{{ $anak['pendidikan'] ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="padding: 10px; background: #f9f9f9; margin-bottom: 10px;">
                    <p>Tidak ada data anak</p>
                </div>
            @endif
    
            <div class="sub-section-title" style="margin-top: 10px;">3. Riwayat Penyakit Istri/Suami/Anak</div>
            @if(!empty($riwayatPenyakitKeluarga))
                <table class="grid-table">
                    <thead>
                        <tr><th width="40">No.</th><th>Nama</th><th>Jenis Penyakit</th><th width="100">Hubungan</th><th width="80">Tahun Dirawat</th><th>Tempat</th></tr>
                    </thead>
                    <tbody>
                        @foreach($riwayatPenyakitKeluarga as $idx => $penyakit)
                        <tr>
                            <td align="center">{{ $idx+1 }}</td>
                            <td>{{ $penyakit['nama'] ?? '-' }}</td>
                            <td>{{ $penyakit['jenis_penyakit'] ?? '-' }}</td>
                            <td>{{ $penyakit['hubungan'] ?? '-' }}</td>
                            <td>{{ $penyakit['tahun_dirawat'] ?? '-' }}</td>
                            <td>{{ $penyakit['tempat'] ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="padding: 10px; background: #f9f9f9; margin-bottom: 10px;">
                    <p>Tidak ada riwayat penyakit keluarga</p>
                </div>
            @endif
    
            <div class="sub-section-title" style="margin-top: 10px;">4. Orang Tua</div>
            <table class="grid-table">
                <thead>
                    <tr><th width="150"></th><th>Ayah</th><th>Ibu</th></tr>
                </thead>
                <tbody>
                    <tr><td>Nama Lengkap</td><td>{{ $dataOrangTua['ayah_nama'] ?? '-' }}</td><td>{{ $dataOrangTua['ibu_nama'] ?? '-' }}</td></tr>
                    <tr><td>Agama</td><td>{{ $dataOrangTua['ayah_agama'] ?? '-' }}</td><td>{{ $dataOrangTua['ibu_agama'] ?? '-' }}</td></tr>
                    <tr><td>Usia</td><td>{{ $dataOrangTua['ayah_usia'] ?? '-' }}</td><td>{{ $dataOrangTua['ibu_usia'] ?? '-' }}</td></tr>
                    <tr><td>Pekerjaan</td><td>{{ $dataOrangTua['ayah_pekerjaan'] ?? '-' }}</td><td>{{ $dataOrangTua['ibu_pekerjaan'] ?? '-' }}</td></tr>
                    <tr><td>Alamat & No. Telp</td><td>{{ $dataOrangTua['ayah_alamat'] ?? '-' }}</td><td>{{ $dataOrangTua['ibu_alamat'] ?? '-' }}</td></tr>
                </tbody>
            </table>
    
            <div class="sub-section-title" style="margin-top: 10px;">5. Orang Terdekat yang Dapat Dihubungi dalam Keadaan Darurat</div>
            @if(!empty($kontakDarurat))
                <table class="detail-table">
                    <tr><td width="180">a. Nama Lengkap</td><td width="10">:</td><td colspan="4">{{ $kontakDarurat['nama'] ?? '-' }}</td></tr>
                    <tr><td>b. Tempat/Tgl Lahir</td><td>:</td><td colspan="4">{{ $kontakDarurat['tempat_lahir'] ?? '-' }}, {{ isset($kontakDarurat['tanggal_lahir']) ? \Carbon\Carbon::parse($kontakDarurat['tanggal_lahir'])->format('d/m/Y') : '-' }}</td></tr>
                    <tr><td>c. Hubungan</td><td>:</td><td colspan="4">{{ $kontakDarurat['hubungan'] ?? '-' }}</td></tr>
                    <tr><td colspan="6">d. Alamat Tinggal : {{ $kontakDarurat['alamat'] ?? '-' }}</td></tr>
                </table>
        
                <table class="detail-table" style="margin-left: 20px; width: 95%;">
                    <tr>
                        <td width="100">RT/RW</td><td width="10">:</td><td width="150">{{ $kontakDarurat['rt_rw'] ?? '-' }}</td>
                        <td width="100">Kelurahan</td><td width="10">:</td><td>{{ $kontakDarurat['kelurahan'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td><td>:</td><td>{{ $kontakDarurat['kecamatan'] ?? '-' }}</td>
                        <td>Propinsi</td><td>:</td><td>{{ $kontakDarurat['provinsi'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Kode Pos</td><td>:</td><td>{{ $kontakDarurat['kode_pos'] ?? '-' }}</td>
                        <td>No. Telp</td><td>:</td><td>{{ $kontakDarurat['no_telp'] ?? '-' }}</td>
                    </tr>
                    <tr><td>No. HP</td><td>:</td><td colspan="3">{{ $kontakDarurat['no_hp'] ?? '-' }}</td></tr>
                    <tr>
                        <td>e. Pekerjaan</td><td>:</td><td>{{ $kontakDarurat['pekerjaan'] ?? '-' }}</td>
                        <td>Jabatan</td><td>:</td><td>{{ $kontakDarurat['jabatan'] ?? '-' }}</td>
                    </tr>
                </table>
            @else
                <div style="padding: 10px; background: #f9f9f9; margin-bottom: 10px;">
                    <p>Tidak ada data kontak darurat</p>
                </div>
            @endif
    
            <div class="sub-section-title" style="margin-top: 10px;">6. Saudara Kandung (Termasuk Pelamar)</div>
            @if(!empty($saudaraKandung))
                <table class="grid-table">
                    <thead>
                        <tr><th width="40">No.</th><th>Nama Lengkap</th><th width="50">L/P</th><th width="60">Usia</th><th>Pendidikan</th><th>Pekerjaan</th><th>Hubungan</th></tr>
                    </thead>
                    <tbody>
                        @foreach($saudaraKandung as $idx => $saudara)
                        <tr>
                            <td align="center">{{ $idx+1 }}</td>
                            <td>{{ $saudara['nama'] ?? '-' }}</td>
                            <td align="center">{{ $saudara['jenis_kelamin'] ?? '-' }}</td>
                            <td align="center">{{ $saudara['usia'] ?? '-' }}</td>
                            <td>{{ $saudara['pendidikan'] ?? '-' }}</td>
                            <td>{{ $saudara['pekerjaan'] ?? '-' }}</td>
                            <td>{{ $saudara['hubungan'] ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="padding: 10px; background: #f9f9f9; margin-bottom: 10px;">
                    <p>Tidak ada data saudara kandung</p>
                </div>
            @endif
        </div>  

        <div class="section">
            <div class="section-title">J. REMUNERASI</div>
            <div style="margin-bottom: 15px;">
                Gaji per bulan yang diharapkan : <strong style="text-decoration:underline;">Rp. {{ $detail->gaji_diharapkan ?? '........................' }}</strong>
            </div>

            <div class="section-title">K. WAKTU</div>
            <div style="margin-bottom: 20px;">
                Jika lamaran Anda diterima, berapa lama waktu yang Anda perlukan untuk dapat bergabung? : 
                <strong style="text-decoration:underline;">{{ $detail->waktu_bergabung ?? '........................' }}</strong>
            </div>

            <div class="section-title">L. PERNYATAAN</div>
            <div style="line-height: 1.2; text-align: justify; margin-bottom: 30px;">
                Dengan ini saya menyatakan bahwa semua keterangan yang saya cantumkan dalam formulir ini adalah benar dan sah. 
                Seandainya saya diterima dan kemudian terbukti bahwa salah satu saja keterangan saya tersebut tidak benar, 
                maka saya bersedia mengundurkan diri tanpa persyaratan apapun dengan segera dari perusahaan ini.
            </div>

            <div class="signature-area" style="text-transform:capitalize;">
                <div class="sign-box">
                    <div>Tempat & Tanggal : {{ $detail->tempat_pernyataan ?? '-' }},
                    {{ $detail->tanggal_pernyataan ? \Carbon\Carbon::parse($detail->tanggal_pernyataan)->format('d/m/Y') : '-' }}</div>
                    <br>
                    <div>Yang Menyatakan :</div>
                    <div class="signan">
                        <div  class="sign-name" style="text-align:center;">{{ $detail->nama_lengkap ?? $pelamar->nama_lengkap }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<button class="print-btn no-print" onclick="window.print()">
    🖨️ Print / Cetak
</button>

</body>
</html>