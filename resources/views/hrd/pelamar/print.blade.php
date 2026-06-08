<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelamar - {{ $pelamar->nama_lengkap }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            background: white;
            padding: 20px;
        }
        @page {
            size: A4;
            margin: 20mm;
        }
        .print-container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #000;
        }
        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        .header h3 {
            font-size: 16px;
            color: #555;
        }
        .section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            background: #f0f0f0;
            padding: 5px 10px;
            margin-bottom: 10px;
            border-left: 4px solid #424862;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
            margin-bottom: 10px;
        }
        .info-item {
            font-size: 12px;
        }
        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }
        .info-value {
            display: inline-block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }
        th {
            background: #f5f5f5;
            font-weight: bold;
        }
        .signature {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            text-align: center;
            width: 200px;
        }
        .signature-line {
            border-top: 1px solid #000;
            margin-top: 40px;
            padding-top: 5px;
        }
        footer {
            text-align: center;
            font-size: 10px;
            color: #999;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }
        @media print {
            body {
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="print-container">
        <!-- Header -->
        <div class="header">
            <h1>PT DAGSAP ENDURA EATORE</h1>
            <h3>Formulir Lamaran Pekerjaan</h3>
            <p>Tanggal: {{ date('d/m/Y') }}</p>
        </div>
        
        @php $detail = $pelamar->detail; @endphp
        
        <!-- A. DATA PRIBADI -->
        <div class="section">
            <div class="section-title">A. DATA PRIBADI</div>
            <div class="info-grid">
                <div class="info-item"><span class="info-label">Nama Lengkap:</span> <span class="info-value">{{ $detail->nama_lengkap ?? $pelamar->nama_lengkap }}</span></div>
                <div class="info-item"><span class="info-label">Jenis Kelamin:</span> <span class="info-value">{{ ($detail->jenis_kelamin ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' }}</span></div>
                <div class="info-item"><span class="info-label">Tempat/Tgl Lahir:</span> <span class="info-value">{{ $detail->tempat_lahir ?? $pelamar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pelamar->tanggal_lahir)->format('d/m/Y') }}</span></div>
                <div class="info-item"><span class="info-label">Tinggi/Berat:</span> <span class="info-value">{{ $detail->tinggi_badan ?? '-' }} cm / {{ $detail->berat_badan ?? '-' }} kg</span></div>
                <div class="info-item"><span class="info-label">Agama:</span> <span class="info-value">{{ $detail->agama ?? '-' }}</span></div>
                <div class="info-item"><span class="info-label">Golongan Darah:</span> <span class="info-value">{{ $detail->golongan_darah ?? '-' }}</span></div>
                <div class="info-item"><span class="info-label">Status Perkawinan:</span> <span class="info-value">{{ $detail->status_perkawinan ?? '-' }}</span></div>
                <div class="info-item"><span class="info-label">No. KTP:</span> <span class="info-value">{{ $detail->no_ktp ?? '-' }}</span></div>
                <div class="info-item"><span class="info-label">No. HP:</span> <span class="info-value">{{ $detail->no_hp ?? $pelamar->no_telepon }}</span></div>
                <div class="info-item"><span class="info-label">Email:</span> <span class="info-value">{{ $detail->email ?? $pelamar->email }}</span></div>
                <div class="info-item"><span class="info-label">Hobby:</span> <span class="info-value">{{ $detail->hobby ?? '-' }}</span></div>
                <div class="info-item col-span-2"><span class="info-label">Alamat Tinggal:</span> <span class="info-value">{{ $detail->alamat_tinggal ?? $pelamar->alamat }}</span></div>
            </div>
        </div>
        
        <!-- B. PENDIDIKAN -->
        @if($detail->pendidikan_formal)
        <div class="section">
            <div class="section-title">B. RIWAYAT PENDIDIKAN FORMAL</div>
            <table>
                <thead>
                    <tr><th>Tingkat</th><th>Nama Sekolah</th><th>Jurusan</th><th>Tahun Lulus</th><th>IPK</th></tr>
                </thead>
                <tbody>
                    @foreach($detail->pendidikan_formal as $pend)
                    <tr>
                        <td>{{ $pend['tingkat'] ?? '-' }}</td>
                        <td>{{ $pend['nama_sekolah'] ?? '-' }}</td>
                        <td>{{ $pend['jurusan'] ?? '-' }}</td>
                        <td>{{ $pend['tahun_lulus'] ?? '-' }}</td>
                        <td>{{ $pend['ipk'] ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        
        <!-- C. KETERAMPILAN & D. BAHASA -->
        <div class="section">
            <div class="section-title">C. KETERAMPILAN &amp; BAHASA ASING</div>
            @if($detail->keterampilan)
            <div><strong>Keterampilan:</strong> 
                @foreach($detail->keterampilan as $skill)
                {{ $skill['nama'] ?? '-' }} ({{ $skill['tingkat'] ?? '-' }})@if(!$loop->last), @endif
                @endforeach
            </div>
            @endif
            @if($detail->bahasa_asing)
            <div class="mt-2"><strong>Bahasa Asing:</strong>
                @foreach($detail->bahasa_asing as $bhs)
                {{ $bhs['nama'] ?? '-' }} (Baca:{{ $bhs['membaca'] ?? '-' }})@if(!$loop->last), @endif
                @endforeach
            </div>
            @endif
        </div>
        
        <!-- E. KEKUATAN & KELEMAHAN -->
        <div class="section">
            <div class="section-title">D. KEKUATAN &amp; KELEMAHAN</div>
            <div><strong>Kekuatan:</strong> {{ $detail->kekuatan ?? '-' }}</div>
            <div class="mt-1"><strong>Kelemahan:</strong> {{ $detail->kelemahan ?? '-' }}</div>
        </div>
        
        <!-- F. RIWAYAT PEKERJAAN -->
        @if($detail->pengalaman_kerja)
        <div class="section">
            <div class="section-title">E. RIWAYAT PEKERJAAN</div>
            <table>
                <thead><tr><th>Perusahaan</th><th>Jabatan</th><th>Periode</th><th>Alasan Keluar</th></tr></thead>
                <tbody>
                    @foreach($detail->pengalaman_kerja as $kerja)
                    <tr>
                        <td>{{ $kerja['perusahaan'] ?? '-' }}</td>
                        <td>{{ $kerja['jabatan'] ?? '-' }}</td>
                        <td>{{ $kerja['tgl_masuk'] ?? '-' }} s/d {{ $kerja['tgl_keluar'] ?? '-' }}</td>
                        <td>{{ $kerja['alasan_keluar'] ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        
        <!-- G. REFERENSI -->
        @if($detail->referensi)
        <div class="section">
            <div class="section-title">F. REFERENSI</div>
            <table>
                <thead><tr><th>Nama</th><th>Hubungan</th><th>No. Telp</th></tr></thead>
                <tbody>
                    @foreach($detail->referensi as $ref)
                    <tr>
                        <td>{{ $ref['nama'] ?? '-' }}</td>
                        <td>{{ $ref['hubungan'] ?? '-' }}</td>
                        <td>{{ $ref['telp'] ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        
        <!-- H. RIWAYAT KESEHATAN -->
        <div class="section">
            <div class="section-title">G. RIWAYAT KESEHATAN</div>
            <div>Pernah Sakit Berat: {{ $detail->pernah_sakit_berat ? 'Ya' : 'Tidak' }}</div>
            <div>Penyakit Keturunan: {{ $detail->punya_penyakit_keturunan ? 'Ya' : 'Tidak' }}</div>
            <div>Pakai Kacamata: {{ $detail->pakai_kacamata ? 'Ya' : 'Tidak' }}</div>
            <div>Punya Alergi: {{ $detail->punya_alergi ? 'Ya' : 'Tidak' }}</div>
        </div>
        
        <!-- I. PERNYATAAN -->
        <div class="section">
            <div class="section-title">H. PERNYATAAN</div>
            <p style="font-size: 11px; text-align: justify;">Dengan ini saya menyatakan bahwa semua keterangan yang saya cantumkan dalam formulir ini adalah benar dan sah. Seandainya saya diterima dan kemudian terbukti bahwa salah satu saja keterangan saya tersebut tidak benar, maka saya bersedia mengundurkan diri tanpa persyaratan apapun dengan segera dari perusahaan ini.</p>
            <div class="signature">
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <p>Yang Membuat Pernyataan</p>
                    <p class="mt-2"><strong>{{ $detail->nama_lengkap ?? $pelamar->nama_lengkap }}</strong></p>
                </div>
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <p>HRD</p>
                </div>
            </div>
        </div>
        
        <footer>
            Dokumen ini dicetak dari sistem Dagsap Recruitment pada {{ date('d/m/Y H:i:s') }}
        </footer>
    </div>
    
    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #424862; color: white; border: none; border-radius: 5px; cursor: pointer;">
            <i class="fas fa-print"></i> Cetak / Print
        </button>
        <button onclick="window.close()" style="padding: 10px 20px; background: #666; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">
            Tutup
        </button>
    </div>
</body>
</html>