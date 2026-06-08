@extends('layouts.nav-fe')

@section('title', 'Lamar Pekerjaan - ' . $lowongan->judul)

@section('content')
@push('styles')
<style>
    .step {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .step-active {
        background-color: #424862;
        color: white;
        border-color: #424862;
    }
    .step-completed {
        background-color: #10b981;
        color: white;
        border-color: #10b981;
    }
    .step-pending {
        background-color: #e5e7eb;
        color: #6b7280;
        border-color: #d1d5db;
    }
    .form-section {
        display: none;
    }
    .form-section.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: #424862;
        ring: 2px solid #424862;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl mt-16">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-primary text-white p-4">
            <a href="{{ url('/') }}" class="text-white hover:underline mb-4 inline-block">
                ← Kembali ke Beranda
            </a>
            <h1 class="text-2xl font-bold">Formulir Lamaran </h1>
            <p class="text-white-600">{{ $lowongan->judul }} - {{ $lowongan->pengajuan->divisi->nama_divisi ?? '-' }}</p>
        </div>
        
        <div class="p-6">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
        
            <form action="{{ route('frontend.apply.store', $lowongan) }}" method="POST" enctype="multipart/form-data">
                @csrf
            
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Identitas Diri -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-primary mb-4 pb-2 border-b">Identitas Diri</h3>
                    </div>
                
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                        <input type="text" name="nama_lengkap" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" required>
                    </div>
                
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                        <input type="email" name="email" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" required>
                    </div>
                
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No Telepon/WA *</label>
                        <input type="tel" name="no_telepon" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" placeholder="628xxxxxxxxxx" required>
                    </div>
                
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir *</label>
                        <input type="text" name="tempat_lahir" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" required>
                    </div>
                
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir *</label>
                        <input type="date" name="tanggal_lahir" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" required>
                    </div>
                
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap *</label>
                        <textarea name="alamat" rows="2" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" required></textarea>
                    </div>
                
                    <!-- Pendidikan -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-primary mb-4 pb-2 border-b">Pendidikan</h3>
                    </div>
                
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir *</label>
                        <select name="pendidikan_terakhir" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="">Pilih</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA/SMK">SMA/SMK</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                        </select>
                    </div>
                
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan *</label>
                        <input type="text" name="jurusan" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" required>
                    </div>
                
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Lulus *</label>
                        <input type="number" name="tahun_lulus" min="1990" max="{{ date('Y') }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" required>
                    </div>
                
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">IPK (jika S1/D3)</label>
                        <input type="text" name="ipk" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" placeholder="Contoh: 3.50">
                    </div>
                
                    <!-- Pengalaman Kerja -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-primary mb-4 pb-2 border-b">Pengalaman Kerja</h3>
                    </div>
                
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pengalaman Kerja</label>
                        <textarea name="pengalaman_kerja" rows="4" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary" placeholder="Tuliskan pengalaman kerja Anda (posisi, perusahaan, tahun, dan tanggung jawab)..."></textarea>
                    </div>
                
                    <!-- Upload Dokumen -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-primary mb-4 pb-2 border-b">Dokumen Pendukung</h3>
                    </div>
                
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">CV / Resume *</label>
                        <input type="file" name="cv" accept=".pdf,.doc,.docx" class="w-full border rounded-lg px-3 py-2" required>
                        <p class="text-xs text-gray-500 mt-1">PDF/DOC/DOCX, maks 5MB</p>
                    </div>
                
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ijazah / Transkrip Nilai *</label>
                        <input type="file" name="ijazah" accept=".pdf,.jpg,.jpeg,.png" class="w-full border rounded-lg px-3 py-2" required>
                        <p class="text-xs text-gray-500 mt-1">PDF/JPG/PNG, maks 5MB</p>
                    </div>
                </div>
            
                <div class="flex justify-end space-x-3 mt-8 pt-4 border-t">
                    <a href="{{ url('/') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                        Kirim Lamaran
                    </button>
                </div>
            </form>
            
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentStep = 1;
    const totalSteps = 4;
    
    function updateSteps() {
        for (let i = 1; i <= totalSteps; i++) {
            const circle = document.getElementById(`step${i}-circle`);
            const text = document.getElementById(`step${i}-text`);
            
            if (i < currentStep) {
                circle.className = 'w-10 h-10 rounded-full border-2 border-green-500 flex items-center justify-center mx-auto mb-2 step-completed';
                circle.innerHTML = '<i class="fas fa-check text-white text-xs"></i>';
                text.className = 'text-sm text-green-600';
            } else if (i === currentStep) {
                circle.className = 'w-10 h-10 rounded-full border-2 border-primary flex items-center justify-center mx-auto mb-2 step-active';
                circle.innerHTML = i;
                text.className = 'text-sm text-primary font-semibold';
            } else {
                circle.className = 'w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center mx-auto mb-2 step-pending';
                circle.innerHTML = i;
                text.className = 'text-sm text-gray-500';
            }
        }
        
        for (let i = 1; i <= totalSteps; i++) {
            const section = document.getElementById(`section-${String.fromCharCode(64 + i)}`);
            if (section) {
                if (i === currentStep) {
                    section.classList.add('active');
                } else {
                    section.classList.remove('active');
                }
            }
        }
        
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        
        if (currentStep === 1) {
            prevBtn.classList.add('hidden');
        } else {
            prevBtn.classList.remove('hidden');
        }
        
        if (currentStep === totalSteps) {
            nextBtn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        } else {
            nextBtn.classList.remove('hidden');
            submitBtn.classList.add('hidden');
        }
    }
    
    function validateCurrentStep() {
        const currentSection = document.getElementById(`section-${String.fromCharCode(64 + currentStep)}`);
        const requiredFields = currentSection.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });
        
        if (!isValid) {
            alert('Harap isi semua field yang wajib diisi (ditandai *)');
        }
        
        return isValid;
    }
    
    document.getElementById('nextBtn').addEventListener('click', function() {
        if (validateCurrentStep()) {
            if (currentStep < totalSteps) {
                currentStep++;
                updateSteps();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    });
    
    document.getElementById('prevBtn').addEventListener('click', function() {
        if (currentStep > 1) {
            currentStep--;
            updateSteps();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
    
    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', function() {
            if (this.value < 0) {
                this.value = 0;
            }
        });
    });
    
    updateSteps();

    // Toggle functions for family forms
    function togglePasanganForm(show) {
        document.getElementById('pasangan-form').classList.toggle('hidden', !show);
    }

    function toggleAnakForm(show) {
        document.getElementById('anak-form').classList.toggle('hidden', !show);
    }

    function toggleSaudaraForm(show) {
        document.getElementById('saudara-form').classList.toggle('hidden', !show);
    }

    function toggleSakitBerat(show) {
        document.getElementById('sakit-berat-detail').classList.toggle('hidden', !show);
    }

    function togglePenyakitKeturunan(show) {
        document.getElementById('penyakit-keturunan-detail').classList.toggle('hidden', !show);
    }

    function toggleKacamata(show) {
        document.getElementById('kacamata-detail').classList.toggle('hidden', !show);
    }

    function toggleAlergi(show) {
        document.getElementById('alergi-detail').classList.toggle('hidden', !show);
    }

    // Setup dynamic add for all dynamic containers
    function setupDynamicAdd(btnId, containerId, itemClass, removeBtnClass) {
        document.getElementById(btnId)?.addEventListener('click', function() {
            const container = document.getElementById(containerId);
            const template = container.children[0].cloneNode(true);
            template.querySelectorAll('input, select, textarea').forEach(input => {
                if (input.type !== 'radio' && input.type !== 'checkbox') {
                    input.value = '';
                }
                if (input.type === 'checkbox' || input.type === 'radio') {
                    input.checked = false;
                }
            });
            container.appendChild(template);
            template.querySelector(removeBtnClass)?.addEventListener('click', () => template.remove());
        });
    }

    setupDynamicAdd('tambah-pekerjaan', 'pekerjaan-container', '.pekerjaan-item', '.remove-pekerjaan');
    setupDynamicAdd('tambah-referensi', 'referensi-container', '.referensi-item', '.remove-referensi');
    setupDynamicAdd('tambah-saudara', 'saudara-container', '.saudara-item', '.remove-saudara');
    setupDynamicAdd('tambah-anak', 'anak-container', '.anak-item', '.remove-anak');
    setupDynamicAdd('tambah-penyakit', 'penyakit-keluarga-container', '.penyakit-item', '.remove-penyakit');
    setupDynamicAdd('tambah-saudara-kandung', 'saudara-kandung-container', '.saudara-kandung-item', '.remove-saudara-kandung');

    // Remove handlers for existing items
    document.querySelectorAll('.remove-pekerjaan, .remove-referensi, .remove-saudara, .remove-anak, .remove-penyakit, .remove-saudara-kandung').forEach(btn => {
        btn.addEventListener('click', function() {
            const container = this.closest('[id$="-container"]');
            if (container && container.children.length > 1) {
                this.closest('.pekerjaan-item, .referensi-item, .saudara-item, .anak-item, .penyakit-item, .saudara-kandung-item')?.remove();
            }
        });
    });
</script>
@endpush

@endsection


