<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitap Ödünç Alma Sistemi (BRS)</title>
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 text-slate-900" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden" style="display: none;"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 sidebar-gradient transition-transform duration-300 lg:translate-x-0 shadow-2xl">
        <div class="flex flex-col h-full">
            <!-- Brand -->
            <div class="p-6 border-b border-white/10 flex items-center justify-between lg:justify-center">
                <a href="/" class="flex flex-col items-center">
                    <div class="h-16 w-16 rounded-full bg-white/10 flex items-center justify-center mb-3 ring-4 ring-white/5">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    @auth
                        <h4 class="font-bold text-lg tracking-wide">{{ Auth::user()->name }}</h4>
                        <span class="text-xs uppercase tracking-wider text-secondary-500 font-bold bg-white/10 px-2 py-1 rounded mt-1">{{ Auth::user()->role }}</span>
                    @else
                        <h4 class="font-bold text-xl tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-fuchsia-400">BRS SYSTEM</h4>
                    @endauth
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-white/70 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Menü</p>
                
                <!-- Kitaplar -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-200 group" :class="open ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white'">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            <span class="font-medium">Kitaplar</span>
                        </div>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" class="pl-11 pr-4 py-2 space-y-1" style="display: none;">
                        @auth
                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
                                <a href="/books/create" class="block py-2 text-sm text-slate-400 hover:text-sky-300 transition-colors">➕ Yeni Kitap Ekle</a>
                            @endif
                        @endauth
                        <a href="/books" class="block py-2 text-sm text-slate-400 hover:text-sky-300 transition-colors">📑 Kitap Listesi</a>
                    </div>
                </div>

                <!-- Türler -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-200 group" :class="open ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white'">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            <span class="font-medium">Türler</span>
                        </div>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" class="pl-11 pr-4 py-2 space-y-1" style="display: none;">
                        @auth
                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
                                <a href="/genres/create" class="block py-2 text-sm text-slate-400 hover:text-sky-300 transition-colors">➕ Yeni Tür Ekle</a>
                            @endif
                        @endauth
                        <a href="/genres" class="block py-2 text-sm text-slate-400 hover:text-sky-300 transition-colors">📂 Tür Listesi</a>
                    </div>
                </div>

                @auth
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
                        <div class="my-4 border-t border-white/10"></div>
                        <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Yönetim</p>
                        
                        <!-- Ödünç Alma Talepleri -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-200 group" :class="open ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white'">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                    <span class="font-medium">Talepler</span>
                                </div>
                                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" class="pl-11 pr-4 py-2 space-y-1" style="display: none;">
                                <a href="/rentals/pendinglist" class="block py-2 text-sm text-slate-400 hover:text-sky-300 transition-colors">⏳ Bekleyen</a>
                                <a href="/rentals/approvedlist" class="block py-2 text-sm text-slate-400 hover:text-sky-300 transition-colors">✅ Onaylanan</a>
                                <a href="/rentals/rejectedlist" class="block py-2 text-sm text-slate-400 hover:text-sky-300 transition-colors">❌ Reddedilen</a>
                            </div>
                        </div>

                        <!-- İşlemler -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-200 group" :class="open ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white'">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                    <span class="font-medium">İşlemler</span>
                                </div>
                                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" class="pl-11 pr-4 py-2 space-y-1" style="display: none;">
                                <a href="/rentals/ongoinglist" class="block py-2 text-sm text-slate-400 hover:text-sky-300 transition-colors">🚚 Devam Eden</a>
                                <a href="/rentals/returnedlist" class="block py-2 text-sm text-slate-400 hover:text-sky-300 transition-colors">📬 Tamamlanan</a>
                                <a href="/rentals/overduelist" class="block py-2 text-sm text-slate-400 hover:text-sky-300 transition-colors">⏰ Geciken</a>
                                <a href="/rentals/all" class="block py-2 text-sm text-slate-400 hover:text-sky-300 transition-colors">📋 Tümü</a>
                            </div>
                        </div>

                         <a href="/readers" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-white/5 hover:text-white transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span class="font-medium">Okuyucular</span>
                        </a>

                        @if(auth()->user()->role === 'admin')
                             <a href="/librarians" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-white/5 hover:text-white transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span class="font-medium">Kütüphaneciler</span>
                            </a>
                        @endif

                    @endif
                @endauth

            </nav>
            
            <!-- Footer User Action -->
            <div class="p-4 border-t border-white/10">
                 @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-red-300 hover:bg-red-500/10 hover:text-red-200 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span class="font-medium">Çıkış Yap</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl bg-white text-indigo-900 font-bold hover:bg-sky-50 transition-all duration-200">
                        Giriş Yap
                    </a>
                @endauth
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen lg:ml-72 bg-slate-50 transition-all duration-300">
        
        <!-- Topbar -->
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-30 px-4 sm:px-8 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg hover:bg-slate-100 text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                </button>
                
                <!-- Search Bar -->
                <div class="hidden md:block relative group">
                    <form action="{{ route('search.results') }}" method="GET">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-hover:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="query" class="block w-64 lg:w-96 pl-10 pr-4 py-2.5 border-none rounded-full bg-slate-100 text-sm focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all shadow-inner" placeholder="Kitap, yazar veya tür ara...">
                    </form>
                </div>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center gap-4">
                @auth
                    <!-- Notifications -->
                    <button class="relative p-2 rounded-full hover:bg-slate-100 text-slate-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                    
                    <!-- Profile -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-3 hover:bg-slate-100 rounded-full p-1 pr-3 transition-colors">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0ea5e9&color=fff" alt="Avatar" class="h-9 w-9 rounded-full shadow-sm">
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-semibold text-slate-700 leading-tight">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500 capitalize">{{ Auth::user()->role }}</p>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl py-2 border border-slate-100 z-50 text-sm" style="display: none;">
                            <div class="px-4 py-2 border-b border-slate-50 md:hidden">
                                <p class="font-medium text-slate-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-slate-600 hover:bg-slate-50 hover:text-primary-600">Profilim</a>
                            @if(auth()->user()->role === 'reader')
                                <a href="/myrentals" class="block px-4 py-2 text-slate-600 hover:bg-slate-50 hover:text-primary-600">Ödünç Aldıklarım</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">Çıkış Yap</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-slate-600 font-medium hover:text-primary-600 px-4">Giriş</a>
                    <a href="{{ route('register') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2.5 rounded-full font-medium transition-all shadow-lg shadow-primary-500/30">Kayıt Ol</a>
                @endauth
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6 md:p-8 overflow-x-hidden">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 py-6 text-center text-sm text-slate-500">
            &copy; {{ date('Y') }} Kitap Ödünç Alma Sistemi. Tüm hakları saklıdır.
        </footer>
    </div>

</body>
</html>