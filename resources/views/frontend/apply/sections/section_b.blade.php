
<div>
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">B. RIWAYAT PENDIDIKAN</h2>
    <label class="block text-sm font-medium mb-2">Riwayat Pendidikan yang pernah ditempuh (urutkan dari yang terlama)</label>

    <div class="mb-6">
        <h3 class="font-semibold text-gray-700 mb-3">1. Pendidikan Formal</h3>
        
        <!-- 1. Pendidikan Formal -->
        <div id="pendidikan-formal-container">
            <div class="pendidikan-formal-item bg-gray-50 p-4 rounded-lg mb-3">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs text-gray-700 font-medium mb-2">Tingkat Pendidikan</label>
                        <select name="pendidikan_tingkat[]" class="pendidikan-tingkat w-full border rounded-lg px-3 py-2" required>
                            <option value="">Pilih</option>
                            <option value="SD Sederajat">SD Sederajat</option>
                            <option value="SLTP">SLTP</option>
                            <option value="SLTA">SLTA</option>
                            <option value="Diploma">Diploma</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-700 font-medium mb-2">Nama Sekolah/Universitas</label>
                        <input type="text" name="pendidikan_nama[]" class="w-full border rounded-lg px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-700 font-medium mb-2">Kota</label>
                        <input type="text" name="pendidikan_kota[]" class="w-full border rounded-lg px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-700 font-medium mb-2">Jurusan</label>
                        <input type="text" name="pendidikan_jurusan[]" class="w-full border rounded-lg px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-700 font-medium mb-2">Tahun Masuk</label>
                        <input type="number" name="pendidikan_tahun_masuk[]" class="pendidikan-tahun-masuk w-full border rounded-lg px-3 py-2" min="1950" max="{{ date('Y') }}">
                        <p class="text-xs text-gray-400 mt-1" id="info_masuk_0"></p>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-700 font-medium mb-2">Tahun Lulus</label>
                        <input type="number" name="pendidikan_tahun_lulus[]" class="pendidikan-tahun-lulus w-full border rounded-lg px-3 py-2" min="1950" max="{{ date('Y') }}">
                        <p class="text-xs text-gray-400 mt-1" id="info_lulus_0"></p>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-700 font-medium mb-2">IPK/Nilai</label>
                        <input type="text" name="pendidikan_ipk[]" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs text-gray-700 font-medium mb-2">Keterangan</label>
                        <input type="text" name="pendidikan_keterangan[]" class="w-full border rounded-lg px-3 py-2">
                    </div>
                </div>
        
                <!-- Field Alasan Ketidaksesuaian (hidden by default) -->
                <div class="alasan-pendidikan mt-3 hidden">
                    <label class="block text-xs text-orange-600 font-medium mb-1">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        Alasan Ketidaksesuaian Jenjang Pendidikan
                    </label>
                    <textarea name="pendidikan_alasan[]" rows="2" class="w-full border border-orange-300 rounded-lg px-3 py-2" placeholder="Jelaskan mengapa jenjang pendidikan Anda tidak sesuai dengan standar (contoh: akselerasi, pindah sekolah, dll)"></textarea>
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
                    <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤNama Pelatihan / Kursus</label>
                        <input type="text" name="pelatihan_nama[]"class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤTanggal Mulai</label>
                        <input type="date" name="pelatihan_tgl_mulai[]" placeholder="Tanggal Mulai" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤTanggal Selesai</label>
                        <input type="date" name="pelatihan_tgl_selesai[]" placeholder="Tanggal Selesai" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤLembaga Penyelenggara</label>
                        <input type="text" name="pelatihan_lembaga[]" class="w-full border rounded-lg px-3 py-2"></div>
                    <div class="md:col-span-2"> <label class="block text-xs text-gray-700 font-medium mb-2">ㅤSertifikat</label>
                        <input type="text" name="pelatihan_sertifikat[]" placeholder="(Ada/Tidak)" class="w-full border rounded-lg px-3 py-2"></div>
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
    // ============================================
    // PENDIDIKAN FORMAL
    // ============================================
    function updateRemovePendidikan() {
        const items = document.querySelectorAll('#pendidikan-formal-container .pendidikan-formal-item');
        const buttons = document.querySelectorAll('#pendidikan-formal-container .remove-pendidikan');
    
        buttons.forEach(btn => {
            if (items.length > 1) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
    }

    // Setup tambah pendidikan
    document.getElementById('tambah-pendidikan')?.addEventListener('click', function() {
        const container = document.getElementById('pendidikan-formal-container');
        const template = container.children[0].cloneNode(true);
        template.querySelectorAll('input, select, textarea').forEach(input => {
            if (input.type !== 'radio' && input.type !== 'checkbox') {
                input.value = '';
            }
        });
        // Reset alasan
        const alasanField = template.querySelector('.alasan-pendidikan');
        if (alasanField) alasanField.classList.add('hidden');
    
        container.appendChild(template);
    
        // Setup remove untuk item baru
        template.querySelector('.remove-pendidikan')?.addEventListener('click', function() {
            if (container.children.length > 1) {
                template.remove();
                updateRemovePendidikan();
                // Update info IDs
                container.querySelectorAll('.pendidikan-formal-item').forEach((el, i) => {
                    const mi = el.querySelector('[id^="info_masuk_"]');
                    const li = el.querySelector('[id^="info_lulus_"]');
                    if (mi) mi.id = `info_masuk_${i}`;
                    if (li) li.id = `info_lulus_${i}`;
                });
            }
        });
    
        updateRemovePendidikan();
    });

    // Setup remove untuk item pertama
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('pendidikan-formal-container');
        if (container) {
            // Setup untuk semua item yang ada
            container.querySelectorAll('.pendidikan-formal-item').forEach((item, index) => {
                const removeBtn = item.querySelector('.remove-pendidikan');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function() {
                        if (container.children.length > 1) {
                            item.remove();
                            updateRemovePendidikan();
                            container.querySelectorAll('.pendidikan-formal-item').forEach((el, i) => {
                                const mi = el.querySelector('[id^="info_masuk_"]');
                                const li = el.querySelector('[id^="info_lulus_"]');
                                if (mi) mi.id = `info_masuk_${i}`;
                                if (li) li.id = `info_lulus_${i}`;
                            });
                        }
                    });
                }
            });
            updateRemovePendidikan();
        }
    });

    // ============================================
    // PELATIHAN/KURSUS
    // ============================================
    function updateRemovePelatihan() {
        const items = document.querySelectorAll('#pelatihan-container .pelatihan-item');
        const buttons = document.querySelectorAll('#pelatihan-container .remove-pelatihan');
    
        buttons.forEach(btn => {
            if (items.length > 1) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
    }

    document.getElementById('tambah-pelatihan')?.addEventListener('click', function() {
        const container = document.getElementById('pelatihan-container');
        const template = container.children[0].cloneNode(true);
        template.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(template);
    
        template.querySelector('.remove-pelatihan')?.addEventListener('click', function() {
            if (container.children.length > 1) {
                template.remove();
                updateRemovePelatihan();
            }
        });
    
        updateRemovePelatihan();
    });

    // Setup remove untuk item pertama pelatihan
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('pelatihan-container');
        if (container) {
            container.querySelectorAll('.pelatihan-item').forEach(item => {
                const removeBtn = item.querySelector('.remove-pelatihan');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function() {
                        if (container.children.length > 1) {
                            item.remove();
                            updateRemovePelatihan();
                        }
                    });
                }
            });
            updateRemovePelatihan();
        }
    });
</script>
@endpush

