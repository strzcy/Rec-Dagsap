<aside class="w-64 bg-white shadow-lg h-full ">
    <div class="py-4">
        <!-- Menu berdasarkan role -->
        @if(auth()->user()->isDivisi())
            <!-- Menu untuk DIVISI -->
            <div class="px-4 mb-4">
                <div class="bg-primary-light rounded-lg p-3 text-center">
                    <p class="text-primary text-sm font-semibold">{{ auth()->user()->username }}</p>
                    <p class="text-gray-600 text-xs">{{ auth()->user()->divisi->nama_divisi ?? '-' }}</p>
                </div>
            </div>
            
            <nav class="mt-4">
                <a href="{{ route('divisi.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition {{ request()->routeIs('divisi.dashboard') ? 'bg-primary-light text-primary' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="mx-3">Dashboard</span>
                </a>
                <a href="{{ route('divisi.pengajuan.create') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition {{ request()->routeIs('divisi.pengajuan.create') ? 'bg-primary-light text-primary' : '' }}">
                    <i class="fas fa-plus-circle w-5"></i>
                    <span class="mx-3">Ajukan Tenaga Kerja</span>
                </a>
                <a href="{{ route('divisi.pengajuan.verify') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition">
                    <i class="fas fa-list w-5"></i>
                    <span class="mx-3">Riwayat Pengajuan</span>
                </a>
            </nav>
            
        @elseif(auth()->user()->isManagement())
            <!-- Menu untuk MANAGEMENT -->
            <div class="px-4 mb-4">
                <div class="bg-primary-light rounded-lg p-3 text-center">
                    <p class="text-primary text-sm font-semibold">{{ auth()->user()->username }}</p>
                    <p class="text-gray-600 text-xs">Mengelola: {{ auth()->user()->managedDivisi->nama_divisi ?? '-' }}</p>
                </div>
            </div>
            
            <nav class="mt-4">
                <a href="{{ route('management.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition {{ request()->routeIs('management.dashboard') ? 'bg-primary-light text-primary' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="mx-3">Dashboard</span>
                </a>
                <a href="{{ route('management.pengajuan.index') }}?status=pending" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition {{ request()->query('status') == 'pending' ? 'bg-primary-light text-primary' : '' }}">
                    <i class="fas fa-clock w-5"></i>
                    <span class="mx-3">Pending Approval</span>
                </a>
                <a href="{{ route('management.pengajuan.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition {{ request()->routeIs('management.pengajuan.index') && !request()->query('status') ? 'bg-primary-light text-primary' : '' }}">
                    <i class="fas fa-history w-5"></i>
                    <span class="mx-3">Semua Pengajuan</span>
                </a>
            </nav>
            
        @elseif(auth()->user()->isHrd())
            <!-- Menu untuk HRD -->
            <div class="px-4 mb-4">
                <div class="bg-primary-light rounded-lg p-3 text-center">
                    <p class="text-primary text-sm font-semibold">{{ auth()->user()->username }}</p>
                    <p class="text-gray-600 text-xs">HRD • Human Capital</p>
                </div>
            </div>
            
            <nav class="mt-4">
                <a href="{{ route('hrd.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition {{ request()->routeIs('hrd.dashboard') ? 'bg-primary-light text-primary' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="mx-3">Dashboard</span>
                </a>
                <a href="{{ route('hrd.lowongan.create') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition {{ request()->routeIs('hrd.lowongan.create') ? 'bg-primary-light text-primary' : '' }}">
                    <i class="fas fa-plus-circle w-5"></i>
                    <span class="mx-3">Buat Lowongan</span>
                </a>
                <a href="{{ route('hrd.lowongan.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition {{ request()->routeIs('hrd.lowongan.index') ? 'bg-primary-light text-primary' : '' }}">
                    <i class="fas fa-briefcase w-5"></i>
                    <span class="mx-3">Kelola Lowongan</span>
                </a>
                <a href="{{ route('hrd.pelamar.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-primary-light hover:text-primary transition {{ request()->routeIs('hrd.pelamar.index') ? 'bg-primary-light text-primary' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span class="mx-3">Data Pelamar</span>
                </a>
            </nav>
        @endif
    </div>
</aside>