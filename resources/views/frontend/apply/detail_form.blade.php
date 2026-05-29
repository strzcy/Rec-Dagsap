<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Isian Data Diri - Dagsap Recruitment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Tambahan sedikit konfigurasi warna jika Tailwind custom 'primary' belum terdefinisi */
        .bg-primary { background-color: #1e40af; }
        .text-primary { color: #1e40af; }
        .hover\:bg-primary-dark:hover { background-color: #1e3a8a; }
    </style>
</head>
<body class="bg-gray-100 font-[Inter]">
    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-primary text-white p-4">
                <h1 class="text-2xl font-bold">Form Isian Data Diri Pelamar</h1>
                <p class="text-sm opacity-90">PT Dagsap Endura Eatore</p>
            </div>
            
            <div class="p-6">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <p class="text-yellow-800 text-sm">
                        <i class="fas fa-info-circle mr-2"></i>
                        Bacalah petunjuk pengisiannya dengan baik dan isilah dengan data yang benar sesuai identitas diri anda.
                    </p>
                </div>
                
                <form action="{{ route('frontend.apply.store_detail', $pelamar) }}" method="POST" id="fullForm">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block font-semibold mb-2">Posisi yang dilamar:</label>
                        <input type="text" name="posisi_dilamar" value="{{ $pelamar->lowongan->judul }}" 
                               class="w-full border rounded-lg px-3 py-2 bg-gray-100" readonly>
                    </div>
                    
                    <div class="mb-8 border-b pb-4">
                        <h2 class="text-xl font-bold text-primary mb-4">A. DATA PRIBADI</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Nama Lengkap *</label>
                                <input type="text" name="nama_lengkap" required class="w-full border rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Jenis Kelamin *</label>
                                <select name="jenis_kelamin" required class="w-full border rounded-lg px-3 py-2">
                                    <option value="">Pilih</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Tempat Lahir *</label>
                                <input type="text" name="tempat_lahir" required class="w-full border rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Tanggal Lahir *</label>
                                <input type="date" name="tanggal_lahir" required class="w-full border rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Tinggi Badan (cm)</label>
                                <input type="number" name="tinggi_badan" class="w-full border rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Berat Badan (kg)</label>
                                <input type="number" name="berat_badan" class="w-full border rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Kewarganegaraan</label>
                                <input type="text" name="kewarganegaraan" value="Indonesia" class="w-full border rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Agama *</label>
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
                                <label class="block text-sm font-medium mb-1">Golongan Darah</label>
                                <select name="golongan_darah" class="w-full border rounded-lg px-3 py-2">
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
                            <label class="block text-sm font-medium mb-1">Alamat Tinggal *</label>
                            <textarea name="alamat_tinggal" rows="2" required class="w-full border rounded-lg px-3 py-2"></textarea>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-3">
                            <div><input type="text" name="rt_rw_tinggal" placeholder="RT/RW" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="kelurahan_tinggal" placeholder="Kelurahan" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="kecamatan_tinggal" placeholder="Kecamatan" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="kabupaten_tinggal" placeholder="Kabupaten" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="kota_tinggal" placeholder="Kota" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="provinsi_tinggal" placeholder="Provinsi" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="kode_pos_tinggal" placeholder="Kode Pos" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="no_telp" placeholder="No. Telp" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="no_hp" placeholder="No. HP *" required class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="no_wa" placeholder="No. WA" class="w-full border rounded-lg px-3 py-2"></div>
                        </div>
                        
                        <div class="mt-4">
                            <label class="block text-sm font-medium mb-1">Alamat KTP *</label>
                            <textarea name="alamat_ktp" rows="2" required class="w-full border rounded-lg px-3 py-2"></textarea>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-3">
                            <div><input type="text" name="rt_rw_ktp" placeholder="RT/RW" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="kelurahan_ktp" placeholder="Kelurahan" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="kecamatan_ktp" placeholder="Kecamatan" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="kabupaten_ktp" placeholder="Kabupaten" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="kota_ktp" placeholder="Kota" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="provinsi_ktp" placeholder="Provinsi" class="w-full border rounded-lg px-3 py-2"></div>
                            <div><input type="text" name="kode_pos_ktp" placeholder="Kode Pos" class="w-full border rounded-lg px-3 py-2"></div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
                            <div>
                                <label class="block text-sm font-medium mb-1">No. KTP/Passport *</label>
                                <input type="text" name="no_ktp" required class="w-full border rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">No. NPWP</label>
                                <input type="text" name="no_npwp" class="w-full border rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">No. BPJS</label>
                                <input type="text" name="no_bpjs_ketenagakerjaan" placeholder="BPJS Ketenagakerjaan" class="w-full border rounded-lg px-3 py-2">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
                            <div>
                                <label class="block text-sm font-medium mb-1">Status Perkawinan *</label>
                                <select name="status_perkawinan" required class="w-full border rounded-lg px-3 py-2">
                                    <option value="Lajang">Lajang</option>
                                    <option value="Nikah">Nikah</option>
                                    <option value="Bercerai">Bercerai</option>
                                    <option value="Pasangan Meninggal">Pasangan Meninggal</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Email *</label>
                                <input type="email" name="email" value="{{ $pelamar->email }}" required class="w-full border rounded-lg px-3 py-2 bg-gray-100" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Hobby</label>
                                <input type="text" name="hobby" class="w-full border rounded-lg px-3 py-2">
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <label class="block text-sm font-medium mb-1">Organisasi</label>
                            <textarea name="organisasi" rows="2" class="w-full border rounded-lg px-3 py-2" placeholder="Riwayat organisasi yang pernah diikuti"></textarea>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <a href="{{ url('/') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</a>
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                            <i class="fas fa-save mr-2"></i> Simpan & Lanjutkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Validasi angka tidak boleh minus
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value < 0) {
                    this.value = 0;
                }
            });
        });
        
        // Validasi tinggi dan berat badan
        const tinggiBadan = document.querySelector('input[name="tinggi_badan"]');
        const beratBadan = document.querySelector('input[name="berat_badan"]');
        
        if (tinggiBadan) {
            tinggiBadan.addEventListener('input', function() {
                if (this.value < 0) this.value = 0;
                if (this.value > 250) this.value = 250;
            });
        }
        
        if (beratBadan) {
            beratBadan.addEventListener('input', function() {
                if (this.value < 0) this.value = 0;
                if (this.value > 300) this.value = 300;
            });
        }
    </script>
</body>
</html>