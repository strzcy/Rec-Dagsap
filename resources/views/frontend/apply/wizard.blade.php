@extends('layouts.nav-fe')

@section('title', 'Form Isian Data Diri - Dagsap Recruitment')

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
            
            <form action="{{ route('frontend.apply.store_detail', $pelamar) }}" method="POST" id="multiStepForm">
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