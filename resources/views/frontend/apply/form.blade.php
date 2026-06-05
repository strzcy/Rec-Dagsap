@extends('layouts.nav-fe')

@section('title', 'Lamar Pekerjaan - ' . $lowongan->judul)

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl mt-16">
    <!-- Header -->
    <div class="bg-white rounded-t-xl shadow-md p-6 mb-6">
        <a href="{{ url('/') }}" class="text-primary hover:underline mb-4 inline-block">
            ← Kembali ke Beranda
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Formulir Lamaran</h1>
        <p class="text-gray-600">{{ $lowongan->judul }} - {{ $lowongan->pengajuan->divisi->nama_divisi ?? '-' }}</p>
    </div>
    
    <!-- Form -->
    <div class="bg-white rounded-b-xl shadow-md p-6">
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
@endsection