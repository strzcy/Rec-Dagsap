<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Pengajuan - {{ $pengajuan->posisi }}</title>
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
            margin: 15mm;
        }
        .print-container {
            max-width: 210mm;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #000;
        }
        .header h1 {
            font-size: 22px;
            margin-bottom: 5px;
        }
        .header h3 {
            font-size: 14px;
            color: #555;
        }
        .section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }
        .section-title {
            font-size: 14px;
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
            width: 130px;
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
        .status-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-approved { background: #d1fae5; color: #065f46; }
        .status-rejected { background: #fee2e2; color: #991b1b; }
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
            margin-top: 50px;
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
            <h3>Form Permintaan Tenaga Kerja (PTK)</h3>
            <p>Tanggal Cetak: {{ date('d/m/Y H:i:s') }}</p>
        </div>
        
        <!-- Status -->
        <div class="section">
            <div class="info-item">
                <span class="info-label">Status Pengajuan:</span>
                <span class="info-value">
                    @if($pengajuan->status == 'pending')
                        <span class="status-badge status-pending">MENUNGGU APPROVAL</span>
                    @elseif($pengajuan->status == 'disetujui')
                        <span class="status-badge status-approved">DISETUJUI</span>
                    @else
                        <span class="status-badge status-rejected">DITOLAK</span>
                    @endif
                </span>
            </div>
        </div>
        
        <!-- A. IDENTITAS PEMOHON -->
        <div class="section">
            <div class="section-title">A. IDENTITAS PEMOHON</div>
            <div class="info-grid">
                <div class="info-item"><span class="info-label">Nama Pemohon:</span> <span class="info-value">{{ $pengajuan->nama_pemohon ?? '-' }}</span></div>
                <div class="info-item"><span class="info-label">NIP/NIK:</span> <span class="info-value">{{ $pengajuan->nip_pemohon ?? '-' }}</span></div>
                <div class="info-item"><span class="info-label">Jabatan:</span> <span class="info-value">{{ $pengajuan->jabatan_pemohon ?? '-' }}</span></div>
                <div class="info-item"><span class="info-label">No. HP:</span> <span class="info-value">{{ $pengajuan->no_hp_pemohon ?? '-' }}</span></div>
                <div class="info-item"><span class="info-label">Departemen:</span> <span class="info-value">{{ $pengajuan->departemen->nama_divisi ?? '-' }}</span></div>
                <div class="info-item"><span class="info-label">Tanggal Pengajuan:</span> <span class="info-value">{{ $pengajuan->created_at->format('d/m/Y H:i') }}</span></div>
            </div>
        </div>
        
        <!-- B. DETAIL PERMINTAAN -->
        <div class="section">
            <div class="section-title">B. DETAIL PERMINTAAN TENAGA KERJA</div>
            <div class="info-grid">
                <div class="info-item"><span class="info-label">Posisi/Jabatan:</span> <span class="info-value">{{ $pengajuan->posisi }}</span></div>
                <div class="info-item"><span class="info-label">Jumlah Dibutuhkan:</span> <span class="info-value">{{ $pengajuan->jumlah }} orang</span></div>
                <div class="info-item"><span class="info-label">Jenis Kebutuhan:</span> <span class="info-value">{{ $pengajuan->jenis == 'penambahan' ? 'Penambahan' : 'Penggantian' }}</span></div>
                <div class="info-item"><span class="info-label">Tanggal Dibutuhkan:</span> <span class="info-value">{{ \Carbon\Carbon::parse($pengajuan->tanggal_dibutuhkan)->format('d/m/Y') }}</span></div>
            </div>
            
            <div class="mt-2">
                <div class="info-item"><span class="info-label">Tugas dan Tanggung Jawab:</span></div>
                @php $tugas = is_array($pengajuan->tugas) ? $pengajuan->tugas : json_decode($pengajuan->tugas, true); @endphp
                @if(!empty($tugas))
                    <ul style="margin-left: 30px; margin-top: 5px;">
                        @foreach($tugas as $item)
                            <li style="font-size: 11px;">{{ $item }}</li>
                        @endforeach
                    </ul>
                @else
                    <p style="margin-left: 30px; font-size: 11px;">-</p>
                @endif
            </div>
            
            <div class="mt-2">
                <div class="info-item"><span class="info-label">Deskripsi Pekerjaan:</span></div>
                <p style="margin-left: 30px; font-size: 11px; margin-top: 5px;">{{ nl2br(e($pengajuan->deskripsi_pekerjaan)) ?: '-' }}</p>
            </div>
        </div>
        
        <!-- C. SPESIFIKASI CALON -->
        <div class="section">
            <div class="section-title">C. SPESIFIKASI CALON</div>
            @php $kriteria = is_array($pengajuan->kriteria) ? $pengajuan->kriteria : json_decode($pengajuan->kriteria, true); @endphp
            <div class="info-grid">
                <div class="info-item"><span class="info-label">Pendidikan Minimal:</span> <span class="info-value">{{ $kriteria['pendidikan'] ?? '-' }}</span></div>
                <div class="info-item"><span class="info-label">Jurusan:</span> <span class="info-value">{{ $kriteria['jurusan'] ?? '-' }}</span></div>
                <div class="info-item"><span class="info-label">Pengalaman Minimal:</span> <span class="info-value">{{ $kriteria['pengalaman'] ?? '0' }} tahun</span></div>
                <div class="info-item"><span class="info-label">IPK Minimal:</span> <span class="info-value">{{ $kriteria['ipk'] ?? '-' }}</span></div>
                <div class="info-item"><span class="info-label">Keahlian:</span> <span class="info-value">{{ $kriteria['keahlian'] ?? '-' }}</span></div>
            </div>
            
            @php $persyaratan = is_array($pengajuan->persyaratan) ? $pengajuan->persyaratan : json_decode($pengajuan->persyaratan, true); @endphp
            @if(!empty($persyaratan))
                <div class="mt-2">
                    <div class="info-item"><span class="info-label">Persyaratan Lainnya:</span></div>
                    <ul style="margin-left: 30px; margin-top: 5px;">
                        @foreach($persyaratan as $item)
                            <li style="font-size: 11px;">{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        
        <!-- D. PERSETUJUAN -->
        <div class="section">
            <div class="section-title">D. PERSETUJUAN</div>
            <div class="signature">
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <p>Pemohon</p>
                    <p class="mt-2"><strong>{{ $pengajuan->nama_pemohon ?? '-' }}</strong></p>
                </div>
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <p>Management</p>
                    @if($pengajuan->status == 'disetujui')
                        <p class="mt-2"><strong>{{ $pengajuan->disetujui_oleh ?? '-' }}</strong></p>
                        <p style="font-size: 10px;">{{ $pengajuan->approved_at ? \Carbon\Carbon::parse($pengajuan->approved_at)->format('d/m/Y') : '-' }}</p>
                    @endif
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
        <button onclick="window.close()" style="padding: 10px 20px; background: #666; color: white; border: none; border-radius: 5px; margin-left: 10px; cursor: pointer;">
            Tutup
        </button>
    </div>
</body>
</html>