@extends('layouts.frontend')

@section('title', 'Form Isian Data Diri - Dagsap Recruitment')

@push('styles')
<style>
    .step {
        transition: all 0.3s ease;
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
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-primary text-white p-4">
            <h1 class="text-2xl font-bold">Form Isian Data Diri Pelamar</h1>
            <p class="text-sm opacity-90">PT Dagsap Endura Eatore</p>
        </div>
        
        <div class="p-6">
            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div class="step text-center flex-1" id="step1-indicator">
                        <div class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center mx-auto mb-2 step-pending" id="step1-circle">1</div>
                        <span class="text-sm step-pending-text">A. Data Pribadi</span>
                    </div>
                    <div class="step text-center flex-1" id="step2-indicator">
                        <div class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center mx-auto mb-2 step-pending" id="step2-circle">2</div>
                        <span class="text-sm step-pending-text">B. Pendidikan</span>
                    </div>
                    <div class="step text-center flex-1" id="step3-indicator">
                        <div class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center mx-auto mb-2 step-pending" id="step3-circle">3</div>
                        <span class="text-sm step-pending-text">C. Keterampilan</span>
                    </div>
                    <div class="step text-center flex-1" id="step4-indicator">
                        <div class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center mx-auto mb-2 step-pending" id="step4-circle">4</div>
                        <span class="text-sm step-pending-text">D. Bahasa & Lainnya</span>
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
                
                <!-- Section D: Bahasa, Kekuatan, Kelemahan, Pekerjaan, DLL -->
                <div class="form-section" id="section-D">
                    @include('frontend.apply.sections.section_d')
                </div>
                
                <!-- Navigation Buttons -->
                <div class="flex justify-between pt-4 border-t mt-6">
                    <button type="button" id="prevBtn" class="px-6 py-2 border rounded-lg hover:bg-gray-50 hidden">← Sebelumnya</button>
                    <button type="button" id="nextBtn" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark ml-auto">Selanjutnya →</button>
                    <button type="submit" id="submitBtn" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 hidden">Simpan & Selesai</button>
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
        // Update circles
        for (let i = 1; i <= totalSteps; i++) {
            const circle = document.getElementById(`step${i}-circle`);
            const indicator = document.getElementById(`step${i}-indicator`);
            const text = indicator.querySelector('span');
            
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
        
        // Show/hide sections
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
        
        // Update buttons
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
    
    // Validasi angka tidak boleh minus
    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', function() {
            if (this.value < 0) {
                this.value = 0;
            }
        });
    });
    
    updateSteps();
</script>
@endpush
@endsection