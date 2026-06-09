```blade
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Form Permintaan Tenaga Kerja</title>

<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    body{
        font-family:"Times New Roman", serif;
        font-size:12px;
        color:#000;
        padding:15px;
    }

    @page{
        size:A4;
        margin:15mm;
    }

    .container{
        width:100%;
    }

    /* HEADER */

    .header-table{
        width:100%;
        border-collapse:collapse;
        margin-bottom:20px;
    }

    .header-table td{
        border:1px solid #000;
        padding:8px;
    }

    .logo-cell{
        width:120px;
        text-align:center;
    }

    .logo-cell img{
        width:70px;
        height:auto;
    }

    .title-cell{
        text-align:center;
        font-size:20px;
        font-weight:bold;
        line-height:1.3;
    }

    .info-cell,
    .value-cell{
        font-size:11px;
        vertical-align:top;
    }

    /* FORM */

    .form-table{
        width:100%;
        border-collapse:collapse;
        margin-bottom:15px;
    }

    .form-table td{
        padding:4px;
        vertical-align:top;
    }

    .section{
        margin-top:15px;
        margin-bottom:15px;
    }

    .section-title{
        font-weight:bold;
        margin-bottom:10px;
    }

    ol{
        margin-left:20px;
        margin-top:5px;
    }

    ol li{
        margin-bottom:5px;
    }

    /* SIGN */

    .signature-area{
        margin-top:80px;
        display:flex;
        justify-content:space-between;
        text-align:center;
    }

    .sign-box{
        width:23%;
        font-size:12px;
    }

    .sign-name{
        margin-top:70px;
    }

    .line{
        border-top:1px solid #000;
        margin-top:70px;
        padding-top:5px;
    }

    .no-print{
        text-align:center;
        margin-top:20px;
    }

    @media print{
        .no-print{
            display:none;
        }

        body{
            padding:0;
        }
    }
</style>
</head>

<body>

@php
    $kriteria = is_array($pengajuan->kriteria)
        ? $pengajuan->kriteria
        : json_decode($pengajuan->kriteria, true);

    $tugas = is_array($pengajuan->tugas)
        ? $pengajuan->tugas
        : json_decode($pengajuan->tugas, true);
@endphp

<div class="container">

    <!-- HEADER -->

    <table class="header-table">
        <tr>

            <td class="logo-cell">
                <img src="https://via.placeholder.com/70x70?text=LOGO" alt="Logo">
            </td>

            <td class="title-cell">
                FORM<br>
                PERMINTAAN TENAGA KERJA
            </td>

            <td class="info-cell">
                Nomor Dokumen<br>
                Revisi<br>
                Tanggal Efektif<br>
                Halaman
            </td>

            <td class="value-cell">
                FRM.HRD.05.07<br>
                00<br>
                {{ date('d M Y') }}<br>
                1 dari 1
            </td>

        </tr>
    </table>

    <!-- DATA PERMINTAAN -->

    <table class="form-table">

        <tr>
            <td width="220">Nama Jabatan</td>
            <td>: {{ $pengajuan->posisi }}</td>
        </tr>

        <tr>
            <td>Unit Kerja</td>
            <td>: {{ $pengajuan->divisi->nama_divisi ?? '-' }}</td>
        </tr>

        <tr>
            <td>Jumlah Dibutuhkan</td>
            <td>: {{ $pengajuan->jumlah }} Orang</td>
        </tr>

        <tr>
            <td>Tanggal Dibutuhkan</td>
            <td>:
                {{ $pengajuan->tanggal_dibutuhkan
                    ? \Carbon\Carbon::parse($pengajuan->tanggal_dibutuhkan)->format('d/m/Y')
                    : '-' }}
            </td>
        </tr>

    </table>

    <!-- KEBUTUHAN -->

    <div class="section">

        <div class="section-title">
            Kebutuhan Untuk :
        </div>

        <p>
            ( {{ $pengajuan->jenis == 'rencana' ? '✓' : '&nbsp;' }} )
            Sesuai Rencana
        </p>

        <p>
            ( {{ $pengajuan->jenis == 'penambahan' ? '✓' : '&nbsp;' }} )
            Penambahan
        </p>

        <p>
            ( {{ $pengajuan->jenis == 'penggantian' ? '✓' : '&nbsp;' }} )
            Penggantian
        </p>

        <br>

        <p>
            Jika Penggantian, Menggantikan Siapa :
            ............................................................
        </p>

    </div>

    <!-- TUGAS -->

    <div class="section">

        <div class="section-title">
            Tugas dan Tanggung Jawab :
        </div>

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

    <!-- SPESIFIKASI -->

    <div class="section">

        <div class="section-title">
            Spesifikasi Calon :
        </div>

        <table class="form-table">

            <tr>
                <td width="220">1. Pendidikan Minimal</td>
                <td>: {{ $kriteria['pendidikan'] ?? '-' }}</td>
            </tr>

            <tr>
                <td>2. Jurusan</td>
                <td>: {{ $kriteria['jurusan'] ?? '-' }}</td>
            </tr>

            <tr>
                <td>3. Pengalaman Kerja</td>
                <td>: {{ $kriteria['pengalaman'] ?? '-' }} Tahun</td>
            </tr>

            <tr>
                <td>4. IPK Minimal</td>
                <td>: {{ $kriteria['ipk'] ?? '-' }}</td>
            </tr>

            <tr>
                <td>5. Keahlian</td>
                <td>: {{ $kriteria['keahlian'] ?? '-' }}</td>
            </tr>

        </table>

    </div>

    <!-- TANDA TANGAN -->

    <div class="signature-area">

        <div class="sign-box">

            Diajukan Oleh

            <div class="sign-name">
                <u>{{ $pengajuan->nama_pemohon ?? '-' }}</u>
            </div>

            Pemohon

        </div>

        <div class="sign-box">

            Diketahui Oleh

            <div class="line">
                Atasan Langsung
            </div>

        </div>

        <div class="sign-box">

            <br>

            <div class="line">
                HRD
            </div>

        </div>

        <div class="sign-box">

            Disetujui Oleh

            <div class="sign-name">
                <u>{{ $pengajuan->disetujui_oleh ?? '................' }}</u>
            </div>

            Plant Manager / NSM

        </div>

    </div>

</div>

<div class="no-print">

    <button onclick="window.print()"
        style="padding:10px 20px;border:none;background:#333;color:white;cursor:pointer;">
        Print
    </button>

</div>

</body>
</html>
```
