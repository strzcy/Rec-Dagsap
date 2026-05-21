<nav class="bg-primary shadow-lg">
    <div class="px-4">
        <div class="flex justify-between items-center py-3">
            <!-- Logo/Brand -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-white text-xl font-bold">
                    Dagsap Recruitment
                </a>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-6">
                @auth
                    <!-- User yang login -->
                    <div class="relative group">
                        <button class="text-white hover:text-gray-200 focus:outline-none flex items-center">
                            <i class="fas fa-user-circle mr-2 text-xl"></i>
                            <span>{{ Auth::user()->username }}</span>
                            <span class="ml-2 text-xs bg-white bg-opacity-20 px-2 py-1 rounded">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                            <i class="fas fa-chevron-down ml-2 text-sm"></i>
                        </button>
                        
                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg hidden group-hover:block z-50">
                            <div class="py-1">
                                <div class="px-4 py-3 text-sm text-gray-700 border-b">
                                    <strong>{{ Auth::user()->username }}</strong><br>
                                    <span class="text-xs text-gray-500">
                                        @if(Auth::user()->isDivisi())
                                            Divisi: {{ Auth::user()->divisi->nama_divisi ?? '-' }}
                                        @else
                                            Role: {{ ucfirst(Auth::user()->role) }}
                                        @endif
                                    </span>
                                </div>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Guest (pelamar lihat lowongan) -->
                    <a href="{{ route('admin.login') }}" class="text-white hover:text-gray-200">
                        <i class="fas fa-lock mr-1"></i> Login Admin
                    </a>
                @endauth
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden pb-3">
            @auth
                <div class="pt-2 pb-3 space-y-2">
                    <div class="text-white py-2 px-2">
                        <div class="font-semibold">{{ Auth::user()->username }}</div>
                        <div class="text-sm opacity-75">@ {{ Auth::user()->username }}</div>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="text-white hover:text-gray-200 w-full text-left px-2 py-1">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>