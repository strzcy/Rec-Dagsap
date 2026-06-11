<nav class="bg-primary shadow-lg fixed top-0 left-0 w-full z-50">
    <div class="px-4">
        <div class="flex justify-between items-center py-3">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-white text-xl font-bold">
                    Dagsap Recruitment
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-6">
                @auth
                    <div class="relative group">
                        <button class="text-white hover:text-gray-200 focus:outline-none flex items-center">
                            

                            <span>User PT. Dagsap Endura Eatore</span>

                            <i class="fas fa-chevron-down ml-2 text-sm"></i>
                        </button>

                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg hidden group-hover:block z-50">
                            <div class="py-1">
                                <div class="px-4 py-3 text-sm text-gray-700 border-b">
                                    <strong>{{ Auth::user()->username }}</strong><br>

                                </div>

                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('admin.login') }}"
                        class="text-white hover:text-gray-200 font-medium">
                        <i class="fas fa-lock mr-1"></i>
                        Login Admin
                    </a>
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <div class="md:hidden">
                <button id="mobile-menu-button"
                    class="text-white focus:outline-none">
                    <i id="menu-icon" class="fas fa-bars text-xl"></i>
                </button>
            </div>

        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-white/20">
            <div class="pt-2 pb-3 space-y-2">

                @auth
                    <div class="text-white px-2 py-2">
                        <div class="font-semibold">
                            {{ Auth::user()->username }}
                        </div>

                        <div class="text-sm text-gray-300">
                            {{ ucfirst(Auth::user()->role) }}
                        </div>

                        @if(Auth::user()->isDivisi())
                            <div class="text-xs text-gray-400 mt-1">
                                Divisi:
                                {{ Auth::user()->divisi->nama_divisi ?? '-' }}
                            </div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit"
                            class="block text-white hover:text-gray-200 px-2 py-1 w-full text-left">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('admin.login') }}"
                        class="block text-white hover:text-gray-200 px-2 py-1">
                        <i class="fas fa-lock mr-2"></i>
                        Login Admin
                    </a>
                @endauth

            </div>
        </div>
    </div>
</nav>
