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
            width: 110px;
            text-align: center;
        }

        .logo-box {
            width: 70px;
            height: 70px;
            background: #e2e8f0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 12px;
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

        .section {
            margin-top: 18px;
            line-height: 0.7;
        }

        .section-title {
            font-weight: bold;
            margin: 12px 0 12px 0;
            font-size: 18px;
            border-left: 4px solid #000;
            padding-left: 8px;
        }

        .sub-section-title {
            font-weight: normal;
            margin: 10px 0 5px 0;
            font-size: 16px;
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
            border: 0.5px  solid #000;
            padding: 4px;
            vertical-align: top;
        }

        .grid-table th {
            font-weight: normal;
            /* background: #fff; */
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
            flex: 1;
            text-align: center;
        }

        .sign-name {
            margin-top: 55px;
            border-bottom: 1px solid black;
            padding-top: 6px;
            font-weight: 500;
            width: 100%;
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

        /* Page break */
        .page-break {
            page-break-before: always;
        }

        td {
            line
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
        
        <!-- HEADER TABLE (sama seperti management) -->
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <div class="logo-box">LOGO</div>
                </td>
                <td class="title-cell">
                    FORM<br>ISIAN DATA PELAMAR
                </td>
                <td class="info-cell">
                    Nomor Dokumen<br>Revisi<br>Tanggal Print<br>Halaman
                </td>
                <td class="value-cell">
                    FRM.HRD.05.05<br>00<br>{{ date('d/m/Y') }}<br>1 dari 4
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

        <!-- Posisi yang dilamar -->
        <div class="detail-table" style="margin-bottom: 15px;">
            <table style="width: 100%;">
                <tr>
                    <td width="150"><strong>Posisi yang dilamar</strong></td>
                    <td width="10">:</td>
                    <td><strong>{{ $pelamar->lowongan->judul ?? '-' }}</strong></td>
                </tr>
            </table>
        </div>

        <!-- A. DATA PRIBADI -->
        <div class="section">
            <div class="section-title">A. DATA PRIBADI</div>
            <table class="detail-table">
                <tr><td width="180">1. Nama Lengkap</td><td width="10">:</td><td><b>{{ $detail->nama_lengkap ?? $pelamar->nama_lengkap }} </b></td>
                    <td width="120">Jenis Kelamin</td><td width="10">:</td><td>{{ ($detail->jenis_kelamin ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                <tr><td>2. Tempat/Tgl Lahir</td><td>:</td><td>{{ $detail->tempat_lahir ?? '-' }}, {{ $pelamar->tanggal_lahir ? \Carbon\Carbon::parse($pelamar->tanggal_lahir)->format('d/m/Y') : '-' }}</td>
                    <td>Tinggi Badan</td><td>:</td><td>{{ $detail->tinggi_badan ?? '-' }} cm</td></tr>
                <tr><td>3. Kewarganegaraan</td><td>:</td><td>{{ $detail->kewarganegaraan ?? 'Indonesia' }}</td>
                    <td>Berat Badan</td><td>:</td><td>{{ $detail->berat_badan ?? '-' }} kg</td></tr>
                <tr><td>4. Agama</td><td>:</td><td>{{ $detail->agama ?? '-' }}</td>
                <td>Gol. Darah</td><td>:</td><td>{{ $detail->golongan_darah ?? '-' }}</td></tr>
                <tr><td>5. Alamat Tinggal</td><td>:</td><td>{{ $detail->alamat_tinggal ?? $pelamar->alamat }}</td></tr>
            </table>

            <table class="detail-table" style="margin-left: 100px; width: 95%;">
                <tr><td width="100">RT/RW</td><td width="10">:</td><td width="150">{{ $detail->rt_rw_tinggal ?? '-' }}</td>
                    <td width="100">Kelurahan</td><td width="10">:</td><td>{{ $detail->kelurahan_tinggal ?? '-' }}</td></tr>
                <tr><td>Kecamatan</td><td>:</td><td>{{ $detail->kecamatan_tinggal ?? '-' }}</td>
                    <td>Kabupaten</td><td>:</td><td>{{ $detail->kabupaten_tinggal ?? '-' }}</td></tr>
                <tr><td>Kota</td><td>:</td><td>{{ $detail->kota_tinggal ?? '-' }}</td>
                    <td>Propinsi</td><td>:</td><td>{{ $detail->provinsi_tinggal ?? '-' }}</td></tr>
                <tr><td>Kode Pos</td><td>:</td><td>{{ $detail->kode_pos_tinggal ?? '-' }}</td>
                    <td>No. Telp</td><td>:</td><td>-</td></tr>
                <tr><td>No. HP</td><td>:</td><td>{{ $detail->no_hp ?? $pelamar->no_telepon }}</td>
                    <td>No. WA</td><td>:</td><td>{{ $detail->no_wa ?? '-' }}</td></tr>
            </table>
            
            <table class="detail-table">
                <td width="180">6. Alamat KTP</td><td width="10">:</td><td>{{ $detail->alamat_ktp ?? '-' }}</td></tr>
            </table>

            <table class="detail-table" style="margin-left: 100px; width: 95%;">
                <tr><td width="100">RT/RW</td><td width="10">:</td><td width="150">{{ $detail->rt_rw_ktp ?? '-' }}</td>
                    <td width="100">Kelurahan</td><td width="10">:</td><td>{{ $detail->kelurahan_ktp ?? '-' }}</td></tr>
                <tr><td>Kecamatan</td><td>:</td><td>{{ $detail->kecamatan_ktp ?? '-' }}</td>
                    <td>Kabupaten</td><td>:</td><td>{{ $detail->kabupaten_ktp ?? '-' }}</td></tr>
                <tr><td>Kota</td><td>:</td><td>{{ $detail->kota_ktp ?? '-' }}</td>
                    <td>Propinsi</td><td>:</td><td>{{ $detail->provinsi_ktp ?? '-' }}</td></tr>
                <tr><td>Kode Pos</td><td>:</td><td>{{ $detail->kode_pos_ktp ?? '-' }}</td>
                    <td>No. Telp</td><td>:</td><td>-</td></tr>
            </table>

            <table class="detail-table">
                <tr><td width="180">7. No. KTP/Passport</td><td width="10">:</td><td width="250">{{ $detail->no_ktp ?? '-' }}</td>
                    <td width="120">Dikeluarkan di</td><td width="10">:</td><td>{{ $detail->dikeluarkan_di ?? '-' }}</td></tr>
                <tr><td>8. No. NPWP</td><td>:</td><td colspan="4">{{ $detail->no_npwp ?? '-' }}</td></tr>
                <tr><td>9. No. BPJS Kes/TK</td><td>:</td><td colspan="4">{{ $detail->no_bpjs_ketenagakerjaan ?? '-' }}</td></tr>
                <tr><td>10. Status Perkawinan</td><td>:</td><td colspan="4">{{ $detail->status_perkawinan ?? '-' }}</td></tr>
                <tr><td>11. Email</td><td>:</td><td colspan="4">{{ $detail->email ?? $pelamar->email }}</td></tr>
                <tr><td>12. Hobby</td><td>:</td><td colspan="4">{{ $detail->hobby ?? '-' }}</td></tr>
                <tr><td>13. Organisasi</td><td>:</td><td colspan="4">{{ $detail->organisasi ?? '-' }}</td></tr>
            </table>
        </div>

        <!-- B. RIWAYAT PENDIDIKAN (Page Break) -->
        <div class="section page-break">
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
                        <td><td align="center">{{ $i+1 }}</td><td colspan="5">-</td></tr>
                        @endfor
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- C. KETERAMPILAN -->
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
                        <tr><td align="center">{{ $i+1 }}<td><td colspan="4">-</td></tr>
                        @endfor
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- D. BAHASA ASING -->
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
                        <td>{{ $bhs['menulis'] ?? '' }}</td>
                    </tr>
                    @empty
                        @for($i=0; $i<3; $i++)
                        <tr><td align="center">{{ $i+1 }}<td><td colspan="4">-</td></tr>
                        @endfor
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- E. KEKUATAN & KELEMAHAN (Page Break) -->
        <div class="section page-break">
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

        <!-- F. RIWAYAT PEKERJAAN -->
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
            <div style="padding-left: 20px; font-size: 11px;">
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

        <!-- G. REFERENSI (Page Break) -->
        <div class="section page-break">
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
                <strong>Apakah Anda mempunyai saudara/kenalan yang bekerja di perusahaan kami?</strong> 
                ( {{ $detail->punya_saudara_di_perusahaan ? '✓' : ' ' }} ) ya ( {{ !$detail->punya_saudara_di_perusahaan ? '✓' : ' ' }} ) tidak
            </div>
        </div>

        <!-- H. RIWAYAT KESEHATAN -->
        <div class="section">
            <div class="section-title">H. RIWAYAT KESEHATAN</div>
            
            <div style="margin-bottom: 12px;">
                <div>1. Apakah Anda pernah menderita sakit berat dan dirawat di rumah sakit selama 2 tahun terakhir?</div>
                <div>( {{ $detail->pernah_sakit_berat ? '✓' : '' }} ) ya ( {{ !$detail->pernah_sakit_berat ? '✓' : '' }} ) tidak</div>
                <div style="border-bottom: 1px dotted #999; margin-top: 5px; padding: 3px;">: {{ $detail->sakit_berat_keterangan ?? '' }}</div>
            </div>

            <div style="margin-bottom: 12px;">
                <div>2. Apakah Anda mempunyai penyakit keturunan, cacat keturunan atau cacat akibat kecelakaan?</div>
                <div>( {{ $detail->punya_penyakit_keturunan ? '✓' : '' }} ) ya ( {{ !$detail->punya_penyakit_keturunan ? '✓' : '' }} ) tidak</div>
                <div style="border-bottom: 1px dotted #999; margin-top: 5px; padding: 3px;">: {{ $detail->penyakit_keturunan_keterangan ?? '' }}</div>
            </div>

            <div style="margin-bottom: 12px;">
                <div>3. Apakah Anda mempunyai gangguan penglihatan/memakai kacamata?</div>
                <div>( {{ $detail->pakai_kacamata ? '✓' : '' }} ) ya ( {{ !$detail->pakai_kacamata ? '✓' : '' }} ) tidak</div>
                <div style="border-bottom: 1px dotted #999; margin-top: 5px; padding: 3px;">: {{ $detail->ukuran_kacamata ?? '' }}</div>
            </div>

            <div style="margin-bottom: 12px;">
                <div>4. Apakah Anda mempunyai alergi?</div>
                <div>( {{ $detail->punya_alergi ? '✓' : '' }} ) ya ( {{ !$detail->punya_alergi ? '✓' : '' }} ) tidak</div>
                <div style="border-bottom: 1px dotted #999; margin-top: 5px; padding: 3px;">: {{ $detail->alergi_keterangan ?? '' }}</div>
            </div>
        </div>

        <!-- J. REMUNERASI & K. WAKTU & L. PERNYATAAN (Page Break) -->
        <div class="section page-break">
            <div class="section-title">J. REMUNERASI</div>
            <div style="margin-bottom: 15px;">
                Gaji per bulan yang diharapkan : <strong>Rp. {{ $detail->gaji_diharapkan ?? '........................' }}</strong>
            </div>

            <div class="section-title">K. WAKTU</div>
            <div style="margin-bottom: 20px;">
                Jika lamaran Anda diterima, berapa lama waktu yang Anda perlukan untuk dapat bergabung? : 
                <strong>{{ $detail->waktu_bergabung ?? '........................' }}</strong>
            </div>

            <div class="section-title">L. PERNYATAAN</div>
            <div style="font-size: 11px; text-align: justify; margin-bottom: 30px;">
                Dengan ini saya menyatakan bahwa semua keterangan yang saya cantumkan dalam formulir ini adalah benar dan sah. 
                Seandainya saya diterima dan kemudian terbukti bahwa salah satu saja keterangan saya tersebut tidak benar, 
                maka saya bersedia mengundurkan diri tanpa persyaratan apapun dengan segera dari perusahaan ini.
            </div>

            <!-- TANDA TANGAN -->
            <div class="signature-area">
                <div class="sign-box">
                    <div>Tempat & Tanggal : Jakarta, {{ date('d/m/Y') }}</div>
                    <div class="sign-name">{{ $detail->nama_lengkap ?? $pelamar->nama_lengkap }}</div>
                    <b>Yang Menyatakan</b>
                </div>
                <div class="sign-box">
                    <div>&nbsp;</div>
                    <div class="sign-name">&nbsp;</div>
                    <b>HRD</b>
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