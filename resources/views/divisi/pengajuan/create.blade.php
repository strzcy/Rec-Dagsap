    @extends('layouts.app')

    @section('title', 'Form Permintaan Tenaga Kerja')

    @section('header', 'Form Permintaan Tenaga Kerja')
    @section('subheader', 'Silakan isi identitas pemohon dan detail permintaan tenaga kerja')

    @section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('divisi.pengajuan.store') }}" method="POST" enctype="multipart/form-data" id="ptkForm">
            @csrf
            
            <!-- ============================================ -->
            <!-- BAGIAN 1: IDENTITAS PEMOHON -->
            <!-- ============================================ -->
            <div class="border-b pb-4 mb-6">
                <h2 class="text-xl font-semibold text-primary">A. IDENTITAS PEMOHON</h2>
                <p class="text-sm text-gray-500">Isi data diri Anda sebagai pemohon</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap Pemohon <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_pemohon" required 
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        NIP / NIK <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nip_pemohon" required 
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jabatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="jabatan_pemohon" required 
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        No. HP / WhatsApp <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" name="no_hp_pemohon" required 
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" placeholder="08**********">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Departemen / Divisi <span class="text-red-500">*</span>
                    </label>
                    <select name="departemen_dipilih" required class="w-full border rounded-lg px-3 py-2">
                        <option value="">-- Pilih Departemen --</option>
                        @foreach($divisis as $divisi)
                            <option value="{{ $divisi->id }}">{{ $divisi->nama_divisi }} ({{ $divisi->kode_divisi }})</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">PTK akan masuk ke Management terkait</p>
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- BAGIAN 2: PERMINTAAN TENAGA KERJA -->
            <!-- ============================================ -->
            <div class="border-b pb-4 mb-6">
                <h2 class="text-xl font-semibold text-primary">B. PERMINTAAN TENAGA KERJA</h2>
                <p class="text-sm text-gray-500">Isi detail permintaan tenaga kerja yang dibutuhkan</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Jabatan *</label>
                    <input type="text" name="posisi" id="posisi" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Area Penempatan *</label>
                    <input type="text" name="area_penempatan" id="area_penempatan" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div id="toko_penempatan_field" style="display: none;">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Toko Penempatan *</label>
                    <input type="text" name="toko_penempatan" id="toko_penempatan" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Dibutuhkan *</label>
                    <input type="number" name="jumlah" min="1" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Dibutuhkan <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal_dibutuhkan" 
                        min="{{ now()->addDays(31)->format('Y-m-d') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" 
                        required>
                    <p class="text-xs text-orange-600 mt-1">
                        <i class="fas fa-info-circle mr-1"></i> 
                        Minimal tanggal {{ now()->addDays(31)->format('d/m/Y') }} (31 hari dari sekarang)
                    </p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kebutuhan *</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="jenis" value="penambahan" class="mr-2" required> Penambahan
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="jenis" value="penggantian" class="mr-2"> Penggantian
                        </label>
                    </div>
                </div>
            </div>

            <!-- Field untuk Penggantian -->
            <div id="penggantian_field" style="display: none;" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Menggantikan Siapa?</label>
                    <input type="text" name="menggantikan" id="input_menggantikan" class="w-full border rounded-lg px-3 py-2" placeholder="Nama karyawan yang digantikan">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Surat Resign <span class="text-red-500">*</span></label>
                    <input type="file" name="lampiran" id="file_penggantian" accept=".pdf,.png,.jpg,.jpeg,.docx" class="w-full border rounded-lg px-3 py-2">
                    <p class="text-xs text-gray-500 mt-1">PDF/JPG/PNG/DOCX, maks 5MB</p>
                </div>
            </div>

            <div id="penambahan_field" style="display: none;" class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Dokumen Komitmen Target <span class="text-red-500">*</span></label>
                <input type="file" name="lampiran" id="file_penambahan" accept=".pdf,.png,.jpg,.jpeg,.docx" class="w-full border rounded-lg px-3 py-2">
                <p class="text-xs text-gray-500 mt-1">PDF/JPG/PNG/DOCX, maks 5MB</p>
            </div>
            
            <div class="mb-6" style="page-break-inside: avoid; break-inside: avoid;">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tugas dan Tanggung Jawab *</label>
        
                <div id="tugas_list" style="counter-reset: tugas-counter; padding-left: 5px;">
                    <div class="flex items-center mb-2" style="counter-increment: tugas-counter;">
                        <span style="min-width: 25px; font-weight: 500; font-size: 14px; text-align: left; color: #4b5563;">
                            <script>document.write(document.querySelectorAll('#tugas_list > div').length || 1);</script>.
                        </span>
                
                        <input required type="text" name="tugas[]" class="flex-1 border rounded-lg px-3 py-2" placeholder=" ..." required>
                        <button type="button" onclick="removeTugas(this)" class="ml-2 text-red-500 hover:text-red-700">✕</button>
                    </div>
                </div>
        
                <button type="button" onclick="addTugas()" class="mt-2 text-primary hover:text-primary-dark text-sm" style="padding-left: 25px;">
                    + Tambah Tugas
                </button>
            </div>
            
            <!-- Spesifikasi Calon -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-3">Spesifikasi Calon *</label>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Pendidikan Minimal</label>
                        <select id="kriteria_pendidikan" name="kriteria_pendidikan" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="">Pilih Pendidikan</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA/SMK">SMA/SMK</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Jurusan</label>
                        <input required type="text" name="kriteria_jurusan" class="w-full border rounded-lg px-3 py-2" >
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Pengalaman Kerja Minimal</label>
                        <select required name="kriteria_pengalaman" class="w-full border rounded-lg px-3 py-2">
                            <option value="">Pilih</option>
                            <option value="0">Fresh Graduate</option>
                            <option value="1">1 Tahun</option>
                            <option value="2">2 Tahun</option>
                            <option value="3">3 Tahun</option>
                            <option value="5">5 Tahun</option>
                            <option value="10">10+ Tahun</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">IPK Minimal</label>
                        <select id="kriteria_ipk" name="kriteria_ipk" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary">
                            <option value="">Bukan D3-S2</option>
                            <option value="2.00">2.00</option>
                            <option value="2.10">2.10</option>
                            <option value="2.20">2.20</option>
                            <option value="2.30">2.30</option>
                            <option value="2.40">2.40</option>
                            <option value="2.50">2.50</option>
                            <option value="2.60">2.60</option>
                            <option value="2.70">2.70</option>
                            <option value="2.80">2.80</option>
                            <option value="2.90">2.90</option>
                            <option value="3.00">3.00</option>
                            <option value="3.10">3.10</option>
                            <option value="3.20">3.20</option>
                            <option value="3.30">3.30</option>
                            <option value="3.40">3.40</option>
                            <option value="3.50">3.50</option>
                            <option value="3.60">3.60</option>
                            <option value="3.70">3.70</option>
                            <option value="3.80">3.80</option>
                            <option value="3.90">3.90</option>
                            <option value="4.00">4.00</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Keahlian yang Dibutuhkan</label>
                    <textarea  required name="kriteria_keahlian" rows="3" class="w-full border rounded-lg px-3 py-2" ></textarea>
                </div>
            </div>
            
            <!-- Persyaratan Lainnya -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Persyaratan Lainnya</label>
                <div id="persyaratan_list">
                    <div class="flex mb-2">
                        <input required type="text" name="persyaratan[]" class="flex-1 border rounded-lg px-3 py-2" >
                        <button type="button" onclick="removePersyaratan(this)" class="ml-2 text-red-500 hover:text-red-700">✕</button>
                    </div>
                </div>
                <button type="button" onclick="addPersyaratan()" class="mt-2 text-primary hover:text-primary-dark text-sm">
                    + Tambah Persyaratan
                </button>
            </div>
            
            <!-- Deskripsi Pekerjaan -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Pekerjaan</label>
                <textarea required name="deskripsi_pekerjaan" rows="4" class="w-full border rounded-lg px-3 py-2" placeholder="Jelaskan secara detail tentang pekerjaan ini..."></textarea>
            </div>
            
            <!-- Submit Button - Ubah jadi type button untuk trigger modal -->
            <div class="flex justify-end space-x-3 pt-4 border-t">
                <a href="{{ route('divisi.pengajuan.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</a>
                <button type="button" onclick="openConfirmModal()" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                    Ajukan Permintaan
                </button>
            </div>
        </form>
    </div>

    <!-- MODAL KONFIRMASI -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 mb-4">
                    <i class="fas fa-exclamation-triangle text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Konfirmasi Data</h3>
                <p class="text-sm text-gray-600 mb-4">Apakah data yang Anda isi sudah sesuai dengan kebutuhan?</p>
                
                <div class="bg-gray-50 rounded-lg p-4 mb-4 text-left">
                    <p class="text-xs text-gray-500 mb-2">Pastikan:</p>
                    <ul class="text-sm space-y-1 text-gray-700">
                        <li>✓ Identitas pemohon sudah benar</li>
                        <li>✓ Data PTK sudah sesuai</li>
                        <li>✓ Dokumen pendukung sudah diupload</li>
                    </ul>
                </div>
                
                <label class="flex items-center justify-center mb-4 cursor-pointer">
                    <input type="checkbox" id="confirmCheck" class="mr-2">
                    <span class="text-sm text-gray-700">Saya menyatakan data ini sudah benar dan sesuai</span>
                </label>
                
                <div class="flex gap-3">
                    <button onclick="closeConfirmModal()" class="flex-1 border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button onclick="submitForm()" id="submitConfirmBtn" class="flex-1 bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark opacity-50 cursor-not-allowed" disabled>
                        <i class="fas fa-paper-plane mr-2"></i> Kirim
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Show/hide fields berdasarkan jenis dan atur required serta disabled secara dinamis
        document.querySelectorAll('input[name="jenis"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const penggantianField = document.getElementById('penggantian_field');
                const penambahanField = document.getElementById('penambahan_field');
    
                const filePenggantian = document.getElementById('file_penggantian');
                const inputMenggantikan = document.getElementById('input_menggantikan');
                const filePenambahan = document.getElementById('file_penambahan');
    
                if (this.value === 'penggantian') {
                    // Tampilkan penggantian, sembunyikan penambahan
                    penggantianField.style.display = 'grid';
                    penambahanField.style.display = 'none';
        
                    // Aktifkan required & pastikan input aktif (tidak disabled)
                    filePenggantian.setAttribute('required', 'required');
                    filePenggantian.removeAttribute('disabled');
                    inputMenggantikan.setAttribute('required', 'required');
                    inputMenggantikan.removeAttribute('disabled');
        
                    // Matikan required & nonaktifkan input penambahan agar diabaikan browser
                    filePenambahan.removeAttribute('required');
                    filePenambahan.setAttribute('disabled', 'disabled');
                    filePenambahan.value = ''; 
                } else if (this.value === 'penambahan') {
                    // Tampilkan penambahan, sembunyikan penggantian
                    penggantianField.style.display = 'none';
                    penambahanField.style.display = 'block';
        
                    // Aktifkan required & pastikan input aktif
                    filePenambahan.setAttribute('required', 'required');
                    filePenambahan.removeAttribute('disabled');
        
                    // Matikan required & nonaktifkan input penggantian agar diabaikan browser
                    filePenggantian.removeAttribute('required');
                    filePenggantian.setAttribute('disabled', 'disabled');
                    inputMenggantikan.removeAttribute('required');
                    inputMenggantikan.setAttribute('disabled', 'disabled');
                    filePenggantian.value = '';
                    inputMenggantikan.value = '';
                }
            });
        });

        // Add Tugas
        function addTugas() {
            const list = document.getElementById('tugas_list');
            const currentCount = list.children.length + 1;

            const newRow = document.createElement('div');
            newRow.className = 'flex items-center mb-2';
        
            newRow.innerHTML = `
                <span style="min-width: 25px; font-weight: 500; font-size: 14px; text-align: left; color: #4b5563;">${currentCount}.</span>
                <input required type="text" name="tugas[]" class="flex-1 border rounded-lg px-3 py-2" placeholder="..." required>
                <button type="button" onclick="removeTugas(this)" class="ml-2 text-red-500 hover:text-red-700">✕</button>
            `;
        
            list.appendChild(newRow);
        }

        function removeTugas(button) {
            const row = button.parentElement;
            const list = document.getElementById('tugas_list');
            row.remove();
        
            // Urutkan ulang angka setelah ada yang dihapus agar tidak lompat
            Array.from(list.children).forEach((child, index) => {
                child.querySelector('span').innerText = `${index + 1}.`;
            });
        }
        
        function addPersyaratan() {
            const container = document.getElementById('persyaratan_list');
            const div = document.createElement('div');
            div.className = 'flex mb-2';
            div.innerHTML = `
                <input type="text" name="persyaratan[]" class="flex-1 border rounded-lg px-3 py-2" placeholder="Persyaratan tambahan...">
                <button type="button" onclick="removePersyaratan(this)" class="ml-2 text-red-500 hover:text-red-700">✕</button>
            `;
            container.appendChild(div);
        }
        
        function removePersyaratan(btn) {
            const container = document.getElementById('persyaratan_list');
            if (container.children.length > 1) {
                btn.parentElement.remove();
            }
        }

        // Modal functions
        // Ubah fungsi openConfirmModal yang lama menjadi seperti ini
        function openConfirmModal() {
            const form = document.getElementById('ptkForm');
            
            // Cek apakah semua input valid & field required sudah terisi
            if (!form.checkValidity()) {
                // Jika tidak valid, munculkan pesan error bawaan browser pada field yang kosong
                form.reportValidity();
                return; // Hentikan proses, modal tidak akan terbuka
            }

            // Jika semua sudah aman, baru buka modal konfirmasi
            document.getElementById('confirmModal').classList.remove('hidden');
            document.getElementById('confirmModal').classList.add('flex');
            document.getElementById('confirmCheck').checked = false;
            document.getElementById('submitConfirmBtn').disabled = true;
            document.getElementById('submitConfirmBtn').classList.add('opacity-50', 'cursor-not-allowed');
            document.getElementById('submitConfirmBtn').classList.remove('opacity-100', 'cursor-pointer');
        }
        
        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
            document.getElementById('confirmModal').classList.remove('flex');
        }
        
        // Enable submit button when checkbox checked
        document.getElementById('confirmCheck').addEventListener('change', function() {
            const submitBtn = document.getElementById('submitConfirmBtn');
            if (this.checked) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                submitBtn.classList.add('opacity-100', 'cursor-pointer');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                submitBtn.classList.remove('opacity-100', 'cursor-pointer');
            }
        });
        
        function submitForm() {
            document.getElementById('ptkForm').submit();
        }

        // ============================================
        // TOGGLE TOKO PENEMPATAN (SPG / SPB)
        // ============================================
        const posisiInput = document.getElementById('posisi');
        const tokoField = document.getElementById('toko_penempatan_field');
        const tokoInput = document.getElementById('toko_penempatan');

        function toggleTokoPenempatan() {
            const posisi = posisiInput.value.toUpperCase().trim();
            const isSpgOrSpb = posisi.startsWith('SPG') || posisi.startsWith('SPB');
        
            if (isSpgOrSpb) {
                tokoField.style.display = 'block';
                tokoInput.setAttribute('required', 'required');
            } else {
                tokoField.style.display = 'none';
                tokoInput.removeAttribute('required');
                tokoInput.value = '';
            }
        }

        // Event listener saat user mengetik
        posisiInput.addEventListener('input', toggleTokoPenempatan);

        // Jalankan saat load untuk cek kondisi awal
        setTimeout(toggleTokoPenempatan, 100);

        // ============================================
        // IPK WAJIB JIKA PENDIDIKAN D3 - S2
        // ============================================
        const pendidikanSelect = document.getElementById('kriteria_pendidikan');
        const ipkSelect = document.getElementById('kriteria_ipk');

        function toggleIPK() {
            const pendidikan = pendidikanSelect.value;

            if (['D3', 'S1', 'S2'].includes(pendidikan)) {
                ipkSelect.required = true;
                ipkSelect.disabled = false;

                // ubah placeholder
                ipkSelect.options[0].text = '-- Pilih IPK Minimal --';
            } else {
                ipkSelect.required = false;
                ipkSelect.value = '';
                ipkSelect.disabled = true;

                // ubah placeholder
                ipkSelect.options[0].text = 'Bukan D3-S2';
            }
        }

        pendidikanSelect.addEventListener('change', toggleIPK);

        // Jalankan saat halaman pertama kali dibuka
        toggleIPK();
    </script>
    @endpush
    @endsection