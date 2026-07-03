@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')

<div>
    <section class="hero-gradient text-primary py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-1xl font-bold mb-4">Selamat Datang di Dashboard User</h1>
            <p class="text-lg md:text-xl mb-8 opacity-90">Di dashboard ini, anda bisa mengajukan Permintaan Tenaga Kerja (PTK) Penambahan maupun Penggantian</p>
            <div>
                <a href="{{ route('divisi.pengajuan.create') }}" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark inline-block">
                    Ajukan Form PTK
                </a>
            </div>
        </div>
    </section>
</div>

<!-- Modal Popup Sukses Submit -->
@if(session('success_submit'))
@php $ptkData = session('ptk_data'); @endphp
<div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-lg w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="text-center p-6">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Berhasil!</h3>
            <p class="text-sm text-gray-500 mb-4">{{ session('success_message') }}</p>
            
            @if($ptkData)
            <!-- Detail Pemohon -->
            <div class="bg-blue-50 rounded-lg p-4 mb-4 text-left">
                <p class="text-xs text-gray-500 mb-2 font-semibold">IDENTITAS PEMOHON</p>
                <div class="space-y-1 text-sm">
                    <p><span class="font-medium">Nama:</span> {{ $ptkData['nama_pemohon'] }}</p>
                    <p><span class="font-medium">Jabatan:</span> {{ $ptkData['jabatan_pemohon'] }}</p>
                </div>
            </div>
            
            <!-- Detail Pengajuan -->
            <div class="bg-gray-50 rounded-lg p-4 mb-4 text-left">
                <p class="text-xs text-gray-500 mb-2 font-semibold">DETAIL PENGAJUAN</p>
                <div class="space-y-1 text-sm">
                    <p><span class="font-medium">No. PTK:</span> PTK-{{ str_pad($ptkData['id'], 6, '0', STR_PAD_LEFT) }}</p>
                    <p><span class="font-medium">Posisi:</span> {{ $ptkData['posisi'] }}</p>
                    <p><span class="font-medium">Divisi:</span> {{ $ptkData['divisi'] }}</p>
                    <p><span class="font-medium">Jumlah:</span> {{ $ptkData['jumlah'] }} orang</p>
                    <p><span class="font-medium">Tanggal Dibutuhkan:</span> {{ $ptkData['tanggal_dibutuhkan'] }}</p>
                </div>
            </div>
            
            <!-- Waktu Pengajuan & Screenshot -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                <p class="text-yellow-800 text-sm">
                    <i class="fas fa-camera mr-2"></i>
                    <strong>Silakan screenshot halaman ini untuk bukti pengajuan!</strong>
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    <span class="font-medium">Waktu Pengajuan:</span> {{ $ptkData['waktu_pengajuan'] ?? now()->format('d/m/Y H:i:s') }}
                </p>
            </div>
            
            <!-- Tombol Notifikasi -->
            <div class="grid grid-cols-2 gap-3 mb-4">
                <!-- Tombol Email -->
                @php
                    $emailSubject = rawurlencode("Notifikasi Pengajuan PTK - " . $ptkData['posisi']);
                    $emailBody = rawurlencode(
                        "Yth. Management " . $ptkData['divisi'] . ",\n\n" .
                        "Saya ingin memberitahukan bahwa telah dilakukan pengajuan Permintaan Tenaga Kerja (PTK) dengan detail sebagai berikut:\n\n" .
                        "📋 DETAIL PENGAJUAN:\n" .
                        "No. PTK: PTK-" . str_pad($ptkData['id'], 6, '0', STR_PAD_LEFT) . "\n" .
                        "Posisi: " . $ptkData['posisi'] . "\n" .
                        "Divisi: " . $ptkData['divisi'] . "\n" .
                        "Jumlah: " . $ptkData['jumlah'] . " orang\n" .
                        "Tanggal Dibutuhkan: " . $ptkData['tanggal_dibutuhkan'] . "\n" .
                        "Area Penempatan: " . $ptkData['area_penempatan'] . "\n" .
                        ($ptkData['toko_penempatan'] != '-' ? "Toko Penempatan: " . $ptkData['toko_penempatan'] . "\n" : "") .
                        "Jenis: " . ($ptkData['jenis'] == 'penambahan' ? 'Penambahan' : 'Penggantian') . "\n\n" .
                        "👤 IDENTITAS PEMOHON:\n" .
                        "Nama: " . $ptkData['nama_pemohon'] . "\n" .
                        "NIP/NIK: " . $ptkData['nip_pemohon'] . "\n" .
                        "Jabatan: " . $ptkData['jabatan_pemohon'] . "\n" .
                        "No. HP: " . $ptkData['no_hp_pemohon'] . "\n\n" .
                        "Waktu Pengajuan: " . $ptkData['waktu_pengajuan'] . "\n\n" .
                        "Mohon segera diproses.\n\n" .
                        "Terima kasih.\n" .
                        $ptkData['nama_pemohon']
                    );
                    $emailManagement = $ptkData['email_management'] ?? 'hrd@dagsap.com';
                @endphp
    
                <a href="mailto:{{ $emailManagement }}?subject={{ $emailSubject }}&body={{ $emailBody }}" 
                   target="_blank" 
                   class="flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition text-sm">
                    <i class="fas fa-envelope"></i> Email
                </a>
    
                <!-- Tombol WhatsApp -->
                @php
                    $waMessage = rawurlencode(
            
                        "Permisi, Saya " . $ptkData['nama_pemohon'] . " telah mengajukan PTK.\n\n" .
                        "• Posisi: " . $ptkData['posisi'] . "\n" .
                        "• Jumlah: " . $ptkData['jumlah'] . " orang\n" .
                        "• Dibutuhkan pad: " . $ptkData['tanggal_dibutuhkan'] . "\n" .
                        "• Divisi: " . $ptkData['divisi'] . "\n\n" .
                        "Mohon segera diproses. Terima kasih."
                    );
                    $noHpManagement = '6281294491075'; // Ganti dengan nomor management sebenarnya
                @endphp
    
                <a href="https://api.whatsapp.com/send?phone={{ $noHpManagement }}&text={{ $waMessage }}" 
                   target="_blank" 
                   class="flex items-center justify-center gap-2 bg-green-600 text-white px-4 py-3 rounded-lg hover:bg-green-700 transition text-sm">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
            </div>
            @endif
            
            <!-- Tombol Navigasi -->
            <div class="flex gap-3">
                <a href="{{ route('divisi.dashboard') }}" class="flex-1 bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition">
                    <i class="fas fa-home mr-2"></i> Ke Dashboard
                </a>
                <a href="{{ route('divisi.pengajuan.create') }}" class="flex-1 border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-plus-circle mr-2"></i> Buat Lagi
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Tutup modal jika klik di luar
    document.getElementById('successModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });
</script>
@endif

@endsection