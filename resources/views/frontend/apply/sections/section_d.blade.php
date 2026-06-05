<div>
    <!-- E. KEKUATAN & KELEMAHAN -->
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">E. KEKUATAN &amp; KELEMAHAN</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <div>
            <label class="block text-sm font-medium mb-1">Kekuatan / Kelebihan</label>
            <textarea name="kekuatan" rows="3" class="w-full border rounded-lg px-3 py-2" placeholder="Tuliskan kekuatan/kelebihan Anda..."></textarea>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Kelemahan / Kekurangan</label>
            <textarea name="kelemahan" rows="3" class="w-full border rounded-lg px-3 py-2" placeholder="Tuliskan kelemahan/kekurangan Anda..."></textarea>
        </div>
    </div>
    
    <!-- F. RIWAYAT PEKERJAAN -->
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">F. RIWAYAT PEKERJAAN</h2>
    
    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Pengalaman kerja sebelumnya (urutkan dari yang terbaru)</label>
        <div id="pekerjaan-container">
            <div class="pekerjaan-item bg-gray-50 p-4 rounded-lg mb-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div><input type="text" name="pekerjaan_perusahaan[]" placeholder="Nama Perusahaan" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="date" name="pekerjaan_tgl_masuk[]" placeholder="Tanggal Masuk" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="date" name="pekerjaan_tgl_keluar[]" placeholder="Tanggal Keluar" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="pekerjaan_jabatan[]" placeholder="Jabatan Terakhir & Tugas Utama" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="pekerjaan_gaji[]" placeholder="Gaji Terakhir" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="pekerjaan_alasan[]" placeholder="Alasan Keluar" class="w-full border rounded-lg px-3 py-2"></div>
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
    
    <div class="mb-6">
        <div id="referensi-container">
            <div class="referensi-item bg-gray-50 p-4 rounded-lg mb-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div><input type="text" name="referensi_nama[]" placeholder="Nama Lengkap" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="referensi_alamat[]" placeholder="Alamat Lengkap" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="referensi_telp[]" placeholder="No. Telp/HP" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="referensi_hubungan[]" placeholder="Hubungan" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="referensi_lama_kenal[]" placeholder="Lama Kenal" class="w-full border rounded-lg px-3 py-2"></div>
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
                        <div><input type="text" name="saudara_nama[]" placeholder="Nama Lengkap" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><input type="text" name="saudara_jabatan[]" placeholder="Jabatan/Unit Kerja" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><input type="text" name="saudara_lama_kenal[]" placeholder="Lama Kenal" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><input type="text" name="saudara_hubungan[]" placeholder="Hubungan" class="w-full border rounded-lg px-3 py-2"></div>
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
                <span class="text-sm">Punya Istri/Suami</span>
            </label>
        </div>
        
        <div id="pasangan-form" class="hidden bg-gray-50 p-4 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><input type="text" name="nama_pasangan" placeholder="Nama Lengkap" class="w-full border rounded-lg px-3 py-2"></div>
                <div><input type="text" name="tempat_lahir_pasangan" placeholder="Tempat Lahir" class="w-full border rounded-lg px-3 py-2"></div>
                <div><input type="date" name="tanggal_lahir_pasangan" placeholder="Tanggal Lahir" class="w-full border rounded-lg px-3 py-2"></div>
                <div><input type="date" name="tanggal_menikah" placeholder="Tanggal Menikah" class="w-full border rounded-lg px-3 py-2"></div>
                <div><input type="text" name="agama_pasangan" placeholder="Agama" class="w-full border rounded-lg px-3 py-2"></div>
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
                <span class="text-sm">Punya Anak</span>
            </label>
        </div>
        
        <div id="anak-form" class="hidden">
            <div id="anak-container">
                <div class="anak-item bg-gray-50 p-4 rounded-lg mb-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div><input type="text" name="anak_nama[]" placeholder="Nama Lengkap" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><select name="anak_jenis_kelamin[]" class="w-full border rounded-lg px-3 py-2"><option value="">Jenis Kelamin</option><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></div>
                        <div><input type="text" name="anak_tempat_lahir[]" placeholder="Tempat Lahir" class="w-full border rounded-lg px-3 py-2"></div>
                        <div><input type="date" name="anak_tanggal_lahir[]" placeholder="Tanggal Lahir" class="w-full border rounded-lg px-3 py-2"></div>
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
        <h3 class="font-semibold text-gray-700 mb-3">3. Riwayat Penyakit Istri/Suami/Anak</h3>
        <div id="penyakit-keluarga-container">
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
    
    <!-- 4. Orang Tua -->
    <div class="mb-6">
        <h3 class="font-semibold text-gray-700 mb-3">4. Orang Tua</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="font-medium text-primary mb-2">Ayah</h4>
                <div class="space-y-2">
                    <input type="text" name="nama_ayah" placeholder="Nama Lengkap" class="w-full border rounded-lg px-3 py-2">
                    <input type="text" name="agama_ayah" placeholder="Agama" class="w-full border rounded-lg px-3 py-2">
                    <input type="number" name="usia_ayah" placeholder="Usia" class="w-full border rounded-lg px-3 py-2">
                    <input type="text" name="pekerjaan_ayah" placeholder="Pekerjaan" class="w-full border rounded-lg px-3 py-2">
                    <textarea name="alamat_ayah" rows="2" placeholder="Alamat & No. Telp" class="w-full border rounded-lg px-3 py-2"></textarea>
                </div>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="font-medium text-primary mb-2">Ibu</h4>
                <div class="space-y-2">
                    <input type="text" name="nama_ibu" placeholder="Nama Lengkap" class="w-full border rounded-lg px-3 py-2">
                    <input type="text" name="agama_ibu" placeholder="Agama" class="w-full border rounded-lg px-3 py-2">
                    <input type="number" name="usia_ibu" placeholder="Usia" class="w-full border rounded-lg px-3 py-2">
                    <input type="text" name="pekerjaan_ibu" placeholder="Pekerjaan" class="w-full border rounded-lg px-3 py-2">
                    <textarea name="alamat_ibu" rows="2" placeholder="Alamat & No. Telp" class="w-full border rounded-lg px-3 py-2"></textarea>
                </div>
            </div>
        </div>
    </div>
    
    <!-- 5. Orang terdekat yang dapat dihubungi dalam keadaan darurat -->
    <div class="mb-6">
        <h3 class="font-semibold text-gray-700 mb-3">5. Orang Terdekat yang Dapat Dihubungi dalam Keadaan Darurat</h3>
        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div><input type="text" name="kontak_darurat_nama" placeholder="Nama Lengkap" class="w-full border rounded-lg px-3 py-2"></div>
                <div><input type="text" name="kontak_darurat_hubungan" placeholder="Hubungan" class="w-full border rounded-lg px-3 py-2"></div>
                <div><textarea name="kontak_darurat_alamat" rows="2" placeholder="Alamat Tinggal" class="w-full border rounded-lg px-3 py-2"></textarea></div>
                <div><input type="text" name="kontak_darurat_telp" placeholder="No. Telp" class="w-full border rounded-lg px-3 py-2"></div>
                <div><input type="text" name="kontak_darurat_hp" placeholder="No. HP" class="w-full border rounded-lg px-3 py-2"></div>
                <div><input type="text" name="kontak_darurat_pekerjaan" placeholder="Pekerjaan" class="w-full border rounded-lg px-3 py-2"></div>
                <div><input type="text" name="kontak_darurat_jabatan" placeholder="Jabatan" class="w-full border rounded-lg px-3 py-2"></div>
            </div>
        </div>
    </div>
    
    <!-- 6. Saudara kandung (termasuk pelamar) -->
    <div class="mb-8">
        <h3 class="font-semibold text-gray-700 mb-3">6. Saudara Kandung (Termasuk Pelamar)</h3>
        <div id="saudara-kandung-container">
            <div class="saudara-kandung-item bg-gray-50 p-4 rounded-lg mb-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div><input type="text" name="saudara_kandung_nama[]" placeholder="Nama Lengkap" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><select name="saudara_kandung_jk[]" class="w-full border rounded-lg px-3 py-2"><option value="">L/P</option><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></div>
                    <div><input type="number" name="saudara_kandung_usia[]" placeholder="Usia" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="saudara_kandung_pendidikan[]" placeholder="Pendidikan" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="saudara_kandung_pekerjaan[]" placeholder="Pekerjaan" class="w-full border rounded-lg px-3 py-2"></div>
                    <div><input type="text" name="saudara_kandung_hubungan[]" placeholder="Hubungan" class="w-full border rounded-lg px-3 py-2"></div>
                </div>
                <button type="button" class="remove-saudara-kandung text-red-500 text-sm mt-2 hover:text-red-700">Hapus</button>
            </div>
        </div>
        <button type="button" id="tambah-saudara-kandung" class="text-primary text-sm hover:text-primary-dark mt-2">+ Tambah Saudara Kandung</button>
    </div>
    
    <!-- J. REMUNERASI -->
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">J. REMUNERASI</h2>
    
    <div class="mb-8">
        <label class="block text-sm font-medium mb-1">Gaji per bulan yang diharapkan</label>
        <input type="text" name="gaji_diharapkan" class="w-full md:w-1/2 border rounded-lg px-3 py-2" placeholder="Contoh: Rp 5.000.000 (bruto/netto)">
    </div>
    
    <!-- K. WAKTU -->
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">K. WAKTU</h2>
    
    <div class="mb-8">
        <label class="block text-sm font-medium mb-1">Jika lamaran Anda diterima, berapa lama waktu yang Anda perlukan untuk dapat bergabung?</label>
        <input type="text" name="waktu_bergabung" class="w-full md:w-1/2 border rounded-lg px-3 py-2" placeholder="Contoh: 2 minggu, 1 bulan, dll">
    </div>
    
    <!-- L. PERNYATAAN -->
    <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">L. PERNYATAAN</h2>
    
    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
        <p class="text-sm mb-4">Dengan ini saya menyatakan bahwa semua keterangan yang saya cantumkan dalam formulir ini adalah benar dan sah. Seandainya saya diterima dan kemudian terbukti bahwa salah satu saja keterangan saya tersebut tidak benar, maka saya bersedia mengundurkan diri tanpa persyaratan apapun dengan segera dari perusahaan ini.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div><input type="text" name="tempat_pernyataan" placeholder="Tempat" class="w-full border rounded-lg px-3 py-2"></div>
            <div><input type="date" name="tanggal_pernyataan" class="w-full border rounded-lg px-3 py-2"></div>
        </div>
        
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="pernyataan_setuju" value="1" required class="mr-2">
                <span class="text-sm">Saya menyatakan bahwa data yang saya isi adalah benar <span class="text-red-500">*</span></span>
            </label>
        </div>
    </div>
</div>