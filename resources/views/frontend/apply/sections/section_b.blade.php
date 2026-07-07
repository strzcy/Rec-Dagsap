

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
    
    // Setup tambah pendidikan
    document.getElementById('tambah-pendidikan')?.addEventListener('click', function() {
        const container = document.getElementById('pendidikan-formal-container');
        const template = container.children[0].cloneNode(true);
        
        // Reset nilai semua field di item baru
        template.querySelectorAll('input, select, textarea').forEach(input => {
            if (input.type !== 'radio' && input.type !== 'checkbox') {
                input.value = '';
            }
        });
        
        // Sembunyikan kembali field alasan jika bawaannya sedang terbuka
        const alasanField = template.querySelector('.alasan-pendidikan');
        if (alasanField) alasanField.classList.add('hidden');
    
        // Masukkan item baru ke container
        container.appendChild(template);
        
        // --- PERBAIKAN 1: Pasang Event Validasi ke Item Baru ---
        bindValidationEvents(template);
    
        // Refresh format tampilan & ID
        refreshPendidikanFormat();
    });

    // ============================================
    // PELATIHAN/KURSUS
    // ============================================
    document.getElementById('tambah-pelatihan')?.addEventListener('click', function() {
        const container = document.getElementById('pelatihan-container');
        const template = container.children[0].cloneNode(true);
        template.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(template);
    
        refreshPelatihanFormat();
    });

    // ============================================
    // VALIDASI PENDIDIKAN - IDEAL AGE
    // ============================================
    const TAHUN_LAHIR = {{ isset($pelamar) ? \Carbon\Carbon::parse($pelamar->tanggal_lahir)->format('Y') : date('Y') - 20 }};

    const DURASI_PENDIDIKAN = {
        'SD Sederajat': { masuk: 7, durasi: 6 },
        'SLTP': { masuk: 13, durasi: 3 },
        'SLTA': { masuk: 16, durasi: 3 },
        'Diploma': { masuk: 19, durasi: 3 },
        'S1': { masuk: 19, durasi: 4 },
        'S2': { masuk: 23, durasi: 2 }
    };

    function hitungTahunIdeal(tingkat) {
        if (!tingkat || !DURASI_PENDIDIKAN[tingkat]) return null;
        const data = DURASI_PENDIDIKAN[tingkat];
        const tahunMasukIdeal = TAHUN_LAHIR + data.masuk;
        const tahunLulusIdeal = tahunMasukIdeal + data.durasi;
        return { tahunMasukIdeal, tahunLulusIdeal, durasi: data.durasi };
    }

    function validatePendidikanItem(item) {
        const tingkatField = item.querySelector('.pendidikan-tingkat');
        const masukField = item.querySelector('.pendidikan-tahun-masuk');
        const lulusField = item.querySelector('.pendidikan-tahun-lulus');
        
        if (!tingkatField || !masukField || !lulusField) return;

        const tingkat = tingkatField.value;
        const tahunMasuk = parseInt(masukField.value);
        const tahunLulus = parseInt(lulusField.value);
        const alasanField = item.querySelector('.alasan-pendidikan');
        const alasanTextarea = item.querySelector('textarea[name="pendidikan_alasan[]"]');
    
        if (!tingkat || !tahunMasuk || !tahunLulus) {
            if (alasanField) alasanField.classList.add('hidden');
            return;
        }
    
        const ideal = hitungTahunIdeal(tingkat);
        if (!ideal) return;
    
        const selisihMasuk = Math.abs(tahunMasuk - ideal.tahunMasukIdeal);
        const selisihLulus = Math.abs(tahunLulus - ideal.tahunLulusIdeal);
        const durasiActual = tahunLulus - tahunMasuk;
        const durasiIdeal = ideal.durasi;
    
        const isSesuai = (
            selisihMasuk <= 1 && 
            selisihLulus <= 1 && 
            durasiActual === durasiIdeal
        );
    
        if (alasanField && alasanTextarea) {
            if (isSesuai) {
                alasanField.classList.add('hidden');
                alasanTextarea.removeAttribute('required');
            } else {
                alasanField.classList.remove('hidden');
                alasanTextarea.setAttribute('required', 'required');
                
                const pesan = alasanField.querySelector('label');
                if (pesan) {
                    let alasan = `Standar pendidikan ${tingkat} anda pada tahun ${ideal.tahunMasukIdeal} sampai tahun ${ideal.tahunLulusIdeal}.`;
                    pesan.innerHTML = '<i class="fas fa-exclamation-triangle mr-1"></i> ' + alasan;
                }
            }
        }
    }

    // Mengatur ulang keaktifan tombol hapus & indeks ID info
    function refreshPendidikanFormat() {
        const container = document.getElementById('pendidikan-formal-container');
        if (!container) return;

        const items = container.querySelectorAll('.pendidikan-formal-item');
        
        items.forEach((item, index) => {
            const mi = item.querySelector('[id^="info_masuk_"]');
            const li = item.querySelector('[id^="info_lulus_"]');
            if (mi) mi.id = `info_masuk_${index}`;
            if (li) li.id = `info_lulus_${index}`;

            const btnHapus = item.querySelector('.remove-pendidikan');
            if (btnHapus) {
                if (items.length > 1) {
                    btnHapus.classList.remove('hidden');
                } else {
                    btnHapus.classList.add('hidden');
                }
            }
        });
    }

    // Pasang validasi ke satu item baris pendidikan
    function bindValidationEvents(item) {
        const tingkat = item.querySelector('.pendidikan-tingkat');
        const tahunMasuk = item.querySelector('.pendidikan-tahun-masuk');
        const tahunLulus = item.querySelector('.pendidikan-tahun-lulus');
    
        const validate = () => validatePendidikanItem(item);
    
        if (tingkat) tingkat.addEventListener('change', validate);
        if (tahunMasuk) tahunMasuk.addEventListener('input', validate);
        if (tahunLulus) tahunLulus.addEventListener('input', validate);
    }

    // ============================================
    // PELATIHAN/KURSUS FORMAT
    // ============================================
    function refreshPelatihanFormat() {
        const container = document.getElementById('pelatihan-container');
        if (!container) return;

        const items = container.querySelectorAll('.pelatihan-item');
        items.forEach(item => {
            const btnHapus = item.querySelector('.remove-pelatihan');
            if (btnHapus) {
                if (items.length > 1) {
                    btnHapus.classList.remove('hidden');
                } else {
                    btnHapus.classList.add('hidden');
                }
            }
        });
    }

    // ============================================
    // INITIALIZATION (DOM READY)
    // ============================================
    document.addEventListener('DOMContentLoaded', function() {
        // Setup Awal Pendidikan Formal bawaan
        const pendContainer = document.getElementById('pendidikan-formal-container');
        if (pendContainer) {
            pendContainer.querySelectorAll('.pendidikan-formal-item').forEach(item => {
                bindValidationEvents(item);
            });
            refreshPendidikanFormat();
        }

        // Event Hapus Pendidikan (Delegasi Event)
        document.getElementById('pendidikan-formal-container')?.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-pendidikan')) {
                const container = document.getElementById('pendidikan-formal-container');
                if (container.children.length > 1) {
                    e.target.closest('.pendidikan-formal-item').remove();
                    refreshPendidikanFormat();
                }
            }
        });

        // Setup Awal Pelatihan
        refreshPelatihanFormat();

        // Event Hapus Pelatihan (Delegasi Event)
        document.getElementById('pelatihan-container')?.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-pelatihan')) {
                const container = document.getElementById('pelatihan-container');
                if (container.children.length > 1) {
                    e.target.closest('.pelatihan-item').remove();
                    refreshPelatihanFormat();
                }
            }
        });
    });
</script>
@endpush

