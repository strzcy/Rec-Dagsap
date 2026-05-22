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
                <option value="{{ $pengajuan->id }}" 
                        data-posisi="{{ $pengajuan->posisi }}"
                        data-divisi="{{ $pengajuan->divisi->nama_divisi }}"
                        data-jumlah="{{ $pengajuan->jumlah }}">
                    [{{ $pengajuan->divisi->nama_divisi }}] - {{ $pengajuan->posisi }} ({{ $pengajuan->jumlah }} orang)
                </option>
                @endforeach
            </select>
            @if($pengajuans->isEmpty())
            <p class="text-red-500 text-sm mt-1">Belum ada pengajuan yang disetujui. Tunggu management menyetujui pengajuan terlebih dahulu.</p>
            @endif
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Lowongan *</label>
            <input type="text" name="judul" id="judul" class="w-full border rounded-lg px-3 py-2" required placeholder="Contoh: Lowongan Staff IT">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Banner/Poster</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-primary transition" id="dropzone">
                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                <p class="text-gray-500">Klik atau drag & drop file gambar disini</p>
                <p class="text-xs text-gray-400 mt-1">Rekomendasi: 1200x600px, JPG/PNG, max 2MB</p>
                <input type="file" name="banner_image" id="banner_image" accept="image/jpeg,image/png,image/jpg" class="hidden">
            </div>
            <div id="image_preview" class="mt-3 hidden">
                <img id="preview_img" class="h-32 rounded-lg object-cover">
                <button type="button" id="remove_image" class="text-red-500 text-sm mt-1">Hapus</button>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lowongan *</label>
            <textarea name="deskripsi" id="deskripsi" rows="8" class="w-full border rounded-lg px-3 py-2" required placeholder="Tuliskan deskripsi pekerjaan, tanggung jawab, dan benefit..."></textarea>
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
        
        <!-- Preview Informasi Pengajuan -->
        <div id="preview_pengajuan" class="mb-6 p-4 bg-gray-50 rounded-lg hidden">
            <h4 class="font-semibold text-primary mb-2">Informasi dari Pengajuan:</h4>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div><span class="text-gray-500">Divisi:</span> <span id="preview_divisi" class="font-medium"></span></div>
                <div><span class="text-gray-500">Posisi:</span> <span id="preview_posisi" class="font-medium"></span></div>
                <div><span class="text-gray-500">Jumlah:</span> <span id="preview_jumlah" class="font-medium"></span> orang</div>
            </div>
        </div>
        
        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('hrd.lowongan.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</a>
            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                <i class="fas fa-paper-plane mr-2"></i> Publikasikan Lowongan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const pengajuanSelect = document.getElementById('pengajuan_id');
    const judulInput = document.getElementById('judul');
    const deskripsiInput = document.getElementById('deskripsi');
    const previewDiv = document.getElementById('preview_pengajuan');
    
    pengajuanSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const posisi = selectedOption.getAttribute('data-posisi');
        const divisi = selectedOption.getAttribute('data-divisi');
        const jumlah = selectedOption.getAttribute('data-jumlah');
        
        if (posisi) {
            judulInput.value = `Lowongan ${posisi} - ${divisi}`;
            deskripsiInput.value = `Kami membuka lowongan untuk posisi ${posisi} di Divisi ${divisi}.\n\nKualifikasi:\n- Memenuhi kriteria yang telah ditentukan\n- Bersedia bekerja dengan target\n- Memiliki integritas tinggi\n\nJumlah yang dibutuhkan: ${jumlah} orang\n\nKirimkan lamaran Anda sebelum batas waktu yang ditentukan.`;
            
            document.getElementById('preview_divisi').textContent = divisi;
            document.getElementById('preview_posisi').textContent = posisi;
            document.getElementById('preview_jumlah').textContent = jumlah;
            previewDiv.classList.remove('hidden');
        } else {
            previewDiv.classList.add('hidden');
        }
    });
    
    // Image upload handling
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('banner_image');
    const imagePreview = document.getElementById('image_preview');
    const previewImg = document.getElementById('preview_img');
    
    dropzone.addEventListener('click', () => fileInput.click());
    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('border-primary', 'bg-primary-light');
    });
    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('border-primary', 'bg-primary-light');
    });
    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-primary', 'bg-primary-light');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            fileInput.files = e.dataTransfer.files;
            previewImage(file);
        }
    });
    
    fileInput.addEventListener('change', (e) => {
        if (e.target.files[0]) {
            previewImage(e.target.files[0]);
        }
    });
    
    function previewImage(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImg.src = e.target.result;
            imagePreview.classList.remove('hidden');
            dropzone.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
    
    document.getElementById('remove_image').addEventListener('click', () => {
        fileInput.value = '';
        imagePreview.classList.add('hidden');
        dropzone.classList.remove('hidden');
    });
</script>
@endpush
@endsection