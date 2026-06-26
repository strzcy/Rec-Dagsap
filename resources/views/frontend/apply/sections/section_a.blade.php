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
            <input type="number" name="tinggi_badan" required class="w-full border rounded-lg px-3 py-2" placeholder="Contoh: 165">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Berat Badan (kg) <span class="text-red-500">*</span></label>
            <input type="number" name="berat_badan" required class="w-full border rounded-lg px-3 py-2" placeholder="Contoh: 60">
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
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤRT/RW</label>
            <input type="text" name="rt_rw_tinggal"  required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤKelurahan</label>
            <input type="text" name="kelurahan_tinggal"  required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤKecamatan</label>
            <input type="text" name="kecamatan_tinggal"  required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤKabupaten</label>
            <input type="text" name="kabupaten_tinggal"  required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤKota</label>
            <input type="text" name="kota_tinggal"  required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤProvinsi</label>
            <input type="text" name="provinsi_tinggal" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤKode Pos</label>
            <input type="number" name="kode_pos_tinggal"  required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤNo. Telepon</label>
            <input type="number" name="no_telp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤNo. Handphone</label>
            <input type="number" name="no_hp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤNo. WhatsApp</label>
            <input type="number" name="no_wa" required class="w-full border rounded-lg px-3 py-2"></div>
    </div>
    
    <div class="mt-4">
        <label class="block text-sm font-medium mb-1">Alamat KTP <span class="text-red-500">*</span></label>
        <textarea name="alamat_ktp" rows="2" required class="w-full border rounded-lg px-3 py-2"></textarea>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-3">
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤRT/RW</label>
            <input type="text" name="rt_rw_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤKelurahan</label>
            <input type="text" name="kelurahan_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤKecamatan</label>
            <input type="text" name="kecamatan_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤKabupaten</label>
            <input type="text" name="kabupaten_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤKota</label>
            <input type="text" name="kota_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤProvinsi</label>
            <input type="text" name="provinsi_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
        <div><label class="block text-xs text-gray-700 font-medium mb-2">ㅤKode Pos</label>
            <input type="number" name="kode_pos_ktp" required class="w-full border rounded-lg px-3 py-2"></div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
        <div>
            <label class="block text-sm font-medium mb-1">No. KTP/Passport <span class="text-red-500">*</span></label>
            <input type="text" name="no_ktp" required class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">No. NPWP</label>
            <input type="number" name="no_npwp" required class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">No. BPJS</label>
            <input type="number" name="no_bpjs_ketenagakerjaan" placeholder="BPJS Ketenagakerjaan"required class="w-full border rounded-lg px-3 py-2">
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
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
            <label class="block text-sm font-medium mb-1">Hobi</label>
            <input type="text" name="hobby"required class="w-full border rounded-lg px-3 py-2">
        </div>
    </div>
    
    <div class="mt-3">
        <label class="block text-sm font-medium mb-1">Organisasi</label>
        <textarea name="organisasi" rows="2"required class="w-full border rounded-lg px-3 py-2" placeholder="Riwayat organisasi yang pernah diikuti"></textarea>
    </div>
</div>