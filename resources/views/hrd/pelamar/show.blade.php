@extends('layouts.app')

@section('title', 'Detail Pelamar')

@section('header', 'Detail Pelamar')
@section('subheader', 'Informasi lengkap pelamar')

@push('styles')
<style>
    @media print {
        .no-print {
            display: none !important;
        }

        body {
            background: white;
            padding: 20px;
        }

        .bg-white {
            background: white !important;
            box-shadow: none !important;
        }

        .shadow {
            box-shadow: none !important;
        }

        .rounded-lg {
            border-radius: 0 !important;
        }
    }
</style>
@endpush

@section('content')

<!-- Tombol Print -->
<div class="flex justify-end mb-4 no-print">
    <button onclick="window.print()"
        class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark flex items-center">
        <i class="fas fa-print mr-2"></i> Print / Cetak
    </button>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Informasi Pelamar -->
    <div class="lg:col-span-2">

        <!-- DATA DIRI -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Data Diri</h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-xs text-gray-500">Nama Lengkap</label>
                        <p class="font-medium">{{ $pelamar->nama_lengkap }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Email</label>
                        <p class="font-medium">{{ $pelamar->email }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">No Telepon/WA</label>
                        <p class="font-medium">{{ $pelamar->no_telepon }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Tempat, Tanggal Lahir</label>
                        <p class="font-medium">
                            {{ $pelamar->tempat_lahir }},
                            {{ \Carbon\Carbon::parse($pelamar->tanggal_lahir)->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-xs text-gray-500">Alamat</label>
                        <p class="font-medium">{{ $pelamar->alamat }}</p>
                    </div>

                </div>
            </div>
        </div>

        <!-- DATA LENGKAP PELAMAR -->
        @if($pelamar->detail)
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Data Lengkap Pelamar</h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-xs text-gray-500">Nama Lengkap</label>
                        <p class="font-medium">{{ $pelamar->detail->nama_lengkap }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Jenis Kelamin</label>
                        <p class="font-medium">
                            {{ $pelamar->detail->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Tempat, Tanggal Lahir</label>
                        <p class="font-medium">
                            {{ $pelamar->detail->tempat_lahir }},
                            {{ \Carbon\Carbon::parse($pelamar->detail->tanggal_lahir)->format('d/m/Y') }}
                        </p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Agama</label>
                        <p class="font-medium">{{ $pelamar->detail->agama }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">No KTP</label>
                        <p class="font-medium">{{ $pelamar->detail->no_ktp }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Status Perkawinan</label>
                        <p class="font-medium">{{ $pelamar->detail->status_perkawinan }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Alamat Tinggal</label>
                        <p class="font-medium">{{ $pelamar->detail->alamat_tinggal }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">No HP</label>
                        <p class="font-medium">{{ $pelamar->detail->no_hp }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Email</label>
                        <p class="font-medium">{{ $pelamar->detail->email }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Golongan Darah</label>
                        <p class="font-medium">{{ $pelamar->detail->golongan_darah ?? '-' }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Kewarganegaraan</label>
                        <p class="font-medium">{{ $pelamar->detail->kewarganegaraan ?? '-' }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">No NPWP</label>
                        <p class="font-medium">{{ $pelamar->detail->no_npwp ?? '-' }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">BPJS Ketenagakerjaan</label>
                        <p class="font-medium">{{ $pelamar->detail->no_bpjs_ketenagakerjaan ?? '-' }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Hobby</label>
                        <p class="font-medium">{{ $pelamar->detail->hobby ?? '-' }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Organisasi</label>
                        <p class="font-medium">{{ $pelamar->detail->organisasi ?? '-' }}</p>
                    </div>

                </div>
            </div>
        </div>
        @endif

        <!-- PENDIDIKAN -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Pendidikan & Pengalaman</h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-xs text-gray-500">Pendidikan Terakhir</label>
                        <p class="font-medium">{{ $pelamar->pendidikan_terakhir }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Jurusan</label>
                        <p class="font-medium">{{ $pelamar->jurusan }}</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Tahun Lulus</label>
                        <p class="font-medium">{{ $pelamar->tahun_lulus }}</p>
                    </div>

                    @php
                        $ipkJawaban = $pelamar->formulirJawaban->where('field_name', 'ipk')->first();
                    @endphp

                    @if($ipkJawaban)
                    <div>
                        <label class="text-xs text-gray-500">IPK</label>
                        <p class="font-medium">{{ $ipkJawaban->jawaban }}</p>
                    </div>
                    @endif

                    <div class="md:col-span-2">
                        <label class="text-xs text-gray-500">Pengalaman Kerja</label>
                        <p class="font-medium">
                            {!! nl2br(e($pelamar->pengalaman_kerja)) ?: '-' !!}
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <!-- DOKUMEN -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Dokumen</h3>
            </div>

            <div class="p-6 flex gap-4 no-print">

                <a href="{{ route('hrd.pelamar.download-cv', $pelamar) }}"
                    class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark">
                    <i class="fas fa-download mr-2"></i> Download CV
                </a>

                <a href="{{ route('hrd.pelamar.download-ijazah', $pelamar) }}"
                    class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark">
                    <i class="fas fa-download mr-2"></i> Download Ijazah
                </a>

            </div>

            <div class="p-6 print-only hidden">
                <p><strong>CV:</strong> {{ $pelamar->cv_path ? 'Terlampir' : '-' }}</p>
                <p><strong>Ijazah:</strong> {{ $pelamar->ijazah_path ? 'Terlampir' : '-' }}</p>
            </div>
        </div>

    </div>

    <!-- SIDEBAR -->
    <div>

        <!-- STATUS -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Status Lamaran</h3>
            </div>

            <div class="p-6">

                <div class="mb-4">
                    <span class="px-3 py-1 rounded-full text-sm 
                        @if($pelamar->status == 'pending') bg-gray-100 text-gray-800
                        @elseif($pelamar->status == 'lolos_tahap1') bg-blue-100 text-blue-800
                        @elseif($pelamar->status == 'psikotest') bg-yellow-100 text-yellow-800
                        @elseif($pelamar->status == 'lolos_psikotest') bg-green-100 text-green-800
                        @elseif($pelamar->status == 'interview') bg-purple-100 text-purple-800
                        @elseif($pelamar->status == 'diterima') bg-green-600 text-white
                        @else bg-red-100 text-red-800
                        @endif">

                        {{ str_replace('_', ' ', ucfirst($pelamar->status)) }}

                    </span>
                </div>

                @if($pelamar->catatan)
                <div class="bg-gray-50 p-3 rounded">
                    <label class="text-xs text-gray-500">Catatan</label>
                    <p class="text-sm">{{ $pelamar->catatan }}</p>
                </div>
                @endif

            </div>
        </div>

        <!-- UPDATE STATUS -->
        <div class="bg-white rounded-lg shadow mb-6 no-print">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Update Status</h3>
            </div>

            <div class="p-6">

                <form action="{{ route('hrd.pelamar.update-status', $pelamar) }}" method="POST">

                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Status</label>

                        <select name="status" class="w-full border rounded-lg px-3 py-2">

                            <option value="pending" {{ $pelamar->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="lolos_tahap1" {{ $pelamar->status == 'lolos_tahap1' ? 'selected' : '' }}>
                                Lolos Tahap 1
                            </option>

                            <option value="psikotest" {{ $pelamar->status == 'psikotest' ? 'selected' : '' }}>
                                Psikotest
                            </option>

                            <option value="lolos_psikotest" {{ $pelamar->status == 'lolos_psikotest' ? 'selected' : '' }}>
                                Lolos Psikotest
                            </option>

                            <option value="interview" {{ $pelamar->status == 'interview' ? 'selected' : '' }}>
                                Interview
                            </option>

                            <option value="diterima" {{ $pelamar->status == 'diterima' ? 'selected' : '' }}>
                                Diterima
                            </option>

                            <option value="ditolak" {{ $pelamar->status == 'ditolak' ? 'selected' : '' }}>
                                Ditolak
                            </option>

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Catatan</label>

                        <textarea name="catatan" rows="3"
                            class="w-full border rounded-lg px-3 py-2">{{ $pelamar->catatan }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-primary text-white py-2 rounded-lg">
                        Update Status
                    </button>

                </form>

            </div>
        </div>

        <!-- INTERVIEW -->
        <div class="bg-white rounded-lg shadow no-print">

            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Jadwal Interview</h3>
            </div>

            <div class="p-6">

                <form action="{{ route('hrd.pelamar.kirim-interview', $pelamar) }}" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">
                            Tanggal Interview
                        </label>

                        <input type="date"
                            name="tanggal_interview"
                            class="w-full border rounded-lg px-3 py-2"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">
                            Waktu Interview
                        </label>

                        <input type="time"
                            name="waktu_interview"
                            class="w-full border rounded-lg px-3 py-2"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">
                            Lokasi Interview
                        </label>

                        <input type="text"
                            name="lokasi_interview"
                            class="w-full border rounded-lg px-3 py-2"
                            placeholder="Alamat lengkap..."
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">
                            Catatan Tambahan
                        </label>

                        <textarea name="catatan"
                            rows="2"
                            class="w-full border rounded-lg px-3 py-2"
                            placeholder="Persiapan yang harus dibawa dll..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">

                        <i class="fab fa-whatsapp mr-2"></i>
                        Kirim Jadwal via WhatsApp

                    </button>

                </form>

                @if(session('whatsapp_url'))
                <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded">

                    <p class="text-green-700 mb-2">
                        Klik tombol di bawah untuk mengirim pesan WhatsApp:
                    </p>

                    <a href="{{ session('whatsapp_url') }}"
                        target="_blank"
                        class="block text-center bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">

                        <i class="fab fa-whatsapp mr-2"></i>
                        Buka WhatsApp

                    </a>

                </div>
                @endif

            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    window.onbeforeprint = function() {
        document.querySelectorAll('.no-print').forEach(el => {
            el.style.display = 'none';
        });
    };

    window.onafterprint = function() {
        document.querySelectorAll('.no-print').forEach(el => {
            el.style.display = '';
        });
    };
</script>
@endpush