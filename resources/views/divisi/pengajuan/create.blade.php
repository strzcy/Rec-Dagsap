@extends('layouts.app')

@section('title', 'Form Permintaan Tenaga Kerja')

@section('header', 'Form Permintaan Tenaga Kerja')
@section('subheader', 'Silakan isi formulir permintaan tenaga kerja di bawah ini')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('divisi.pengajuan.store') }}" method="POST">
        @csrf
        
        <!-- Header Form -->
        <div class="border-b pb-4 mb-6">
            <h2 class="text-xl font-semibold text-primary">PERMINTAAN TENAGA KERJA</h2>
        </div>

        <!-- Tambahkan setelah header form -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Diajukan Oleh (Nama Lengkap) *</label>
            <input type="text" name="diajukan_oleh" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" 
                placeholder="Contoh: Ahmad Supriyadi, S.T." required>
            <p class="text-xs text-gray-500 mt-1">Isi dengan nama lengkap pengaju</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Jabatan *</label>
                <input type="text" name="posisi" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Unit Kerja</label>
                <input type="text" value="{{ Auth::user()->divisi->nama_divisi ?? '-' }}" class="w-full border rounded-lg px-3 py-2 bg-gray-100" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Dibutuhkan *</label>
                <input type="number" name="jumlah" min="1" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" required>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dibutuhkan *</label>
                <input type="date" name="tanggal_dibutuhkan" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kebutuhan Untuk *</label>
                <div class="flex space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="jenis" value="penambahan" class="mr-2" required> Penambahan
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="jenis" value="penggantian" class="mr-2"> Penggantian
                    </label>
                </div>
            </div>
        </div>
        
        <div class="mb-6" id="penggantian_field" style="display: none;">
            <label class="block text-sm font-medium text-gray-700 mb-2">Jika penggantian, menggantikan siapa?</label>
            <input type="text" name="menggantikan" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" placeholder="Nama karyawan yang digantikan">
        </div>
        
        <!-- Tugas dan Tanggung Jawab -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Tugas dan Tanggung Jawab *</label>
            <div id="tugas_list">
                <div class="flex mb-2">
                    <input type="text" name="tugas[]" class="flex-1 border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" placeholder="1. ..." required>
                    <button type="button" onclick="removeTugas(this)" class="ml-2 text-red-500 hover:text-red-700">✕</button>
                </div>
            </div>
            <button type="button" onclick="addTugas()" class="mt-2 text-primary hover:text-primary-dark text-sm">
                + Tambah Tugas
            </button>
        </div>
        
        <!-- Spesifikasi Calon -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-3">Spesifikasi Calon *</label>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Pendidikan Minimal</label>
                    <select name="kriteria_pendidikan" class="w-full border rounded-lg px-3 py-2" required>
                        <option value="">Pilih Pendidikan</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="D3">D3</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Jurusan</label>
                    <input type="text" name="kriteria_jurusan" class="w-full border rounded-lg px-3 py-2" placeholder="Contoh: Teknik Informatika">
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Pengalaman Kerja Minimal</label>
                    <select name="kriteria_pengalaman" class="w-full border rounded-lg px-3 py-2">
                        <option value="0">Fresh Graduate</option>
                        <option value="1">1 Tahun</option>
                        <option value="2">2 Tahun</option>
                        <option value="3">3 Tahun</option>
                        <option value="5">5 Tahun</option>
                        <option value="10">10+ Tahun</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">IPK Minimal (jika S1)</label>
                    <input type="text" name="kriteria_ipk" class="w-full border rounded-lg px-3 py-2" placeholder="Contoh: 3.00">
                </div>
            </div>
            
            <div>
                <label class="block text-xs text-gray-500 mb-1">Keahlian yang Dibutuhkan</label>
                <textarea name="kriteria_keahlian" rows="3" class="w-full border rounded-lg px-3 py-2" placeholder="Pisahkan dengan koma, contoh: PHP, Laravel, MySQL, JavaScript"></textarea>
            </div>
        </div>
        
        <!-- Persyaratan Lainnya -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Persyaratan Lainnya</label>
            <div id="persyaratan_list">
                <div class="flex mb-2">
                    <input type="text" name="persyaratan[]" class="flex-1 border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" placeholder="Contoh: Bersedia ditempatkan di seluruh Indonesia">
                    <button type="button" onclick="removePersyaratan(this)" class="ml-2 text-red-500 hover:text-red-700">✕</button>
                </div>
            </div>
            <button type="button" onclick="addPersyaratan()" class="mt-2 text-primary hover:text-primary-dark text-sm">
                + Tambah Persyaratan
            </button>
        </div>
        
        <!-- Deskripsi Pekerjaan -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Pekerjaan</label>
            <textarea name="deskripsi_pekerjaan" rows="4" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" placeholder="Jelaskan secara detail tentang pekerjaan ini..."></textarea>
        </div>
        
        <!-- Submit Button -->
        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('divisi.pengajuan.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</a>
            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                Ajukan Permintaan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Show/hide penggantian field based on radio selection
    document.querySelectorAll('input[name="jenis"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const penggantianField = document.getElementById('penggantian_field');
            if (this.value === 'penggantian') {
                penggantianField.style.display = 'block';
            } else {
                penggantianField.style.display = 'none';
            }
        });
    });
    
    // Add Tugas
    function addTugas() {
        const container = document.getElementById('tugas_list');
        const index = container.children.length + 1;
        const div = document.createElement('div');
        div.className = 'flex mb-2';
        div.innerHTML = `
            <input type="text" name="tugas[]" class="flex-1 border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" placeholder="${index}. ..." required>
            <button type="button" onclick="removeTugas(this)" class="ml-2 text-red-500 hover:text-red-700">✕</button>
        `;
        container.appendChild(div);
    }
    
    function removeTugas(btn) {
        const container = document.getElementById('tugas_list');
        if (container.children.length > 1) {
            btn.parentElement.remove();
            // Update placeholders
            Array.from(container.children).forEach((child, idx) => {
                const input = child.querySelector('input');
                if (input) input.placeholder = `${idx + 1}. ...`;
            });
        }
    }
    
    // Add Persyaratan
    function addPersyaratan() {
        const container = document.getElementById('persyaratan_list');
        const div = document.createElement('div');
        div.className = 'flex mb-2';
        div.innerHTML = `
            <input type="text" name="persyaratan[]" class="flex-1 border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" placeholder="Persyaratan tambahan...">
            <button type="button" onclick="removePersyaratan(this)" class="ml-2 text-red-500 hover:text-red-700">✕</button>
        `;
        container.appendChild(div);
    }
    
    function removePersyaratan(btn) {
        const container = document.getElementById('persyaratan_list');
        if (container.children.length > 1) {
            btn.parentElement.remove();
        }
    }
</script>
@endpush
@endsection