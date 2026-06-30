

<div>
    <!-- E. KEKUATAN & KELEMAHAN -->
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">E. KEKUATAN &amp; KELEMAHAN</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <label class="block text-sm font-medium mb-2">Kekuatan / Kelebihan</label>
            <div id="kekuatan-container">
                </div>
            <button type="button" onclick="addKekuatan()" class="text-primary text-sm font-semibold hover:text-primary-dark mt-2 block pl-6">
                + Tambah Kekuatan
            </button>
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">Kelemahan / Kekurangan</label>
            <div id="kelemahan-container">
                </div>
            <button type="button" onclick="addKelemahan()" class="text-primary text-sm font-semibold hover:text-primary-dark mt-2 block pl-6">
                + Tambah Kelemahan
            </button>
        </div>
    </div>

    
    
    <!-- F. RIWAYAT PEKERJAAN -->
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">F. RIWAYAT PEKERJAAN</h2>
    
    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Pengalaman kerja sebelumnya (urutkan dari yang terbaru)</label>
        <div id="pekerjaan-container">
            <div class="pekerjaan-item bg-gray-50 p-4 rounded-lg mb-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div><label class="block text-sm font-medium mb-2">Nama Perusahaan</label>
                        <input type="text" name="pekerjaan_perusahaan[]" class="w-full border rounded-lg px-3 py-2"></div>
                    <div> <label class="block text-sm font-medium mb-2">Tanggal Masuk</label>
                        <input type="date" name="pekerjaan_tgl_masuk[]" placeholder="Tanggal Masuk" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-sm font-medium mb-2">Tanggal Keluar</label>
                        <input type="date" name="pekerjaan_tgl_keluar[]" placeholder="Tanggal Keluar" class="w-full border rounded-lg px-3 py-2"></div>

                    <div><label class="block text-sm font-medium mb-2">Jabatan Terakhir</label>
                        <input type="text" name="pekerjaan_jabatan[]"  class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-sm font-medium mb-2">Tugas Utama</label>
                        <input type="text" name="pekerjaan_tugas_utama[]" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-sm font-medium mb-2">Gaji Terakhir</label>
                        <input type="number" name="pekerjaan_gaji[]" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-sm font-medium mb-2">Alasan Keluar</label>
                        <input type="text" name="pekerjaan_alasan[]" class="w-full border rounded-lg px-3 py-2"></div>
                </div>
                <button type="button" class="remove-pekerjaan text-red-500 text-sm mt-2 hover:text-red-700">Hapus</button>
            </div>
        </div>
        <button type="button" id="tambah-pekerjaan" class="text-primary text-sm hover:text-primary-dark mt-2">
            <i class="fas fa-plus mr-1"></i> Tambah Pengalaman Kerja
        </button>
    </div>
    
    <div class="mb-8">
        <label class="block text-sm font-medium mb-2">Bidang minat pada pekerjaan:</label>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
            <label><input type="checkbox" name="bidang_minat[]" value="Logistic & Distribution"> Logistic & Distribution</label>
            <label><input type="checkbox" name="bidang_minat[]" value="Sales/Marketing"> Sales/Marketing</label>
            <label><input type="checkbox" name="bidang_minat[]" value="Finance, Accounting, & Tax"> Finance, Accounting, & Tax</label>
            <label><input type="checkbox" name="bidang_minat[]" value="Production"> Production</label>
            <label><input type="checkbox" name="bidang_minat[]" value="Business Development"> Business Development</label>
            <label><input type="checkbox" name="bidang_minat[]" value="Human Resources"> Human Resources</label>
            <label><input type="checkbox" name="bidang_minat[]" value="General Affair"> General Affair</label>
            <label><input type="checkbox" name="bidang_minat[]" value="QAQC"> QAQC</label>
            <label><input type="checkbox" name="bidang_minat[]" value="Information Technology"> Information Technology</label>
            <label><input type="checkbox" name="bidang_minat[]" value="Product Development"> Product Development</label>
        </div>
        <div class="mt-2"><input type="text" name="bidang_minat_lain" placeholder="Lainnya..." class="w-full md:w-1/2 border rounded-lg px-3 py-2"></div>
    </div>
    
    <!-- G. REFERENSI -->
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">G. REFERENSI</h2>
    <label class="block text-sm font-medium mb-2">Siapa yang mereferensikan / merekomendasikan anda untuk melamar di perusahaan kami ?</label>

    <div class="mb-6">
        <div id="referensi-container">
            <div class="referensi-item bg-gray-50 p-4 rounded-lg mb-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div><label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                        <input type="text" name="referensi_nama[]" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-sm font-medium mb-2">Alamat Lengkap</label>
                        <input type="text" name="referensi_alamat[]" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-sm font-medium mb-2">No. Telp/HP</label>
                        <input type="number" name="referensi_telp[]"  class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-sm font-medium mb-2">Hubungan</label>
                        <input type="text" name="referensi_hubungan[]" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-sm font-medium mb-2">Lama Kenal</label>
                        <input type="text" name="referensi_lama_kenal[]" class="w-full border rounded-lg px-3 py-2"></div>
                </div>
                <button type="button" class="remove-referensi text-red-500 text-sm mt-2 hover:text-red-700">Hapus</button>
            </div>
        </div>
        <button type="button" id="tambah-referensi" class="text-primary text-sm hover:text-primary-dark mt-2">
            <i class="fas fa-plus mr-1"></i> Tambah Referensi
        </button>
    </div>
    
    <div class="mb-8">
        <label class="block text-sm font-medium mb-2">Apakah Anda mempunyai saudara/kenalan yang bekerja di perusahaan kami?</label>
        <div class="flex gap-4">
            <label><input type="radio" name="punya_saudara_di_perusahaan" value="1" class="mr-1" onclick="toggleSaudaraForm(true)"> Ya</label>
            <label><input type="radio" name="punya_saudara_di_perusahaan" value="0" class="mr-1" checked onclick="toggleSaudaraForm(false)"> Tidak</label>
        </div>
        
        <div id="saudara-form" class="hidden mt-4">
            <div id="saudara-container">
                <div class="saudara-item bg-gray-50 p-4 rounded-lg mb-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div><label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                            <input type="text" name="saudara_nama[]" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><label class="block text-sm font-medium mb-2">Jabatan/Unit Kerja</label>
                            <input type="text" name="saudara_jabatan[]"  class="w-full border rounded-lg px-3 py-2"></div>
                        <div><label class="block text-sm font-medium mb-2">Lama Kenal</label>
                            <input type="text" name="saudara_lama_kenal[]" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><label class="block text-sm font-medium mb-2">Hubungan</label>
                            <input type="text" name="saudara_hubungan[]" class="w-full border rounded-lg px-3 py-2"></div>
                    </div>
                    <button type="button" class="remove-saudara text-red-500 text-sm mt-2 hover:text-red-700">Hapus</button>
                </div>
            </div>
            <button type="button" id="tambah-saudara" class="text-primary text-sm hover:text-primary-dark mt-2">+ Tambah Saudara/Kenalan</button>
        </div>
    </div>
    
    <!-- H. RIWAYAT KESEHATAN -->
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">H. RIWAYAT KESEHATAN</h2>
    
    <div class="space-y-6 mb-8">
        <div>
            <label class="block text-sm font-medium mb-2">1. Apakah Anda pernah menderita sakit berat dan dirawat di rumah sakit selama 2 tahun terakhir?</label>
            <div class="flex gap-4">
                <label><input type="radio" name="pernah_sakit_berat" value="1" class="mr-1" onclick="toggleSakitBerat(true)"> Ya</label>
                <label><input type="radio" name="pernah_sakit_berat" value="0" class="mr-1" checked onclick="toggleSakitBerat(false)"> Tidak</label>
            </div>
            <div id="sakit-berat-detail" class="hidden mt-2">
                <textarea name="sakit_berat_keterangan" rows="3" class="w-full border rounded-lg px-3 py-2" placeholder="Jelaskan kapan, dimana, nama penyakit, dan berapa lama..."></textarea>
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-medium mb-2">2. Apakah Anda mempunyai penyakit keturunan, cacat keturunan atau cacat akibat kecelakaan?</label>
            <div class="flex gap-4">
                <label><input type="radio" name="punya_penyakit_keturunan" value="1" class="mr-1" onclick="togglePenyakitKeturunan(true)"> Ya</label>
                <label><input type="radio" name="punya_penyakit_keturunan" value="0" class="mr-1" checked onclick="togglePenyakitKeturunan(false)"> Tidak</label>
            </div>
            <div id="penyakit-keturunan-detail" class="hidden mt-2">
                <textarea name="penyakit_keturunan_keterangan" rows="3" class="w-full border rounded-lg px-3 py-2" placeholder="Jelaskan secara garis besar..."></textarea>
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-medium mb-2">3. Apakah Anda mempunyai gangguan penglihatan/memakai kacamata?</label>
            <div class="flex gap-4">
                <label><input type="radio" name="pakai_kacamata" value="1" class="mr-1" onclick="toggleKacamata(true)"> Ya</label>
                <label><input type="radio" name="pakai_kacamata" value="0" class="mr-1" checked onclick="toggleKacamata(false)"> Tidak</label>
            </div>
            <div id="kacamata-detail" class="hidden mt-2">
                <input type="text" name="ukuran_kacamata" placeholder="Ukuran kacamata (contoh: minus 2, plus 1, dll)" class="w-full md:w-1/2 border rounded-lg px-3 py-2">
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-medium mb-2">4. Apakah Anda mempunyai alergi?</label>
            <div class="flex gap-4">
                <label><input type="radio" name="punya_alergi" value="1" class="mr-1" onclick="toggleAlergi(true)"> Ya</label>
                <label><input type="radio" name="punya_alergi" value="0" class="mr-1" checked onclick="toggleAlergi(false)"> Tidak</label>
            </div>
            <div id="alergi-detail" class="hidden mt-2">
                <textarea name="alergi_keterangan" rows="3" class="w-full border rounded-lg px-3 py-2" placeholder="Jelaskan alergi yang anda miliki..."></textarea>
            </div>
        </div>
    </div>
    
    <!-- I. DATA KELUARGA -->
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">I. DATA KELUARGA</h2>
    
    <!-- 1. Data Istri/Suami -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-semibold text-gray-700">1. Data Istri/Suami</h3>
            <label class="inline-flex items-center">
                <input type="checkbox" name="punya_pasangan" value="1" class="mr-2" onclick="togglePasanganForm(this.checked)">
                <span class="text-sm">Data Istri/Suami</span>
            </label>
        </div>
        
        <div id="pasangan-form" class="hidden bg-gray-50 p-4 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><input type="text" name="nama_pasangan" placeholder="Nama Lengkap" class="w-full border rounded-lg px-3 py-2"></div>
                <div><input type="text" name="tempat_lahir_pasangan" placeholder="Tempat Lahir" class="w-full border rounded-lg px-3 py-2"></div>
                <div><label class="block text-sm font-medium mb-2">Tanggal Lahir Pasangan</label>
                    <input type="date" name="tanggal_lahir_pasangan" placeholder="Tanggal Lahir" class="w-full border rounded-lg px-3 py-2"></div>
                <div><label class="block text-sm font-medium mb-2">Tanggal Menikah</label>
                    <input type="date" name="tanggal_menikah" placeholder="Tanggal Menikah" class="w-full border rounded-lg px-3 py-2"></div>
                <div>
                    <select name="agama_pasangan" class="w-full border rounded-lg px-3 py-2">
                    <option value="">Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select></div>
                <div><textarea name="alamat_pasangan" rows="2" placeholder="Alamat Tinggal" class="w-full border rounded-lg px-3 py-2"></textarea></div>
                <div><input type="text" name="pekerjaan_pasangan" placeholder="Pekerjaan" class="w-full border rounded-lg px-3 py-2"></div>
                <div><input type="text" name="jabatan_pasangan" placeholder="Jabatan" class="w-full border rounded-lg px-3 py-2"></div>
            </div>
        </div>
    </div>
    
    <!-- 2. Data pribadi anak -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-semibold text-gray-700">2. Data Pribadi Anak</h3>
            <label class="inline-flex items-center">
                <input type="checkbox" name="punya_anak" value="1" class="mr-2" onclick="toggleAnakForm(this.checked)">
                <span class="text-sm">Data Anak</span>
            </label>
        </div>
        
        <div id="anak-form" class="hidden">
            <div id="anak-container">
                <div class="anak-item bg-gray-50 p-4 rounded-lg mb-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div><input type="text" name="anak_nama[]" placeholder="Nama Lengkap" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><select name="anak_jenis_kelamin[]" class="w-full border rounded-lg px-3 py-2"><option value="">Jenis Kelamin</option><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></div>
                        <div><label class="block text-sm font-medium mb-2">Tempat Lahir</label>
                            <input type="text" name="anak_tempat_lahir[]" placeholder="Tempat Lahir" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><label class="block text-sm font-medium mb-2">Tanggal Lahir</label>
                            <input type="date" name="anak_tanggal_lahir[]" placeholder="Tanggal Lahir" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><input type="text" name="anak_pendidikan[]" placeholder="Pendidikan" class="w-full border rounded-lg px-3 py-2"></div>
                    </div>
                    <button type="button" class="remove-anak text-red-500 text-sm mt-2 hover:text-red-700">Hapus</button>
                </div>
            </div>
            <button type="button" id="tambah-anak" class="text-primary text-sm hover:text-primary-dark mt-2">+ Tambah Anak</button>
        </div>
    </div>
    
    <!-- 3. Riwayat penyakit istri/suami/anak -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-semibold text-gray-700">3. Riwayat Penyakit Istri/Suami/Anak</h3>
            <label class="inline-flex items-center">
                <input type="checkbox" name="punya_penyakit_keluarga" value="1" class="mr-2" onclick="togglePenyakitKeluargaForm(this.checked)">
                <span class="text-sm">Data Riwayat Penyakit Keluarga</span>
            </label>
        </div>
    
        <div id="penyakit-keluarga-form" class="hidden">
            <div id="penyakit-container">
                <div class="penyakit-item bg-gray-50 p-4 rounded-lg mb-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div><input type="text" name="penyakit_nama[]" placeholder="Nama" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><input type="text" name="penyakit_jenis[]" placeholder="Jenis Penyakit" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><input type="text" name="penyakit_hubungan[]" placeholder="Hubungan" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><input type="text" name="penyakit_tahun[]" placeholder="Tahun Dirawat" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><input type="text" name="penyakit_tempat[]" placeholder="Tempat" class="w-full border rounded-lg px-3 py-2"></div>
                    </div>
                    <button type="button" class="remove-penyakit text-red-500 text-sm mt-2 hover:text-red-700">Hapus</button>
                </div>
            </div>
            <button type="button" id="tambah-penyakit" class="text-primary text-sm hover:text-primary-dark mt-2">+ Tambah Riwayat Penyakit</button>
        </div>
    </div>
    
    <!-- 4. Orang Tua -->
    <div class="mb-6">
        <h3 class="font-semibold text-gray-700 mb-3">4. Orang Tua <span class="text-red-500">*</span></h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="font-medium text-black mb-2">Ayah <span class="text-red-500">*</span></h4>
                <div class="space-y-2">
                    <label class="block text-sm text-gray-700 font-medium mb-2">ㅤNama Lengkap</label>
                    <input type="text" name="nama_ayah" required  class="w-full border rounded-lg px-3 py-2">
                    <label class="block text-sm text-gray-700 font-medium mb-2">ㅤAgama</label>
                    <select name="agama_ayah" required class="w-full border rounded-lg px-3 py-2">
                        <option value="">Pilih</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                    <label class="block text-sm text-gray-700 font-medium mb-2">ㅤUsia</label>
                    <input type="number" name="usia_ayah" required class="w-full border rounded-lg px-3 py-2">
                    <label class="block text-sm text-gray-700 font-medium mb-2">ㅤPekerjaan Ayah</label>
                    <input type="text" name="pekerjaan_ayah" required class="w-full border rounded-lg px-3 py-2">
                    <label class="block text-sm text-gray-700 font-medium mb-2">ㅤAlamat & No. Telp</label>
                    <textarea name="alamat_ayah" required rows="2" placeholder="Alamat ( No. Telp )" class="w-full border rounded-lg px-3 py-2"></textarea>
                </div>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="font-medium text-black mb-2">Ibu <span class="text-red-500">*</span></h4>
                <div class="space-y-2">
                    <label class="block text-sm text-gray-700 font-medium mb-2">ㅤNama Lengkap</label>
                    <input type="text" name="nama_ibu" required class="w-full border rounded-lg px-3 py-2">
                    <label class="block text-sm text-gray-700 font-medium mb-2">ㅤAgama</label>
                    <select name="agama_ibu" required class="w-full border rounded-lg px-3 py-2">
                    <option value="">Pilih</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option></select>
                    <label class="block text-sm text-gray-700 font-medium mb-2">ㅤUsia</label>
                    <input type="number" name="usia_ibu" required class="w-full border rounded-lg px-3 py-2">
                    <label class="block text-sm text-gray-700 font-medium mb-2">ㅤPekerjaan</label>
                    <input type="text" name="pekerjaan_ibu" required class="w-full border rounded-lg px-3 py-2">
                    <label class="block text-sm text-gray-700 font-medium mb-2">ㅤAlamat & No. Telp</label>
                    <textarea name="alamat_ibu" required rows="2" placeholder="Alamat ( No. Telp )" class="w-full border rounded-lg px-3 py-2"></textarea>
                </div>
            </div>
        </div>
    </div>
    
    <!-- 5. Orang terdekat yang dapat dihubungi dalam keadaan darurat -->
    <div class="mb-6">
        <h3 class="font-semibold text-gray-700 mb-3">5. Orang Terdekat yang Dapat Dihubungi dalam Keadaan Darurat</h3>
        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div><label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                    <input type="text" name="kontak_darurat_nama" class="w-full border rounded-lg px-3 py-2"></div>
                <div><label class="block text-sm font-medium mb-2">Hubungan</label>
                    <input type="text" name="kontak_darurat_hubungan" class="w-full border rounded-lg px-3 py-2"></div>
                <div><label class="block text-sm font-medium mb-2">Alamat Tinggal</label>
                    <textarea name="kontak_darurat_alamat" rows="2" class="w-full border rounded-lg px-3 py-2"></textarea></div>
                <div><label class="block text-sm font-medium mb-2">No. Telepon</label>
                    <input type="number" name="kontak_darurat_telp" class="w-full border rounded-lg px-3 py-2"></div>
                <div><label class="block text-sm font-medium mb-2">No. Handphone</label>
                    <input type="number" name="kontak_darurat_hp" class="w-full border rounded-lg px-3 py-2"></div>
                <div><label class="block text-sm font-medium mb-2">Pekerjaan</label>
                    <input type="text" name="kontak_darurat_pekerjaan" class="w-full border rounded-lg px-3 py-2"></div>
                <div><label class="block text-sm font-medium mb-2">Jabatan</label>
                    <input type="text" name="kontak_darurat_jabatan" class="w-full border rounded-lg px-3 py-2"></div>
            </div>
        </div>
    </div>
    
    <!-- 6. Saudara kandung (termasuk pelamar) -->
    <div class="mb-8">
        <h3 class="font-semibold text-gray-700 mb-3">6. Saudara Kandung (Termasuk Pelamar)</h3>
        <div id="saudara-kandung-container">
            <div class="saudara-kandung-item bg-gray-50 p-4 rounded-lg mb-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div><label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                        <input type="text" name="saudara_kandung_nama[]" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-sm font-medium mb-2">Jenis Kelamin</label>
                        <select name="saudara_kandung_jk[]" class="w-full border rounded-lg px-3 py-2"><option value="">L/P</option><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></div>
                    <div><label class="block text-sm font-medium mb-2">Usia</label>
                        <input type="number" name="saudara_kandung_usia[]" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-sm font-medium mb-2">Pendidikan</label>
                        <input type="text" name="saudara_kandung_pendidikan[]" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-sm font-medium mb-2">Pekerjaan</label>
                        <input type="text" name="saudara_kandung_pekerjaan[]" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><label class="block text-sm font-medium mb-2">Hubungan</label>
                        <input type="text" name="saudara_kandung_hubungan[]" class="w-full border rounded-lg px-3 py-2"></div>
                </div>
                <button type="button" class="remove-saudara-kandung text-red-500 text-sm mt-2 hover:text-red-700">Hapus</button>
            </div>
        </div>
        <button type="button" id="tambah-saudara-kandung" class="text-primary text-sm hover:text-primary-dark mt-2">+ Tambah Saudara Kandung</button>
    </div>
    
    <!-- J. REMUNERASI -->
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">J. REMUNERASI</h2>

    <div class="mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Gaji per bulan yang diharapkan</label>
                <input type="number" required name="gaji_diharapkan" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1 opacity-0" >ㅤ</label>
                <div class="flex gap-4 mt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="gaji_tipe" value="brutto" class="mr-2"> Kotor
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="gaji_tipe" value="netto" class="mr-2" checked> Bersih
                    </label>
                </div>
            </div>
        </div>
    </div>
    
    <!-- K. WAKTU -->
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">K. WAKTU</h2>
    
    <div class="mb-8">
        <label class="block text-sm font-medium mb-1">Jika lamaran Anda diterima, berapa lama waktu yang Anda perlukan untuk dapat bergabung? <span class="text-red-500">*</span></label>
        <input type="text" name="waktu_bergabung" required class="w-full md:w-1/2 border rounded-lg px-3 py-2" placeholder="Contoh: 2 minggu, 1 bulan, dll">
    </div>
    
    <!-- L. PERNYATAAN -->
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">L. PERNYATAAN</h2>

    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
        <p class="text-sm mb-4">Dengan ini saya menyatakan bahwa semua keterangan yang saya cantumkan dalam formulir ini adalah benar dan sah. Seandainya saya diterima dan kemudian terbukti bahwa salah satu saja keterangan saya tersebut tidak benar, maka saya bersedia mengundurkan diri tanpa persyaratan apapun dengan segera dari perusahaan ini.</p>
    
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-1">Tempat</label>
                <input type="text" name="tempat_pernyataan" placeholder="Tempat" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal Pernyataan</label>
                <input type="text" value="{{ date('d/m/Y') }}" class="w-full border rounded-lg px-3 py-2 bg-gray-100" readonly disabled>
                <input type="hidden" name="tanggal_pernyataan" value="{{ date('Y-m-d') }}">
            </div>
        </div>
    
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="pernyataan_setuju" value="1" required class="mr-2">
                <span class="text-sm">Saya menyatakan bahwa data yang saya isi adalah benar <span class="text-red-500">*</span></span>
            </label>
        </div>
    </div>
</div>

<script>
    // ============================================
    // KEKUATAN & KELEMAHAN
    // ============================================
    const MIN_ITEMS = 5;

    function updateKekuatanNumbers() {
        const items = document.querySelectorAll('#kekuatan-container .kekuatan-item');
        items.forEach((item, index) => {
            const numSpan = item.querySelector('.item-number');
            if (numSpan) numSpan.textContent = `${index + 1}.`;
        });
    
        const removeBtns = document.querySelectorAll('#kekuatan-container .remove-kekuatan');
        removeBtns.forEach(btn => {
            if (items.length > MIN_ITEMS) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
    }

    function addKekuatan() {
        const container = document.getElementById('kekuatan-container');
        const div = document.createElement('div');
        div.className = 'kekuatan-item flex items-center mb-2';
        div.innerHTML = `
            <span class="item-number w-6 text-sm font-medium text-gray-500 text-left"></span>
            <input type="text" name="kekuatan[]" class="flex-1 border rounded-lg px-3 py-2">
            <button type="button" onclick="removeKekuatan(this)" class="remove-kekuatan ml-2 text-red-500 hover:text-red-700 hidden">✕</button>
        `;
        container.appendChild(div);
        updateKekuatanNumbers();
    }

    function removeKekuatan(btn) {
        const container = document.getElementById('kekuatan-container');
        if (container.children.length > MIN_ITEMS) {
            btn.parentElement.remove();
            updateKekuatanNumbers();
        }
    }

    function updateKelemahanNumbers() {
        const items = document.querySelectorAll('#kelemahan-container .kelemahan-item');
        items.forEach((item, index) => {
            const numSpan = item.querySelector('.item-number');
            if (numSpan) numSpan.textContent = `${index + 1}.`;
        });
    
        const removeBtns = document.querySelectorAll('#kelemahan-container .remove-kelemahan');
        removeBtns.forEach(btn => {
            if (items.length > MIN_ITEMS) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
    }

    function addKelemahan() {
        const container = document.getElementById('kelemahan-container');
        const div = document.createElement('div');
        div.className = 'kelemahan-item flex items-center mb-2';
        div.innerHTML = `
            <span class="item-number w-6 text-sm font-medium text-gray-500 text-left"></span>
            <input type="text" name="kelemahan[]" class="flex-1 border rounded-lg px-3 py-2">
            <button type="button" onclick="removeKelemahan(this)" class="remove-kelemahan ml-2 text-red-500 hover:text-red-700 hidden">✕</button>
        `;
        container.appendChild(div);
        updateKelemahanNumbers();
    }

    function removeKelemahan(btn) {
        const container = document.getElementById('kelemahan-container');
        if (container.children.length > MIN_ITEMS) {
            btn.parentElement.remove();
            updateKelemahanNumbers();
        }
    }

    function initKekuatanKelemahan() {
        // Kosongkan container
        const kekuatanContainer = document.getElementById('kekuatan-container');
        const kelemahanContainer = document.getElementById('kelemahan-container');
    
        kekuatanContainer.innerHTML = '';
        kelemahanContainer.innerHTML = '';
    
        // Buat item pertama
        for (let i = 0; i < MIN_ITEMS; i++) {
            addKekuatan();
            addKelemahan();
        }
    
        updateKekuatanNumbers();
        updateKelemahanNumbers();
    }

    // Jalankan setelah DOM siap
    document.addEventListener('DOMContentLoaded', function() {
        initKekuatanKelemahan();
    });

    // ============================================
    // PEKERJAAN
    // ============================================
    function updateRemovePekerjaan() {
        const items = document.querySelectorAll('#pekerjaan-container .pekerjaan-item');
        const buttons = document.querySelectorAll('#pekerjaan-container .remove-pekerjaan');
    
        buttons.forEach(btn => {
            if (items.length > 1) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
    }

    document.getElementById('tambah-pekerjaan')?.addEventListener('click', function() {
        const container = document.getElementById('pekerjaan-container');
        const template = container.children[0].cloneNode(true);
        template.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(template);
    
        template.querySelector('.remove-pekerjaan')?.addEventListener('click', function() {
            if (container.children.length > 1) {
                template.remove();
                updateRemovePekerjaan();
            }
        });
    
        updateRemovePekerjaan();
    });

    // Setup remove untuk item pertama
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('pekerjaan-container');
        if (container) {
            container.querySelectorAll('.pekerjaan-item').forEach(item => {
                const removeBtn = item.querySelector('.remove-pekerjaan');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function() {
                        if (container.children.length > 1) {
                            item.remove();
                            updateRemovePekerjaan();
                        }
                    });
                }
            });
            updateRemovePekerjaan();
        }
    });

    // ============================================
    // REFERENSI
    // ============================================
    function updateRemoveReferensi() {
        const items = document.querySelectorAll('#referensi-container .referensi-item');
        const buttons = document.querySelectorAll('#referensi-container .remove-referensi');
    
        buttons.forEach(btn => {
            if (items.length > 1) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
    }

    document.getElementById('tambah-referensi')?.addEventListener('click', function() {
        const container = document.getElementById('referensi-container');
        const template = container.children[0].cloneNode(true);
        template.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(template);
    
        template.querySelector('.remove-referensi')?.addEventListener('click', function() {
            if (container.children.length > 1) {
                template.remove();
                updateRemoveReferensi();
            }
        });
    
        updateRemoveReferensi();
    });

    // Setup remove untuk item pertama
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('referensi-container');
        if (container) {
            container.querySelectorAll('.referensi-item').forEach(item => {
                const removeBtn = item.querySelector('.remove-referensi');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function() {
                        if (container.children.length > 1) {
                            item.remove();
                            updateRemoveReferensi();
                        }
                    });
                }
            });
            updateRemoveReferensi();
        }
    });

    // ============================================
    // SAUDARA/KENALAN DI PERUSAHAAN
    // ============================================
    function updateRemoveSaudara() {
        const items = document.querySelectorAll('#saudara-container .saudara-item');
        const buttons = document.querySelectorAll('#saudara-container .remove-saudara');
    
        buttons.forEach(btn => {
            if (items.length > 1) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
    }

    document.getElementById('tambah-saudara')?.addEventListener('click', function() {
        const container = document.getElementById('saudara-container');
        const template = container.children[0].cloneNode(true);
        template.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(template);
    
        template.querySelector('.remove-saudara')?.addEventListener('click', function() {
            if (container.children.length > 1) {
                template.remove();
                updateRemoveSaudara();
            }
        });
    
        updateRemoveSaudara();
    });

    // Setup remove untuk item pertama
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('saudara-container');
        if (container) {
            container.querySelectorAll('.saudara-item').forEach(item => {
                const removeBtn = item.querySelector('.remove-saudara');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function() {
                        if (container.children.length > 1) {
                            item.remove();
                            updateRemoveSaudara();
                        }
                    });
                }
            });
            updateRemoveSaudara();
        }
    });

    // ============================================
    // DATA ANAK
    // ============================================
    function updateRemoveAnak() {
        const items = document.querySelectorAll('#anak-container .anak-item');
        const buttons = document.querySelectorAll('#anak-container .remove-anak');
    
        buttons.forEach(btn => {
            if (items.length > 1) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
    }

    document.getElementById('tambah-anak')?.addEventListener('click', function() {
        const container = document.getElementById('anak-container');
        const template = container.children[0].cloneNode(true);
        template.querySelectorAll('input, select').forEach(input => {
            if (input.type !== 'radio' && input.type !== 'checkbox') {
                input.value = '';
            }
        });
        container.appendChild(template);
    
        template.querySelector('.remove-anak')?.addEventListener('click', function() {
            if (container.children.length > 1) {
                template.remove();
                updateRemoveAnak();
            }
        });
    
        updateRemoveAnak();
    });

    // Setup remove untuk item pertama
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('anak-container');
        if (container) {
            container.querySelectorAll('.anak-item').forEach(item => {
                const removeBtn = item.querySelector('.remove-anak');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function() {
                        if (container.children.length > 1) {
                            item.remove();
                            updateRemoveAnak();
                        }
                    });
                }
            });
            updateRemoveAnak();
        }
    });

    // ============================================
    // RIWAYAT PENYAKIT KELUARGA
    // ============================================
    function updateRemovePenyakit() {
        const items = document.querySelectorAll('#penyakit-container .penyakit-item');
        const buttons = document.querySelectorAll('#penyakit-container .remove-penyakit');
    
        buttons.forEach(btn => {
            if (items.length > 1) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
    }

    document.getElementById('tambah-penyakit')?.addEventListener('click', function() {
        const container = document.getElementById('penyakit-container');
        const template = container.children[0].cloneNode(true);
        template.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(template);
    
        template.querySelector('.remove-penyakit')?.addEventListener('click', function() {
            if (container.children.length > 1) {
                template.remove();
                updateRemovePenyakit();
            }
        });
    
        updateRemovePenyakit();
    });

    // Setup remove untuk item pertama
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('penyakit-container');
        if (container) {
            container.querySelectorAll('.penyakit-item').forEach(item => {
                const removeBtn = item.querySelector('.remove-penyakit');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function() {
                        if (container.children.length > 1) {
                            item.remove();
                            updateRemovePenyakit();
                        }
                    });
                }
            });
            updateRemovePenyakit();
        }
    });

    // ============================================
    // SAUDARA KANDUNG
    // ============================================
    function updateRemoveSaudaraKandung() {
        const items = document.querySelectorAll('#saudara-kandung-container .saudara-kandung-item');
        const buttons = document.querySelectorAll('#saudara-kandung-container .remove-saudara-kandung');
    
        buttons.forEach(btn => {
            if (items.length > 1) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
    }

    document.getElementById('tambah-saudara-kandung')?.addEventListener('click', function() {
        const container = document.getElementById('saudara-kandung-container');
        const template = container.children[0].cloneNode(true);
        template.querySelectorAll('input, select').forEach(input => {
            if (input.type !== 'radio' && input.type !== 'checkbox') {
                input.value = '';
            }
        });
        container.appendChild(template);
    
        template.querySelector('.remove-saudara-kandung')?.addEventListener('click', function() {
            if (container.children.length > 1) {
                template.remove();
                updateRemoveSaudaraKandung();
            }
        });
    
        updateRemoveSaudaraKandung();
    });

    // Setup remove untuk item pertama
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('saudara-kandung-container');
        if (container) {
            container.querySelectorAll('.saudara-kandung-item').forEach(item => {
                const removeBtn = item.querySelector('.remove-saudara-kandung');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function() {
                        if (container.children.length > 1) {
                            item.remove();
                            updateRemoveSaudaraKandung();
                        }
                    });
                }
            });
            updateRemoveSaudaraKandung();
        }
    });
</script>   