<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lowongan->judul }} - Dagsap Recruitment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f3f4f6; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="bg-primary shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-white text-xl font-bold">Dagsap Recruitment</a>
                <a href="{{ route('admin.login') }}" class="text-white hover:text-gray-200">
                    <i class="fas fa-user-lock mr-1"></i> Admin
                </a>
            </div>
        </div>
    </nav>
    
    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            @if($lowongan->banner_image)
            <img src="{{ Storage::url($lowongan->banner_image) }}" alt="{{ $lowongan->judul }}" class="w-full h-64 object-cover">
            @endif
            
            <div class="p-6">
                <!-- Header -->
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $lowongan->judul }}</h1>
                    <div class="flex flex-wrap items-center text-gray-600 gap-2">
                        <span class="bg-primary-light text-primary px-3 py-1 rounded-full text-sm">
                            <i class="fas fa-building mr-1"></i> {{ $lowongan->pengajuan->divisi->nama_divisi ?? '-' }}
                        </span>
                        <span class="text-gray-400">•</span>
                        <span><i class="far fa-calendar-alt mr-1"></i> Ditutup: {{ \Carbon\Carbon::parse($lowongan->tanggal_selesai)->format('d M Y') }}</span>
                        <span class="text-gray-400">•</span>
                        <span><i class="fas fa-users mr-1"></i> Dibutuhkan: {{ $lowongan->pengajuan->jumlah }} orang</span>
                    </div>
                </div>
                
                <!-- Deskripsi Pekerjaan -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3 border-l-4 border-primary pl-3">Deskripsi Pekerjaan</h2>
                    <div class="text-gray-700 leading-relaxed">
                        {!! nl2br(e($lowongan->deskripsi)) !!}
                    </div>
                </div>
                
                <!-- Tugas dan Tanggung Jawab -->
                @php
                    $tugas = is_array($lowongan->pengajuan->tugas) ? $lowongan->pengajuan->tugas : json_decode($lowongan->pengajuan->tugas, true);
                @endphp
                @if(!empty($tugas))
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3 border-l-4 border-primary pl-3">Tugas dan Tanggung Jawab</h2>
                    <ul class="list-disc list-inside space-y-2 text-gray-700">
                        @foreach($tugas as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <!-- Spesifikasi Calon -->
                @php
                    $kriteria = is_array($lowongan->pengajuan->kriteria) ? $lowongan->pengajuan->kriteria : json_decode($lowongan->pengajuan->kriteria, true);
                @endphp
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3 border-l-4 border-primary pl-3">Kualifikasi yang Dibutuhkan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-graduation-cap text-primary mt-1 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-500">Pendidikan Minimal</p>
                                <p class="font-medium">{{ $kriteria['pendidikan'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-book text-primary mt-1 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-500">Jurusan</p>
                                <p class="font-medium">{{ $kriteria['jurusan'] ?? 'Semua Jurusan' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-briefcase text-primary mt-1 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-500">Pengalaman Kerja</p>
                                <p class="font-medium">{{ $kriteria['pengalaman'] ?? '0' }} tahun</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-chart-line text-primary mt-1 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-500">IPK Minimal</p>
                                <p class="font-medium">{{ $kriteria['ipk'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="md:col-span-2 flex items-start">
                            <i class="fas fa-code text-primary mt-1 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-500">Keahlian yang Dibutuhkan</p>
                                <p class="font-medium">{{ $kriteria['keahlian'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Persyaratan Lainnya -->
                @php
                    $persyaratan = is_array($lowongan->pengajuan->persyaratan) ? $lowongan->pengajuan->persyaratan : json_decode($lowongan->pengajuan->persyaratan, true);
                @endphp
                @if(!empty($persyaratan))
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3 border-l-4 border-primary pl-3">Persyaratan Lainnya</h2>
                    <ul class="list-disc list-inside space-y-1 text-gray-700">
                        @foreach($persyaratan as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <!-- Tombol Lamar -->
                <div class="border-t pt-6">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <p class="text-yellow-800 text-sm">
                            <i class="fas fa-info-circle mr-2"></i>
                            Pastikan Anda memenuhi semua kualifikasi yang dibutuhkan sebelum melamar.
                        </p>
                    </div>
                    
                    <a href="{{ route('frontend.apply', $lowongan) }}" 
                       class="inline-block bg-primary text-white px-8 py-3 rounded-lg hover:bg-primary-dark transition text-center w-full md:w-auto">
                        <i class="fas fa-paper-plane mr-2"></i> Lamar Sekarang →
                    </a>
                </div>
            </div>
        </div>
        
        <div class="mt-6 text-center">
            <a href="{{ url('/') }}" class="text-primary hover:underline">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
    
    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Dagsap Recruitment. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>