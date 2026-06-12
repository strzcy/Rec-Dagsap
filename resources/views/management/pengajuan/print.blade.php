    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        @if($pengajuan->jenis == 'penggantian')
            <title>Penggantian</title>
        @elseif($pengajuan->jenis == 'penambahan')
            <title>Penambahan - Form Permintaan Tenaga Kerja</title>
        @endif
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Arial', 'Sans-Serif';
                background: #f4f4ff6e;
                padding: 30px 20px;
                display: flex;
                justify-content: center;
            }

            /* FORM CETAK */
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
                margin-top: 5px;
                font-size: 16px;
                white-space: nowrap;
                line-height: 1.2;
            }

            .logo-box {
                width: 70px;
                height: 70px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .logo-box {
                width: 70px;
                height: 70px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                font-size: 12px;
            }

            .title-cell {
                font-size: 20px;
                font-weight: bold;
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
            }

            .section-title {
                font-weight: bold;
                margin: 12px 0 8px 0;
                font-size: 16px;
            }

            ol {
                margin-left: 28px;
                margin-top: 5px;
            }

            ol li {
                margin-bottom: 6px;
            }

            /* AREA TANDA TANGAN */
            .signature-area {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-top: 80px;
                text-align: center;
                gap: 20px;
                width: 100%;
            }

            /* Kolom standar (Pemohon) */
            .sign-box {
                flex: 1;
                font-size: 14px;
                display: flex;
                flex-direction: column;
                min-width: 0;
            }

            /* Kolom ganda mendapat space lebih luas dan seimbang */
            .sign-box.dik {
                flex: 2; 
            }

            .signature-title {
                font-weight: 500;
                margin-bottom: 20px;
                display: block;
            }

            .flex-container {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                width: 100%;
                gap: 15px;
            }

            .sub-sign {
                flex: 1;
                display: flex;
                flex-direction: column;
                text-align: center;
                min-width: 0;
            }

            /* Teks jabatan ganda dipaksa satu baris agar tidak patah */
            .sub-sign b {
                font-size: 11px !important;
                white-space: nowrap;
            }

            /* Area QR agar semua kolom punya tinggi yang sama */
            .qr-area {
                height: 95px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .qr-area svg,
            .qr-area img {
                max-width: 75px;
                max-height: 75px;
            }

            /* Semua kolom tanda tangan tingginya sama */
            .sign-box,
            .sub-sign {
                display: flex;
                flex-direction: column;
            }

            .sign-name {
                border-bottom: 1px solid black;
                font-weight: 500;
                width: 100%;
                display: block;
                white-space: nowrap;
            }

            .ssign-name {
                border-bottom: 1px solid black;
                font-weight: 500;
                width: 100%;
                display: block;
                white-space: inherit;
            }
            
            .sign-box b {
                font-size: 11px;
                margin-top: 2px;
            }

            #iden b{
                white-space: inherit;
            }

            #iden div {
                white-space: inherit;
            }

            #iden span {
                white-space: inherit;
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
            
            <table class="header-table" style="vertical-align: middle;">
                <tr>
                    <td class="logo-cell">
                        <div class="logo-container">
                            <div class="logo-box">
                                <img src="{{ asset('storage/logo.png') }}"
                                     alt="logo dagsap"
                                     width="70">
                            </div>

                            <div class="company-name">
                                PT. Dagsap Endura Eatore
                            </div>
                        </div>
                    </td>
                    <td class="title-cell" >
                        FORM<br>PERMINTAAN TENAGA <br>KERJA
                    </td>
                    <td class="info-cell">
                        Nomor Dokumen<br>Revisi<br>Tanggal Efektif<br>Halaman
                    </td>
                    <td class="value-cell">
                        FRM.HRD.05.07<br>00<br> 06 Mei 2013<br>1 dari 1
                    </td>
                </tr>
            </table>

            <table class="detail-table">
                <tr><td width="200">Nama Jabatan</td><td>: {{ $pengajuan->posisi }}</td></tr>
                <tr><td>Unit Kerja</td><td>: {{ $pengajuan->divisi->nama_divisi ?? '-' }}</td></tr>
                <tr><td>Jumlah Dibutuhkan</td><td>: {{ $pengajuan->jumlah }} Orang</td></tr>
                <tr><td>Tanggal Dibutuhkan</td><td>: 
                    {{ $pengajuan->tanggal_dibutuhkan
                        ? \Carbon\Carbon::parse($pengajuan->tanggal_dibutuhkan)->format('d/m/Y')
                        : '-' }}
                </td></tr>
            </table>

            <div class="section">
                <div class="section-title">Kebutuhan Untuk :</div>
                <p>( {{ $pengajuan->jenis == 'rencana' ? '✓' : '' }} ) Sesuai Rencana</p>
                <p>( {{ $pengajuan->jenis == 'penambahan' ? '✓' : '' }} ) Penambahan</p>
                <p>( {{ $pengajuan->jenis == 'penggantian' ? '✓' : '' }} ) Penggantian</p>
                <br>

                @php
                    $persyaratan = is_array($pengajuan->persyaratan) ? $pengajuan->persyaratan : json_decode($pengajuan->persyaratan, true);
                    $namaKaryawan = '';
                    if (!empty($persyaratan) && is_array($persyaratan)) {
                        foreach ($persyaratan as $syarat) {
                            $keyword = "Menggantikan karyawan:";
                            $posisiKeyword = strpos($syarat, $keyword);
                    
                            if ($posisiKeyword !== false) {
                                $namaKaryawan = trim(substr($syarat, $posisiKeyword + strlen($keyword)));
                                break; 
                            }
                        }
                    }
                @endphp

                @if($pengajuan->jenis == 'penggantian')
                    @if(!empty($namaKaryawan))
                        <p>Menggantikan : {{ $namaKaryawan }}</p>
                    @endif
                @endif
            </div>

            <div class="section">
                <div class="section-title">Tugas dan Tanggung Jawab :</div>
                @php
                    $tugas = is_array($pengajuan->tugas) ? $pengajuan->tugas : json_decode($pengajuan->tugas, true);
                @endphp
                @if(!empty($tugas))
                    <ol>
                        @foreach($tugas as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ol>
                @else
                    <ol>
                        <li>....................................</li>
                        <li>....................................</li>
                        <li>....................................</li>
                        <li>....................................</li>
                        <li>....................................</li>
                    </ol>
                @endif
            </div>

            <div class="section">
                <div class="section-title">Spesifikasi Calon :</div>
                <table class="detail-table">
                    @php
                        $kriteria = is_array($pengajuan->kriteria) ? $pengajuan->kriteria : json_decode($pengajuan->kriteria, true);
                    @endphp
                    <tr><td width="200">1. Pendidikan Minimal</td><td>: {{ $kriteria['pendidikan'] ?? '-' }}</td></tr>
                    <tr><td>2. Jurusan</td><td>: {{ $kriteria['jurusan'] ?? '-' }}</td></tr>
                    <tr><td>3. Pengalaman Kerja</td><td>: {{ $kriteria['pengalaman'] ?? '-' }} Tahun</td></tr>
                    <tr><td>4. IPK Minimal</td><td>: {{ $kriteria['ipk'] ?? '-' }}</td></tr>
                    <tr><td>5. Keahlian</td><td>: {{ $kriteria['keahlian'] ?? '-' }}</td></tr>
                </table>
            </div>

            <div class="signature-area">
                <!-- DIAJUKAN OLEH (PEMOHON) -->
                <div class="sign-box">
                    <span class="signature-title">Diajukan Oleh</span>
                    <div class="qr-area">
                        @if(isset($qrCodePemohon))
                            {!! $qrCodePemohon !!}
                        @elseif(isset($qrCode))
                            {!! $qrCode !!}
                        @else
                            &nbsp;
                        @endif
                    </div>
                    <div class="ssign-name"> {{ $pengajuan->nama_pemohon ?? '' }}    </div>
                    <b>PEMOHON</b>
                </div>

                <!-- DIKETAHUI OLEH (MANAGER) -->
                <div class="sign-box dik">
                    <span class="signature-title">Diketahui Oleh</span>
                    <div id="iden" class="flex-container">
                        <div id="iden" class="sub-sign">
                            <div class="qr-area">
                                @if($pengajuan->status == 'pending')
                                @endif

                                @if($pengajuan->status == 'disetujui')
                                    @if(isset($qrCodeManager))
                                        {!! $qrCodeManager !!}
                                    @else
                                        &nbsp;
                                    @endif
                                @endif
                            </div>
                            <div class="sign-name">{{ $pengajuan->disetujui_oleh ?? 'Pending / Tidak disetujui' }}</div>
                            <b style="text-transform: uppercase;">{{ $pengajuan->jabatan_penyetuju ?? '-' }}</b>
                        </div>
                        <div id="iden" class="sub-sign">
                            <div class="qr-area"></div>
                            <div class="sign-name" style="color: transparent;">hrd</div>
                            <b>HRD</b>
                        </div>
                    </div>
                </div>

                <!-- DISETUJUI OLEH (sesuai jenis) -->
                @if($pengajuan->jenis == 'penggantian')
                    <div class="sign-box">
                        <span class="signature-title">Disetujui Oleh</span>
                        <div class="qr-area"></div>
                        <div class="sign-name">Rusli Adna Solihin</div>
                        <b>PLANT MANAGER / NSM</b>
                    </div>
                @elseif($pengajuan->jenis == 'penambahan')
                    <div class="sign-box dik">
                        <span class="signature-title">Disetujui Oleh</span>
                        <div class="flex-container">
                            <div class="sub-sign">
                                <div class="qr-area"></div>
                                <div class="sign-name">Rusli Adna Solihin</div>
                                <b>PLANT MANAGER / NSM</b>
                            </div>
                            <div class="sub-sign">
                                <div class="qr-area"></div>
                                <div class="sign-name">Ishana Mahisa</div>
                                <b>DIREKTUR UTAMA</b>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="sign-box">
                        <span class="signature-title">Disetujui Oleh</span>
                        <div class="qr-area"></div>
                        <div class="sign-name">Rusli Adna Solihin</div>
                        <b>PLANT MANAGER</b>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <button class="print-btn no-print" onclick="window.print()">Print</button>

    </body>
    </html>