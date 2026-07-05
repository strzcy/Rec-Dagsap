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

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <h4 class="font-semibold mb-2"><i class="fas fa-exclamation-triangle mr-2"></i> Harap Perhatikan Sesuai Dengan Di bawah Ini:</h4>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">IPK (jika S1/D3) <span class="text-red-500" id="ipk-required">*</span></label>
                        <select name="ipk" id="ipk-select" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-primary">
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
        // Toggle required IPK berdasarkan pendidikan
        const pendidikanSelect = document.querySelector('select[name="pendidikan_terakhir"]');
        const ipkSelect = document.getElementById('ipk-select');
        const ipkRequired = document.getElementById('ipk-required');
    
        function toggleIpkRequired() {
            const pendidikan = pendidikanSelect.value;
            const isDiatasD3 = ['D3', 'S1', 'S2'].includes(pendidikan);
        
            if (isDiatasD3) {
                ipkSelect.setAttribute('required', 'required');
                if (ipkRequired) ipkRequired.style.display = 'inline';
                const helper = ipkSelect.closest('div').querySelector('.text-xs.text-gray-500');
                if (helper) helper.textContent = 'Wajib diisi untuk D3/S1/S2';
            } else {
                ipkSelect.removeAttribute('required');
                if (ipkRequired) ipkRequired.style.display = 'none';
                const helper = ipkSelect.closest('div').querySelector('.text-xs.text-gray-500');
                if (helper) helper.textContent = 'Opsional untuk pendidikan di bawah D3';
            }
        }
    
        pendidikanSelect.addEventListener('change', toggleIpkRequired);
        toggleIpkRequired(); // Jalankan saat pertama kali load
</script>
@endpush

@endsection
