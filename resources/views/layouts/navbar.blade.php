<nav class="bg-white/95 backdrop-blur-md shadow-md sticky top-0 z-50 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="#inicio" class="text-2xl font-bold text-primary-600 hover:text-primary-700 transition-colors">
                    IAGUS
                </a>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-1">
                <a href="#inicio" class="nav-link px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-all duration-200 {{ request()->routeIs('home') && !request()->getQueryString() ? 'text-primary-600 font-semibold bg-primary-50' : '' }}">
                    Início
                </a>
                <a href="#conheca" class="nav-link px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-all duration-200">
                    Conheça
                </a>
                <a href="#cultos" class="nav-link px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-all duration-200">
                    Cultos
                </a>
                <a href="#eventos" class="nav-link px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-all duration-200 {{ request()->routeIs('events.*') ? 'text-primary-600 font-semibold bg-primary-50' : '' }}">
                    Eventos
                </a>
                <a href="#juventude" class="nav-link px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-all duration-200">
                    Juventude
                </a>
                <a href="#contato" class="nav-link px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-all duration-200">
                    Contato
                </a>
            </div>
            
            <!-- User Menu -->
            <div class="hidden md:flex items-center space-x-3">
                @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-2 px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-all">
                            <span class="font-medium">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg py-2 hidden group-hover:block border border-gray-100">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm text-gray-500">Logado como</p>
                                <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                        </svg>
                                        Painel Admin
                                    </span>
                                </a>
                            @endif
                            <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Minha Conta
                                </span>
                            </a>
                            <div class="border-t border-gray-100 mt-1 pt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition-colors">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            Sair
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-all">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary px-5 py-2 rounded-lg">
                        Criar Conta
                    </a>
                @endauth
            </div>
            
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button onclick="toggleMobileMenu()" class="p-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-all" id="mobile-menu-btn">
                    <svg class="w-6 h-6" id="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="w-6 h-6 hidden" id="close-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100">
        <div class="px-4 py-3 space-y-1">
            <a href="#inicio" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors font-medium">
                Início
            </a>
            <a href="#conheca" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors font-medium">
                Conheça
            </a>
            <a href="#cultos" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors font-medium">
                Cultos
            </a>
            <a href="#eventos" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors font-medium">
                Eventos
            </a>
            <a href="#juventude" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors font-medium">
                Juventude
            </a>
            <a href="#contato" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors font-medium">
                Contato
            </a>
            
            <div class="border-t border-gray-100 mt-3 pt-3">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Painel Admin
                        </a>
                    @endif
                    <a href="{{ route('user.dashboard') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                        Minha Conta
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                            Sair
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-3 rounded-lg bg-primary-600 text-white hover:bg-primary-700 transition-colors text-center font-medium mt-2">
                        Criar Conta
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
