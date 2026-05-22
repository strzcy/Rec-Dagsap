<aside class="w-64 bg-white shadow-lg min-h-screen">
    <div class="py-4">
        <!-- Menu berdasarkan role -->
        @if(auth()->user()->isDivisi())
            <!-- Menu untuk DIVISI -->
            <div class="px-4 mb-4">
                <div class="bg-primary-light rounded-lg p-3 text-center">
                    <p class="text-primary text-sm font-semibold">Divisi</p>
                    <p class="text-gray-600 text-xs">{{ auth()->user()->divisi->nama_divisi ?? '-' }}</p>
                </div>
            </div>
            
            <nav class="mt-4">
                <a href="{{ route('divisi.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="mx-3">Dashboard</span>
                </a>
                <a href="{{ route('divisi.pengajuan.create') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition">
                    <i class="fas fa-plus-circle w-5"></i>
                    <span class="mx-3">Ajukan Tenaga Kerja</span>
                </a>
                <a href="{{ route('divisi.pengajuan.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition">
                    <i class="fas fa-list w-5"></i>
                    <span class="mx-3">Riwayat Pengajuan</span>
                </a>
            </nav>
            
        @elseif(auth()->user()->isManagement())
            <!-- Menu untuk MANAGEMENT -->
            <div class="px-4 mb-4">
                <div class="bg-primary-light rounded-lg p-3 text-center">
                    <p class="text-primary text-sm font-semibold">{{ auth()->user()->username }}</p>
                    <p class="text-gray-600 text-xs">
                        Mengelola: {{ auth()->user()->managedDivisi->nama_divisi ?? 'Tidak ada divisi' }}
                    </p>
                </div>
            </div>
        
            <nav class="mt-4">
                <a href="{{ route('management.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="mx-3">Dashboard</span>
                </a>
                <a href="{{ route('management.pengajuan.index') }}?status=pending" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition">
                    <i class="fas fa-clock w-5"></i>
                    <span class="mx-3">Pending Approval</span>
                    @php
                        $pendingCount = \App\Models\PengajuanTenagaKerja::where('divisi_id', auth()->user()->managed_divisi_id)
                            ->where('status', 'pending')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ $pendingCount }}</span>
                    @endif
                </a>
                <a href="{{ route('management.pengajuan.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition">
                    <i class="fas fa-history w-5"></i>
                    <span class="mx-3">Semua Pengajuan</span>
                </a>
            </nav>
            
        @elseif(auth()->user()->isHrd())
            <!-- Menu untuk HRD -->
            <div class="px-4 mb-4">
                <div class="bg-primary-light rounded-lg p-3 text-center">
                    <p class="text-primary text-sm font-semibold">HRD</p>
                    <p class="text-gray-600 text-xs">Human Capital</p>
                </div>
            </div>
            
            <nav class="mt-4">
                <a href="{{ route('hrd.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="mx-3">Dashboard</span>
                </a>
                <a href="{{ route('hrd.lowongan.create') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition">
                    <i class="fas fa-plus-circle w-5"></i>
                    <span class="mx-3">Buat Lowongan</span>
                </a>
                <a href="{{ route('hrd.lowongan.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition">
                    <i class="fas fa-briefcase w-5"></i>
                    <span class="mx-3">Kelola Lowongan</span>
                </a>
                <a href="{{ route('hrd.pelamar.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition">
                    <i class="fas fa-users w-5"></i>
                    <span class="mx-3">Data Pelamar</span>
                </a>
            </nav>
        @endif
    </div>
</aside>