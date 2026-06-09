<div class="bg-white border-t border-gray-200">
    <!-- Menu berdasarkan role -->
    @if(auth()->user()->isDivisi())
        <!-- Menu untuk DIVISI -->
        <div class="flex justify-around py-2">
            <a href="{{ route('divisi.dashboard') }}" class="flex flex-col items-center px-3 py-2 rounded-lg transition {{ request()->routeIs('divisi.dashboard') ? 'text-primary' : 'text-gray-500' }}">
                <i class="fas fa-tachometer-alt text-xl"></i>
                <span class="text-xs mt-1">Dashboard</span>
            </a>
            <a href="{{ route('divisi.pengajuan.create') }}" class="flex flex-col items-center px-3 py-2 rounded-lg transition {{ request()->routeIs('divisi.pengajuan.create') ? 'text-primary' : 'text-gray-500' }}">
                <i class="fas fa-plus-circle text-xl"></i>
                <span class="text-xs mt-1">Ajukan</span>
            </a>
            <a href="{{ route('divisi.pengajuan.index') }}" class="flex flex-col items-center px-3 py-2 rounded-lg transition {{ request()->routeIs('divisi.pengajuan.index') ? 'text-primary' : 'text-gray-500' }}">
                <i class="fas fa-list text-xl"></i>
                <span class="text-xs mt-1">Riwayat</span>
            </a>
            <form id="logout-form-bottom" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
        
    @elseif(auth()->user()->isManagement())
        <!-- Menu untuk MANAGEMENT -->
        <div class="flex justify-around py-2">
            <a href="{{ route('management.dashboard') }}" class="flex flex-col items-center px-3 py-2 rounded-lg transition {{ request()->routeIs('management.dashboard') ? 'text-primary' : 'text-gray-500' }}">
                <i class="fas fa-tachometer-alt text-xl"></i>
                <span class="text-xs mt-1">Dashboard</span>
            </a>
            <a href="{{ route('management.pengajuan.index') }}?status=pending" class="flex flex-col items-center px-3 py-2 rounded-lg transition {{ request()->routeIs('management.pengajuan.index') ? 'text-primary' : 'text-gray-500' }}">
                <i class="fas fa-clock text-xl"></i>
                <span class="text-xs mt-1">Pending</span>
            </a>
            <a href="{{ route('management.pengajuan.index') }}" class="flex flex-col items-center px-3 py-2 rounded-lg transition {{ request()->routeIs('management.pengajuan.index') && !request('status') ? 'text-primary' : 'text-gray-500' }}">
                <i class="fas fa-history text-xl"></i>
                <span class="text-xs mt-1">Semua</span>
            </a>
            <form id="logout-form-bottom" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
        
    @elseif(auth()->user()->isHrd())
        <!-- Menu untuk HRD -->
        <div class="flex justify-around py-2">
            <a href="{{ route('hrd.dashboard') }}" class="flex flex-col items-center px-3 py-2 rounded-lg transition {{ request()->routeIs('hrd.dashboard') ? 'text-primary' : 'text-gray-500' }}">
                <i class="fas fa-tachometer-alt text-xl"></i>
                <span class="text-xs mt-1">Dashboard</span>
            </a>
            <a href="{{ route('hrd.lowongan.create') }}" class="flex flex-col items-center px-3 py-2 rounded-lg transition {{ request()->routeIs('hrd.lowongan.create') ? 'text-primary' : 'text-gray-500' }}">
                <i class="fas fa-plus-circle text-xl"></i>
                <span class="text-xs mt-1">Buat</span>
            </a>
            <a href="{{ route('hrd.lowongan.index') }}" class="flex flex-col items-center px-3 py-2 rounded-lg transition {{ request()->routeIs('hrd.lowongan.index') ? 'text-primary' : 'text-gray-500' }}">
                <i class="fas fa-briefcase text-xl"></i>
                <span class="text-xs mt-1">Lowongan</span>
            </a>
            <a href="{{ route('hrd.pelamar.index') }}" class="flex flex-col items-center px-3 py-2 rounded-lg transition {{ request()->routeIs('hrd.pelamar.index') ? 'text-primary' : 'text-gray-500' }}">
                <i class="fas fa-users text-xl"></i>
                <span class="text-xs mt-1">Pelamar</span>
            </a>
            <form id="logout-form-bottom" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    @endif
</div>