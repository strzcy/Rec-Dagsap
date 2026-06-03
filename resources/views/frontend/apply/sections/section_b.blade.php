<div>
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">B. RIWAYAT PENDIDIKAN</h2>
    
    <div class="mb-6">
        <h3 class="font-semibold text-gray-700 mb-3">1. Pendidikan Formal</h3>
        
        <div id="pendidikan-formal-container">
            <div class="pendidikan-formal-item bg-gray-50 p-4 rounded-lg mb-3">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div><input type="text" name="pendidikan_tingkat[]" placeholder="Tingkat Pendidikan (SD/SMP/SMA/D3/S1/S2)" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="pendidikan_nama[]" placeholder="Nama Sekolah/Universitas" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="pendidikan_kota[]" placeholder="Kota" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="pendidikan_jurusan[]" placeholder="Jurusan" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="number" name="pendidikan_tahun_masuk[]" placeholder="Tahun Masuk" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="number" name="pendidikan_tahun_lulus[]" placeholder="Tahun Lulus" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="pendidikan_ipk[]" placeholder="IPK/Nilai" class="w-full border rounded-lg px-3 py-2"></div>
                    <div class="md:col-span-2"><input type="text" name="pendidikan_keterangan[]" placeholder="Keterangan" class="w-full border rounded-lg px-3 py-2"></div>
                </div>
                <button type="button" class="remove-pendidikan text-red-500 text-sm mt-2 hover:text-red-700">Hapus</button>
            </div>
        </div>
        <button type="button" id="tambah-pendidikan" class="text-primary text-sm hover:text-primary-dark mt-2">
            <i class="fas fa-plus mr-1"></i> Tambah Pendidikan
        </button>
    </div>
    
    <div>
        <h3 class="font-semibold text-gray-700 mb-3">2. Pelatihan/Kursus</h3>
        
        <div id="pelatihan-container">
            <div class="pelatihan-item bg-gray-50 p-4 rounded-lg mb-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div><input type="text" name="pelatihan_nama[]" placeholder="Nama Pelatihan/Kursus" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="date" name="pelatihan_tgl_mulai[]" placeholder="Tanggal Mulai" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="date" name="pelatihan_tgl_selesai[]" placeholder="Tanggal Selesai" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="pelatihan_lembaga[]" placeholder="Lembaga Penyelenggara" class="w-full border rounded-lg px-3 py-2"></div>
                    <div class="md:col-span-2"><input type="text" name="pelatihan_sertifikat[]" placeholder="Sertifikat (Ada/Tidak)" class="w-full border rounded-lg px-3 py-2"></div>
                </div>
                <button type="button" class="remove-pelatihan text-red-500 text-sm mt-2 hover:text-red-700">Hapus</button>
            </div>
        </div>
        <button type="button" id="tambah-pelatihan" class="text-primary text-sm hover:text-primary-dark mt-2">
            <i class="fas fa-plus mr-1"></i> Tambah Pelatihan
        </button>
    </div>
</div>

@push('scripts')
<script>
    // Tambah Pendidikan
    document.getElementById('tambah-pendidikan')?.addEventListener('click', function() {
        const container = document.getElementById('pendidikan-formal-container');
        const template = container.children[0].cloneNode(true);
        template.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(template);
        
        template.querySelector('.remove-pendidikan')?.addEventListener('click', function() {
            if (container.children.length > 1) {
                template.remove();
            }
        });
    });
    
    // Tambah Pelatihan
    document.getElementById('tambah-pelatihan')?.addEventListener('click', function() {
        const container = document.getElementById('pelatihan-container');
        const template = container.children[0].cloneNode(true);
        template.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(template);
        
        template.querySelector('.remove-pelatihan')?.addEventListener('click', function() {
            if (container.children.length > 1) {
                template.remove();
            }
        });
    });
    
    // Remove listeners untuk existing items
    document.querySelectorAll('.remove-pendidikan').forEach(btn => {
        btn.addEventListener('click', function() {
            const container = document.getElementById('pendidikan-formal-container');
            if (container.children.length > 1) {
                this.closest('.pendidikan-formal-item').remove();
            }
        });
    });
    
    document.querySelectorAll('.remove-pelatihan').forEach(btn => {
        btn.addEventListener('click', function() {
            const container = document.getElementById('pelatihan-container');
            if (container.children.length > 1) {
                this.closest('.pelatihan-item').remove();
            }
        });
    });
</script>
@endpush