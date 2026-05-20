@extends('layouts.app')

@section('title', 'Buat Lowongan Baru')

@section('header', 'Buat Lowongan Baru')
@section('subheader', 'Posting lowongan pekerjaan berdasarkan pengajuan yang sudah disetujui')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('hrd.lowongan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Pengajuan yang Disetujui *</label>
            <select name="pengajuan_id" id="pengajuan_id" class="w-full border rounded-lg px-3 py-2" required>
                <option value="">-- Pilih Pengajuan --</option>
                @foreach($pengajuans as $pengajuan)
                <option value="{{ $pengajuan->id }}" data-posisi="{{ $pengajuan->posisi }}" data-kriteria='{{ $pengajuan->kriteria }}'>
                                    {{ $pengajuan->divisi->nama_divisi }} - {{ $pengajuan->posisi }} ({{ $pengajuan->jumlah }} orang)
                </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Lowongan *</label>
            <input type="text" name="judul" id="judul" class="w-full border rounded-lg px-3 py-2" required>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Banner/Poster</label>
            <input type="file" name="banner_image" accept="image/*" class="w-full border rounded-lg px-3 py-2">
            <p class="text-xs text-gray-500 mt-1">Rekomendasi ukuran: 1200x600px. Max 2MB</p>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lowongan *</label>
            <textarea name="deskripsi" rows="6" class="w-full border rounded-lg px-3 py-2" required></textarea>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai *</label>
                <input type="date" name="tanggal_mulai" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai *</label>
                <input type="date" name="tanggal_selesai" class="w-full border rounded-lg px-3 py-2" required>
            </div>
        </div>
        
        <!-- Preview Kriteria dari Pengajuan -->
        <div id="preview_kriteria" class="mb-6 p-4 bg-gray-50 rounded-lg hidden">
            <h4 class="font-semibold mb-2">Kriteria dari Pengajuan:</h4>
            <div id="kriteria_content"></div>
        </div>
        
        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('hrd.lowongan.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</a>
            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                Publikasikan Lowongan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const pengajuanSelect = document.getElementById('pengajuan_id');
    const judulInput = document.getElementById('judul');
    const previewDiv = document.getElementById('preview_kriteria');
    const kriteriaContent = document.getElementById('kriteria_content');
    
    pengajuanSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const posisi = selectedOption.getAttribute('data-posisi');
        
        if (posisi) {
            judulInput.value = `Lowongan ${posisi}`;
        }
        
        // Tampilkan preview kriteria
        const kriteriaStr = selectedOption.getAttribute('data-kriteria');
        if (kriteriaStr) {
            try {
                const kriteria = JSON.parse(kriteriaStr);
                previewDiv.classList.remove('hidden');
                let html = '<ul class="list-disc list-inside text-sm space-y-1">';
                if (kriteria.pendidikan) html += `<li>Pendidikan Minimal: ${kriteria.pendidikan}</li>`;
                if (kriteria.jurusan) html += `<li>Jurusan: ${kriteria.jurusan}</li>`;
                if (kriteria.pengalaman) html += `<li>Pengalaman: ${kriteria.pengalaman} tahun</li>`;
                if (kriteria.ipk) html += `<li>IPK Minimal: ${kriteria.ipk}</li>`;
                if (kriteria.keahlian) html += `<li>Keahlian: ${kriteria.keahlian}</li>`;
                html += '</ul>';
                kriteriaContent.innerHTML = html;
            } catch(e) {
                previewDiv.classList.add('hidden');
            }
        } else {
            previewDiv.classList.add('hidden');
        }
    });
</script>
@endpush
@endsection