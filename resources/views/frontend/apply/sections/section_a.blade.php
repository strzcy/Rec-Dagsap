
<div>
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">A. DATA PRIBADI</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text" name="nama_lengkap" required class="w-full border rounded-lg px-3 py-2 focus:ring-1 focus:ring-primary">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
            <select name="jenis_kelamin" required class="w-full border rounded-lg px-3 py-2">
                <option value="">Pilih</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
            <input type="text" name="tempat_lahir" required class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
            <input type="date" name="tanggal_lahir" required class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Tinggi Badan (cm) <span class="text-red-500">*</span></label>
            <input type="number" name="tinggi_badan" required class="w-full border rounded-lg px-3 py-2" >
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Berat Badan (kg) <span class="text-red-500">*</span></label>
            <input type="number" name="berat_badan" required class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Kewarganegaraan <span class="text-red-500">*</span></label>
            <input type="text" name="kewarganegaraan" value="Indonesia" required class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Agama <span class="text-red-500">*</span></label>
            <select name="agama" required class="w-full border rounded-lg px-3 py-2">
                <option value="">Pilih</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Golongan Darah <span class="text-red-500">*</span></label>
            <select name="golongan_darah" required class="w-full border rounded-lg px-3 py-2">
                <option value="">Pilih</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
                <option value="Tidak Tahu">Tidak Tahu</option>
            </select>
        </div>
    </div>
    
    <div class="mt-4">
        <label class="block text-sm font-medium mb-1">Alamat Tinggal <span class="text-red-500">*</span></label>
        <textarea name="alamat_tinggal" rows="2" required class="w-full border rounded-lg px-3 py-2"></textarea>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-3">
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ No. Rumah</label>
            <input type="text" name="no_rumah_tinggal" required class="w-full border rounded-lg px-3 py-2">
        </div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ RT/RW</label>
            <input type="text" name="rt_rw_tinggal"  required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ Kelurahan</label>
            <input type="text" name="kelurahan_tinggal"  required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ Kecamatan</label>
            <input type="text" name="kecamatan_tinggal"  required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ Kabupaten</label>
            <input type="text" name="kabupaten_tinggal"  required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ Kota</label>
            <input type="text" name="kota_tinggal"  required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ Provinsi</label>
            <input type="text" name="provinsi_tinggal" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ Kode Pos</label>
            <input type="number" name="kode_pos_tinggal"  required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ No. Telepon</label>
            <input type="number" name="no_telp" required class="w-full border rounded-lg px-3 py-2" placeholder="08**********"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ No. Handphone</label>
            <input type="number" name="no_hp" required class="w-full border rounded-lg px-3 py-2" placeholder="08**********"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ No. WhatsApp</label>
            <input type="number" name="no_wa" required class="w-full border rounded-lg px-3 py-2" placeholder="08**********"></div>
    </div>
    
    <div class="mt-4">
        <label class="block text-sm font-medium mb-1">Alamat KTP <span class="text-red-500">*</span></label>
        <textarea name="alamat_ktp" rows="2" required class="w-full border rounded-lg px-3 py-2"></textarea>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-3">
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ No. Rumah</label>
            <input type="text" name="no_rumah_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ RT/RW</label>
            <input type="text" name="rt_rw_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ Kelurahan</label>
            <input type="text" name="kelurahan_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ Kecamatan</label>
            <input type="text" name="kecamatan_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ Kabupaten</label>
            <input type="text" name="kabupaten_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ Kota</label>
            <input type="text" name="kota_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ Provinsi</label>
            <input type="text" name="provinsi_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-400 font-medium mb-2">ㅤ Kode Pos</label>
            <input type="number" name="kode_pos_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
        <div>
            <label class="block text-sm font-medium mb-1">No. KTP/Passport <span class="text-red-500">  *</span></label>
            <input type="text" name="no_ktp" required class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Dikeluarkan di :<span class="text-red-500">*</span></label>
            <input type="text" name="dikeluarkan_di" class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">No. NPWP <span class="text-red-500">*</span></label>
            <input type="number" name="no_npwp" required class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">No. BPJS Kesehatan <span class="text-red-500">*</span></label>
            <input type="number" name="no_bpjs_kesehatan" class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">No. BPJS Ketenagakerjaan <span class="text-red-500">*</span></label>
            <input type="number" name="no_bpjs_ketenagakerjaan"  class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Status Perkawinan <span class="text-red-500">*</span></label>
            <select name="status_perkawinan" required class="w-full border rounded-lg px-3 py-2">
                <option value="Lajang">Lajang</option>
                <option value="Nikah">Nikah</option>
                <option value="Bercerai">Bercerai</option>
                <option value="Pasangan Meninggal">Pasangan Meninggal</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ $pelamar->email }}" required class="w-full border rounded-lg px-3 py-2 bg-gray-100" readonly>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Hobi<span class="text-red-500">*</span></label>
            <input type="text" name="hobby"required class="w-full border rounded-lg px-3 py-2">
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
    </div>
    

    <div class="mt-3">
        <label class="block text-sm font-medium mb-1">Organisasi</label>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="border border-gray-300 px-3 py-2 text-left text-xs font-medium text-gray-500 w-12">No.</th>
                        <th class="border border-gray-300 px-3 py-2 text-left text-xs font-medium text-gray-500">Nama Organisasi</th>
                        <th class="border border-gray-300 px-3 py-2 text-left text-xs font-medium text-gray-500 w-40">Waktu</th>
                        <th class="border border-gray-300 px-3 py-2 text-left text-xs font-medium text-gray-500 w-36">Jabatan</th>
                        <th class="border border-gray-300 px-3 py-2 text-left text-xs font-medium text-gray-500 w-40">Jenis Organisasi</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-xs font-medium text-gray-500 w-12">Aksi</th>
                    </tr>
                </thead>
                <tbody id="organisasi-tbody">
                    <tr class="organisasi-item">
                        <td class="border border-gray-300 px-2 py-2 text-center text-sm organisasi-number">1.</td>
                        <td class="border border-gray-300 px-2 py-2">
                            <input type="text" name="organisasi_nama[]" class="w-full border-0 focus:ring-0 px-1 py-0 text-sm" placeholder="...">
                        </td>
                        <td class="border border-gray-300 px-2 py-2">
                            <input type="text" name="organisasi_waktu[]" class="w-full border-0 focus:ring-0 px-1 py-0 text-sm" placeholder="...">
                        </td>
                        <td class="border border-gray-300 px-2 py-2">
                            <input type="text" name="organisasi_jabatan[]" class="w-full border-0 focus:ring-0 px-1 py-0 text-sm" placeholder="...">
                        </td>
                        <td class="border border-gray-300 px-2 py-2">
                            <input type="text" name="organisasi_jenis[]" class="w-full border-0 focus:ring-0 px-1 py-0 text-sm" placeholder="...">
                        </td>
                        <td class="border border-gray-300 px-2 py-2 text-center">
                            <button type="button" class="remove-organisasi text-red-500 hover:text-red-700 text-xs hidden" title="Hapus">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="button" onclick="addOrganisasi()" class="text-primary text-sm hover:text-primary-dark mt-2">
            + Tambah Organisasi
        </button>
    </div>
</div>

<script>
    // ============================================
    // ORGANISASI - TABEL
    // ============================================
    function updateOrganisasiNumber() {
        const rows = document.querySelectorAll('#organisasi-tbody .organisasi-item');
        rows.forEach((row, index) => {
            const numberCell = row.querySelector('.organisasi-number');
            if (numberCell) numberCell.textContent = `${index + 1}.`;
        });
    
        // Toggle tombol hapus: hanya jika > 1
        const removeBtns = document.querySelectorAll('#organisasi-tbody .remove-organisasi');
        removeBtns.forEach(btn => {
            if (rows.length > 1) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
    }

    function addOrganisasi() {
        const tbody = document.getElementById('organisasi-tbody');
        const newRow = document.createElement('tr');
        newRow.className = 'organisasi-item';
        const rowCount = tbody.children.length + 1;
    
        newRow.innerHTML = `
            <td class="border border-gray-300 px-2 py-2 text-center text-sm organisasi-number">${rowCount}.</td>
            <td class="border border-gray-300 px-2 py-2">
                <input type="text" name="organisasi_nama[]" class="w-full border-0 focus:ring-0 px-1 py-0 text-sm" placeholder="...">
            </td>
            <td class="border border-gray-300 px-2 py-2">
                <input type="text" name="organisasi_waktu[]" class="w-full border-0 focus:ring-0 px-1 py-0 text-sm" placeholder="...">
            </td>
            <td class="border border-gray-300 px-2 py-2">
                <input type="text" name="organisasi_jabatan[]" class="w-full border-0 focus:ring-0 px-1 py-0 text-sm" placeholder="...">
            </td>
            <td class="border border-gray-300 px-2 py-2">
                <input type="text" name="organisasi_jenis[]" class="w-full border-0 focus:ring-0 px-1 py-0 text-sm" placeholder="...">
            </td>
            <td class="border border-gray-300 px-2 py-2 text-center">
                <button type="button" onclick="removeOrganisasi(this)" class="remove-organisasi text-red-500 hover:text-red-700 text-xs" title="Hapus">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        `;
    
        tbody.appendChild(newRow);
        updateOrganisasiNumber();
    }

    function removeOrganisasi(btn) {
        const row = btn.closest('.organisasi-item');
        const tbody = document.getElementById('organisasi-tbody');
        if (tbody.children.length > 1) {
            row.remove();
            updateOrganisasiNumber();
        }
    }

    // Inisialisasi
    updateOrganisasiNumber();
</script>

































