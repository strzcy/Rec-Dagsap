<div>
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">C. KETERAMPILAN</h2>
    
    <div id="keterampilan-container">
        <div class="keterampilan-item bg-gray-50 p-4 rounded-lg mb-3">
            <input type="hidden" name="keterampilan_key[]" value="0">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <div><input type="text" name="keterampilan_nama[]" placeholder="Jenis Keterampilan" class="w-full border rounded-lg px-3 py-2" required></div>
                <div><label class="inline-flex items-center"><input type="radio" name="keterampilan_tingkat_0" value="Cukup Mahir" class="mr-1" required> Cukup Mahir</label></div>
                <div><label class="inline-flex items-center"><input type="radio" name="keterampilan_tingkat_0" value="Mahir" class="mr-1"> Mahir</label></div>
                <div><label class="inline-flex items-center"><input type="radio" name="keterampilan_tingkat_0" value="Sangat Mahir" class="mr-1"> Sangat Mahir</label></div>
            </div>
            <button type="button" class="remove-keterampilan text-red-500 text-sm mt-2">Hapus</button>
        </div>
    </div>
    <p class="text-red-500 text-xs mt-1">* Minimal 3 keterampilan harus diisi</p>
    <button type="button" id="tambah-keterampilan" class="text-primary text-sm hover:text-primary-dark mt-2">
        <i class="fas fa-plus mr-1"></i> Tambah Keterampilan
    </button>
    
    <h2 class="text-xl font-bold text-primary mb-4 mt-8 border-b pb-2">D. BAHASA ASING</h2>
    
    <div id="bahasa-container">
        <div class="bahasa-item bg-gray-50 p-4 rounded-lg mb-3">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <div><input type="text" name="bahasa_nama[]" placeholder="Jenis Bahasa" class="w-full border rounded-lg px-3 py-2" required></div>
                <div>
                    <select name="bahasa_membaca[]" class="w-full border rounded-lg px-3 py-2" required>
                        <option value="">Pilih Level Membaca</option>
                        <option value="Baik Sekali">Baik Sekali</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>
                    </select>
                </div>
                <div>
                    <select name="bahasa_berbicara[]" class="w-full border rounded-lg px-3 py-2" required>
                        <option value="">Pilih Level Berbicara</option>
                        <option value="Baik Sekali">Baik Sekali</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>
                    </select>
                </div>
                <div>
                    <select name="bahasa_menulis[]" class="w-full border rounded-lg px-3 py-2" required>
                        <option value="">Pilih Level Menulis</option>
                        <option value="Baik Sekali">Baik Sekali</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>
                    </select>
                </div>
            </div>
            <button type="button" class="remove-bahasa text-red-500 text-sm mt-2">Hapus</button>
        </div>
        <button type="button" id="tambah-keterampilan" class="text-primary text-sm hover:text-primary-dark mt-2">
            <i class="fas fa-plus mr-1"></i> Tambah Keterampilan
        </button>
    </div>
</div>

@push('scripts')
<script>
    let skillCounter = 0;
    let languageCounter = 0;
    
    function generateUniqueId() {
        return Date.now() + Math.random().toString(36).substr(2, 9);
    }
    
    document.getElementById('tambah-keterampilan')?.addEventListener('click', function() {
        const container = document.getElementById('keterampilan-container');
        const template = container.children[0].cloneNode(true);
        const uniqueId = generateUniqueId();
        
        const keyInput = template.querySelector('input[name="keterampilan_key[]"]');
        if (keyInput) {
            keyInput.value = uniqueId;
        }
        
        template.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.setAttribute('name', `keterampilan_tingkat_${uniqueId}`);
            radio.checked = false;
        });
        template.querySelectorAll('input[type="text"]').forEach(input => input.value = '');
        container.appendChild(template);
        
        template.querySelector('.remove-keterampilan')?.addEventListener('click', function() {
            if (container.children.length > 1) {
                template.remove();
            }
        });
    });
    
    document.getElementById('tambah-bahasa')?.addEventListener('click', function() {
        const container = document.getElementById('bahasa-container');
        const template = container.children[0].cloneNode(true);
        template.querySelectorAll('input, select').forEach(input => input.value = '');
        container.appendChild(template);
        
        template.querySelector('.remove-bahasa')?.addEventListener('click', function() {
            if (container.children.length > 1) {
                template.remove();
            }
        });
    });
    
    document.querySelectorAll('.remove-keterampilan, .remove-bahasa').forEach(btn => {
        btn.addEventListener('click', function() {
            const container = this.closest('[id$="-container"]');
            if (container && container.children.length > 1) {
                this.closest('.keterampilan-item, .bahasa-item').remove();
            }
        });
    });
</script>
@endpush