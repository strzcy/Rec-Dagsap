@extends('layouts.nav-fe')

@section('title', 'Form Isian Data Diri - Dagsap Recruitment')

@php
    $stepWithErrors = 1;
    if ($errors->any()) {
        $step4Fields = [
            'nama_ayah', 'agama_ayah', 'usia_ayah', 'pekerjaan_ayah', 'alamat_ayah',
            'nama_ibu', 'agama_ibu', 'usia_ibu', 'pekerjaan_ibu', 'alamat_ibu',
            'gaji_diharapkan', 'waktu_bergabung', 'kekuatan', 'kelemahan', 'pernyataan_setuju'
        ];
        foreach ($step4Fields as $field) {
            if ($errors->has($field)) {
                $stepWithErrors = 4;
                break;
            }
        }
    }
@endphp

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
        <div class="bg-primary text-white p-4 py-6">
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
            
            @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg p-4 mb-6">
                <h4 class="font-semibold mb-2"><i class="fas fa-exclamation-triangle mr-2"></i> Harap Perhatikan Sesuai Dengan dibawah ini :</h4>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div class="step text-center flex-1" data-step="1">
                        <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center mx-auto mb-2 step-pending" id="step1-circle">1</div>
                        <span class="text-sm step-pending-text" id="step1-text">A. Data Pribadi</span>
                    </div>
                    <div class="step text-center flex-1" data-step="2">
                        <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center mx-auto mb-2 step-pending" id="step2-circle">2</div>
                        <span class="text-sm step-pending-text" id="step2-text">B. Pendidikan</span>
                    </div>
                    <div class="step text-center flex-1" data-step="3">
                        <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center mx-auto mb-2 step-pending" id="step3-circle">3</div>
                        <span class="text-sm step-pending-text" id="step3-text">C. Keterampilan</span>
                    </div>
                    <div class="step text-center flex-1" data-step="4">
                        <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center mx-auto mb-2 step-pending" id="step4-circle">4</div>
                        <span class="text-sm step-pending-text" id="step4-text">D. Bahasa & Lainnya</span>
                    </div>
                </div>
            </div>
            
            <form action="{{ URL::signedRoute('frontend.apply.store_detail', $pelamar) }}" method="POST" id="multiStepForm" novalidate>
                @csrf
                
                <!-- Section A: Data Pribadi -->
                <div class="form-section active" id="section-A">
                    @include('frontend.apply.sections.section_a', ['pelamar' => $pelamar])
                </div>
                
                <!-- Section B: Pendidikan -->
                <div class="form-section" id="section-B">
                    @include('frontend.apply.sections.section_b')
                </div>
                
                <!-- Section C: Keterampilan -->
                <div class="form-section" id="section-C">
                    @include('frontend.apply.sections.section_c')
                </div>
                
                <!-- Section D: Bahasa, Kekuatan, Kelemahan, Pekerjaan, DLL sampai L -->
                <div class="form-section" id="section-D">
                    @include('frontend.apply.sections.section_d')
                </div>
                
                <!-- Navigation Buttons -->
                <div class="flex justify-between pt-4 border-t mt-6">
                    <button type="button" id="prevBtn" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 hidden">
                        <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                    </button>
                    <button type="button" id="nextBtn" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark ml-auto">
                        Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                    <button type="submit" id="submitBtn" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 hidden">
                        <i class="fas fa-save mr-2"></i> Simpan & Selesai
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentStep = {{ $stepWithErrors }};
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
    
    // VALIDASI LENGKAP (HANYA SATU)
    function validateCurrentStep() {
        const currentSection = document.getElementById(`section-${String.fromCharCode(64 + currentStep)}`);
        const requiredFields = currentSection.querySelectorAll('[required]');
        let isValid = true;
        let errorMessage = 'Harap isi semua field yang wajib diisi (ditandai *)';
    
        requiredFields.forEach(field => {
            let fieldValid = true;
            if (field.type === 'checkbox') {
                if (!field.checked) {
                    fieldValid = false;
                }
            } else if (field.type === 'radio') {
                const name = field.getAttribute('name');
                const checkedRadio = currentSection.querySelector(`input[name="${name}"]:checked`);
                if (!checkedRadio) {
                    fieldValid = false;
                }
            } else {
                if (!field.value.trim()) {
                    fieldValid = false;
                }
            }

            if (!fieldValid) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });

        // Validasi khusus minlength
        if (isValid) {
            const minLengthFields = currentSection.querySelectorAll('[minlength]');
            minLengthFields.forEach(field => {
                const minLen = parseInt(field.getAttribute('minlength'));
                if (field.value.trim().length < minLen) {
                    field.classList.add('border-red-500');
                    isValid = false;
                    errorMessage = `Kekuatan dan Kelemahan masing-masing minimal harus diisi ${minLen} karakter!`;
                } else {
                    field.classList.remove('border-red-500');
                }
            });
        }
    
        // Validasi khusus per section
        if (currentStep === 3 && isValid) {
            const skillNames = document.querySelectorAll('input[name="keterampilan_nama[]"]');
            let filledSkills = 0;
            skillNames.forEach(skill => {
                if (skill.value.trim()) filledSkills++;
            });
            if (filledSkills < 3) {
                isValid = false;
                errorMessage = 'Minimal 3 keterampilan harus diisi!';
            }
        }
    
        if (currentStep === 4 && isValid) {
            const bahasaNames = document.querySelectorAll('input[name="bahasa_nama[]"]');
            const bahasaMembaca = document.querySelectorAll('select[name="bahasa_membaca[]"]');
            const bahasaBerbicara = document.querySelectorAll('select[name="bahasa_berbicara[]"]');
            const bahasaMenulis = document.querySelectorAll('select[name="bahasa_menulis[]"]');
            for (let i = 0; i < bahasaNames.length; i++) {
                if (bahasaNames[i] && bahasaNames[i].value.trim()) {
                    const membaca = bahasaMembaca[i]?.value;
                    const berbicara = bahasaBerbicara[i]?.value;
                    const menulis = bahasaMenulis[i]?.value;
                    if (!membaca || !berbicara || !menulis) {
                        isValid = false;
                        errorMessage = 'Untuk setiap bahasa asing, wajib memilih level Membaca, Berbicara, dan Menulis!';
                        break;
                    }
                }
            }
        }
    
        if (!isValid) {
            alert(errorMessage);
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

    // Form submit validation handler
    document.getElementById('multiStepForm').addEventListener('submit', function(e) {
        if (!validateCurrentStep()) {
            e.preventDefault();
        }
    });

    // Toggle functions for family forms
    function togglePasanganForm(show) {
        const form = document.getElementById('pasangan-form');
        if (!form) return;
        form.classList.toggle('hidden', !show);
        form.querySelectorAll('input, select, textarea').forEach(input => {
            if (show) {
                input.setAttribute('required', 'required');
            } else {
                input.removeAttribute('required');
                input.value = '';
            }
        });
    }
    function toggleAnakForm(show) {
        const form = document.getElementById('anak-form');
        if (!form) return;
        form.classList.toggle('hidden', !show);
        form.querySelectorAll('input, select, textarea').forEach(input => {
            if (show) {
                input.setAttribute('required', 'required');
            } else {
                input.removeAttribute('required');
                input.value = '';
            }
        });
    }
    function togglePenyakitKeluargaForm(show) {
        const form = document.getElementById('penyakit-keluarga-form');
        if (!form) return;
        form.classList.toggle('hidden', !show);
        form.querySelectorAll('input, select, textarea').forEach(input => {
            if (show) {
                input.setAttribute('required', 'required');
            } else {
                input.removeAttribute('required');
                input.value = '';
            }
        });
    }
    function toggleSaudaraForm(show) {
        const form = document.getElementById('saudara-form');
        if (!form) return;
        form.classList.toggle('hidden', !show);
        form.querySelectorAll('input, select, textarea').forEach(input => {
            if (show) {
                input.setAttribute('required', 'required');
            } else {
                input.removeAttribute('required');
                input.value = '';
            }
        });
    }
    function toggleSakitBerat(show) {
        const form = document.getElementById('sakit-berat-detail');
        if (!form) return;
        form.classList.toggle('hidden', !show);
        form.querySelectorAll('input, select, textarea').forEach(input => {
            if (show) {
                input.setAttribute('required', 'required');
            } else {
                input.removeAttribute('required');
                input.value = '';
            }
        });
    }
    function togglePenyakitKeturunan(show) {
        const form = document.getElementById('penyakit-keturunan-detail');
        if (!form) return;
        form.classList.toggle('hidden', !show);
        form.querySelectorAll('input, select, textarea').forEach(input => {
            if (show) {
                input.setAttribute('required', 'required');
            } else {
                input.removeAttribute('required');
                input.value = '';
            }
        });
    }
    function toggleKacamata(show) {
        const form = document.getElementById('kacamata-detail');
        if (!form) return;
        form.classList.toggle('hidden', !show);
        form.querySelectorAll('input, select, textarea').forEach(input => {
            if (show) {
                input.setAttribute('required', 'required');
            } else {
                input.removeAttribute('required');
                input.value = '';
            }
        });
    }
    function toggleAlergi(show) {
        const form = document.getElementById('alergi-detail');
        if (!form) return;
        form.classList.toggle('hidden', !show);
        form.querySelectorAll('input, select, textarea').forEach(input => {
            if (show) {
                input.setAttribute('required', 'required');
            } else {
                input.removeAttribute('required');
                input.value = '';
            }
        });
    }

    // Setup dynamic add
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