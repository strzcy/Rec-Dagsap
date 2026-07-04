
<div>
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">C. KETERAMPILAN</h2>

    <div id="keterampilan-container">
        <div class="keterampilan-item bg-gray-50 p-4 rounded-lg mb-3">
            <input type="hidden" name="keterampilan_key[]" value="0">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">

                <div>
                    <input
                        type="text"
                        name="keterampilan_nama[]"
                        placeholder="Jenis Keterampilan"
                        class="w-full border rounded-lg px-3 py-2"
                        required>
                </div>

                <div>
                    <label class="inline-flex items-center">
                        <input
                            type="radio"
                            name="keterampilan_tingkat_0"
                            value="Cukup Mahir"
                            class="mr-1"
                            required>
                        Cukup Mahir
                    </label>
                </div>

                <div>
                    <label class="inline-flex items-center">
                        <input
                            type="radio"
                            name="keterampilan_tingkat_0"
                            value="Mahir"
                            class="mr-1">
                        Mahir
                    </label>
                </div>

                <div>
                    <label class="inline-flex items-center">
                        <input
                            type="radio"
                            name="keterampilan_tingkat_0"
                            value="Sangat Mahir"
                            class="mr-1">
                        Sangat Mahir
                    </label>
                </div>

            </div>

            <button
                type="button"
                class="remove-keterampilan hidden text-red-500 text-sm mt-2">
                Hapus
            </button>

        </div>
    </div>

    <p class="text-red-500 text-xs mt-1">
        * Minimal 3 keterampilan harus diisi
    </p>

    <button
        type="button"
        id="tambah-keterampilan"
        class="text-primary text-sm hover:text-primary-dark mt-2">

        <i class="fas fa-plus mr-1"></i>
        Tambah Keterampilan

    </button>



    <h2 class="text-xl font-bold text-primary mb-4 mt-8 border-b pb-2">
        D. BAHASA ASING
    </h2>

    <div id="bahasa-container">

        <div class="bahasa-item bg-gray-50 p-4 rounded-lg mb-3">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">

                <div>
                    <input
                        type="text"
                        name="bahasa_nama[]"
                        placeholder="Jenis Bahasa"
                        class="w-full border rounded-lg px-3 py-2"
                        required>
                </div>

                <div>
                    <select
                        name="bahasa_membaca[]"
                        class="w-full border rounded-lg px-3 py-2"
                        required>

                        <option value="">Pilih Level Membaca</option>
                        <option value="Baik Sekali">Baik Sekali</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>

                    </select>
                </div>

                <div>
                    <select
                        name="bahasa_berbicara[]"
                        class="w-full border rounded-lg px-3 py-2"
                        required>

                        <option value="">Pilih Level Berbicara</option>
                        <option value="Baik Sekali">Baik Sekali</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>

                    </select>
                </div>

                <div>
                    <select
                        name="bahasa_menulis[]"
                        class="w-full border rounded-lg px-3 py-2"
                        required>

                        <option value="">Pilih Level Menulis</option>
                        <option value="Baik Sekali">Baik Sekali</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>

                    </select>
                </div>

            </div>

            <button
                type="button"
                class="remove-bahasa hidden text-red-500 text-sm mt-2">
                Hapus
            </button>

        </div>

    </div>

    <button
        type="button"
        id="tambah-bahasa"
        class="text-primary text-sm hover:text-primary-dark mt-2">

        <i class="fas fa-plus mr-1"></i>
        Tambah Bahasa

    </button>

</div>

@push('scripts')
<script>
    // ============================================
    // ORGANISASI - SUDAH BENAR
    // ============================================
    function updateOrganisasiPlaceholders() {
        const items = document.querySelectorAll('#organisasi-container .organisasi-item');
        items.forEach((item, index) => {
            const numberSpan = item.querySelector('.organisasi-number');
            if (numberSpan) numberSpan.textContent = `${index + 1}.`;
            const input = item.querySelector('input');
            if (input) input.placeholder = `...`;
        });
    
        const removeBtns = document.querySelectorAll('#organisasi-container .remove-organisasi');
        removeBtns.forEach(btn => {
            if (items.length > 1) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
    }

    // ============================================
    // KETERAMPILAN (Minimal 3)
    // ============================================
    const MIN_SKILL = 3;

    function generateUniqueId() {
        return Date.now() + Math.random().toString(36).substr(2, 9);
    }

    // Fungsi untuk menyembunyikan/menampilkan tombol hapus keterampilan
    function updateRemoveKeterampilan() {
        const items = document.querySelectorAll('#keterampilan-container .keterampilan-item');
        
        items.forEach(item => {
            const btn = item.querySelector('.remove-keterampilan');
            if (btn) {
                if (items.length > MIN_SKILL) {
                    btn.classList.remove('hidden');
                } else {
                    btn.classList.add('hidden');
                }
            }
        });
    }

    function addKeterampilan() {
        const container = document.getElementById('keterampilan-container');
        // Ambil elemen pertama sebagai template dasar
        const baseTemplate = container.children[0];
        const template = baseTemplate.cloneNode(true);
        const uniqueId = generateUniqueId();

        template.querySelector('input[name="keterampilan_key[]"]').value = uniqueId;
        template.querySelectorAll('input[type="text"]').forEach(input => {
            input.value = '';
        });
        template.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.name = `keterampilan_tingkat_${uniqueId}`;
            radio.checked = false;
        });

        // Pasang fungsi hapus untuk item baru
        template.querySelector('.remove-keterampilan').onclick = function () {
            const currentItems = container.querySelectorAll('.keterampilan-item');
            if (currentItems.length > MIN_SKILL) {
                template.remove();
                updateRemoveKeterampilan();
            } else {
                alert('Minimal harus ada 3 keterampilan!');
            }
        };

        container.appendChild(template);
        updateRemoveKeterampilan();
    }

    function initKeterampilan() {
        const container = document.getElementById('keterampilan-container');
        
        // Reset ke 1 item terlebih dahulu
        while (container.children.length > 1) {
            container.removeChild(container.lastChild);
        }
        
        // Reset data input pertama
        const firstItem = container.children[0];
        firstItem.querySelectorAll('input[type="text"]').forEach(input => { input.value = ''; });
        firstItem.querySelectorAll('input[type="radio"]').forEach(radio => { radio.checked = false; });
        
        // Atur name radio pertama agar default ke indeks 0
        firstItem.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.name = 'keterampilan_tingkat_0';
        });

        // Tambah otomatis sampai memenuhi minimal 3 item
        for(let i = 1; i < MIN_SKILL; i++) {
            addKeterampilan();
        }
        
        updateRemoveKeterampilan();
    }

    document.getElementById('tambah-keterampilan').onclick = addKeterampilan;


    // ============================================
    // BAHASA ASING
    // ============================================
    function updateRemoveBahasa() {
        const container = document.getElementById('bahasa-container');
        const items = container.querySelectorAll('.bahasa-item');
        
        items.forEach(item => {
            const btn = item.querySelector('.remove-bahasa');
            if (btn) {
                if (items.length > 1) {
                    btn.classList.remove('hidden');
                } else {
                    btn.classList.add('hidden');
                }
            }
        });
    }

    function addBahasa() {
        const container = document.getElementById('bahasa-container');
        const template = container.children[0].cloneNode(true);

        template.querySelectorAll('input').forEach(input => {
            input.value = '';
        });
        template.querySelectorAll('select').forEach(select => {
            select.selectedIndex = 0;
        });

        template.querySelector('.remove-bahasa').onclick = function() {
            if(container.querySelectorAll('.bahasa-item').length > 1) {
                template.remove();
                updateRemoveBahasa();
            }
        };

        container.appendChild(template);
        updateRemoveBahasa();
    }

    document.getElementById('tambah-bahasa').onclick = addBahasa;


    // ============================================
    // INITIALIZATION ON DOM READY
    // ============================================
    document.addEventListener('DOMContentLoaded', function() {
        // Init keterampilan (membuat jadi 3 secara default)
        initKeterampilan();

        // Pasang onclick handler untuk item keterampilan pertama
        const firstKeterampilan = document.querySelector('#keterampilan-container .keterampilan-item');
        if (firstKeterampilan) {
            firstKeterampilan.querySelector('.remove-keterampilan').onclick = function() {
                const container = document.getElementById('keterampilan-container');
                const currentItems = container.querySelectorAll('.keterampilan-item');
                if (currentItems.length > MIN_SKILL) {
                    this.closest('.keterampilan-item').remove();
                    updateRemoveKeterampilan();
                } else {
                    alert('Minimal harus ada 3 keterampilan!');
                }
            };
        }

        // Pasang onclick handler untuk item bahasa pertama
        const firstBahasa = document.querySelector('#bahasa-container .bahasa-item');
        if (firstBahasa) {
            firstBahasa.querySelector('.remove-bahasa').onclick = function() {
                const container = document.getElementById('bahasa-container');
                if(container.querySelectorAll('.bahasa-item').length > 1) {
                    this.closest('.bahasa-item').remove();
                    updateRemoveBahasa();
                }
            };
        }

        // Jalankan pengecekan tombol sembunyi/tampil di awal
        updateRemoveKeterampilan();
        updateRemoveBahasa();
    });
</script>
@endpush