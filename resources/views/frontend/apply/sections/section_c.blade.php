<div>
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">C. KETERAMPILAN</h2>
    
    <div id="keterampilan-container">
        <div class="keterampilan-item bg-gray-50 p-4 rounded-lg mb-3">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <div class="md:col-span-1"><input type="text" name="keterampilan_nama[]" placeholder="Jenis Keterampilan" class="w-full border rounded-lg px-3 py-2"></div>
                <div><label class="inline-flex items-center"><input type="radio" name="keterampilan_tingkat_{{ uniqid() }}" value="Cukup Mahir" class="mr-1"> Cukup Mahir</label></div>
                <div><label class="inline-flex items-center"><input type="radio" name="keterampilan_tingkat_{{ uniqid() }}" value="Mahir" class="mr-1"> Mahir</label></div>
                <div><label class="inline-flex items-center"><input type="radio" name="keterampilan_tingkat_{{ uniqid() }}" value="Sangat Mahir" class="mr-1"> Sangat Mahir</label></div>
            </div>
            <button type="button" class="remove-keterampilan text-red-500 text-sm mt-2 hover:text-red-700">Hapus</button>
        </div>
    </div>
    <button type="button" id="tambah-keterampilan" class="text-primary text-sm hover:text-primary-dark mt-2">
        <i class="fas fa-plus mr-1"></i> Tambah Keterampilan
    </button>
    
    <h2 class="text-xl font-bold text-primary mb-4 mt-8 border-b pb-2">D. BAHASA ASING</h2>
    
    <div id="bahasa-container">
        <div class="bahasa-item bg-gray-50 p-4 rounded-lg mb-3">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <div><input type="text" name="bahasa_nama[]" placeholder="Jenis Bahasa" class="w-full border rounded-lg px-3 py-2"></div>
                <div><select name="bahasa_membaca[]" class="w-full border rounded-lg px-3 py-2"><option value="">Membaca</option><option value="Baik Sekali">Baik Sekali</option><option value="Baik">Baik</option><option value="Cukup">Cukup</option></select></div>
                <div><select name="bahasa_berbicara[]" class="w-full border rounded-lg px-3 py-2"><option value="">Berbicara</option><option value="Baik Sekali">Baik Sekali</option><option value="Baik">Baik</option><option value="Cukup">Cukup</option></select></div>
                <div><select name="bahasa_menulis[]" class="w-full border rounded-lg px-3 py-2"><option value="">Menulis</option><option value="Baik Sekali">Baik Sekali</option><option value="Baik">Baik</option><option value="Cukup">Cukup</option></select></div>
            </div>
            <button type="button" class="remove-bahasa text-red-500 text-sm mt-2 hover:text-red-700">Hapus</button>
        </div>
    </div>
    <button type="button" id="tambah-bahasa" class="text-primary text-sm hover:text-primary-dark mt-2">
        <i class="fas fa-plus mr-1"></i> Tambah Bahasa
    </button>
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
        template.querySelectorAll('input[type="radio"]').forEach(radio => {
            const oldName = radio.getAttribute('name');
            if (oldName) {
                radio.setAttribute('name', `keterampilan_tingkat_${uniqueId}`);
            }
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