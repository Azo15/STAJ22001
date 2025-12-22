<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRS System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900 selection:bg-fuchsia-500 selection:text-white">

    <!-- Top Navigation Bar -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo & Primary Nav -->
                <div class="flex items-center gap-8">
                    <!-- Logo -->
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-indigo-600 to-fuchsia-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/30 transform group-hover:rotate-12 transition-all duration-300">
                            <span class="text-xl">📚</span>
                        </div>
                        <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-fuchsia-600">BRS</span>
                    </a>

                    <!-- Desktop Nav -->
                    <div class="hidden lg:flex items-center gap-1">
                        <a href="/" class="px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 transition-all {{ request()->is('/') ? 'bg-indigo-50 text-indigo-600' : '' }}">Ana Sayfa</a>
                        <a href="/books" class="px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 transition-all {{ request()->is('books*') ? 'bg-indigo-50 text-indigo-600' : '' }}">Kitaplar</a>
                        <a href="/genres" class="px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 transition-all {{ request()->is('genres*') ? 'bg-indigo-50 text-indigo-600' : '' }}">Türler</a>
                        
                        @auth
                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
                                <div class="relative ml-2" x-data="{ open: false }">
                                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-1 px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 transition-all">
                                        Yönetim
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                    <div x-show="open" class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-1" style="display: none;">
                                        <a href="/rentals/pendinglist" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">Bekleyen Talepler</a>
                                        <a href="/rentals/ongoinglist" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">Devam Edenler</a>
                                        <a href="/readers" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">Okuyucular</a>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

                <!-- Right Side Actions -->
                <div class="flex items-center gap-4">
                    <!-- Search Bar -->
                    <div class="hidden md:block relative w-64" x-data="{ search: '', results: [], open: false }">
                        <input 
                            type="text" 
                            x-model="search"
                            @input.debounce.300ms="if(search.length > 2) { fetch('/search/suggestions?term=' + search).then(res => res.json()).then(data => { results = data; open = true; }) } else { open = false }"
                            placeholder="Kitap ara..." 
                            class="w-full pl-10 pr-4 py-2 rounded-full border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all text-sm outline-none"
                        >
                        <svg class="absolute left-3 top-2.5 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        
                        <!-- Search Dropdown -->
                        <div x-show="open && results.length > 0" @click.away="open = false" class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden z-50">
                            <template x-for="result in results" :key="result.value">
                                <a :href="result.url" class="block px-4 py-3 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 border-b border-slate-50 last:border-0">
                                    <span x-text="result.label"></span>
                                </a>
                            </template>
                        </div>
                    </div>

                    @auth
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 pl-2 pr-1 py-1 rounded-full border border-slate-200 hover:border-indigo-300 transition-all bg-white">
                                <span class="text-sm font-semibold text-slate-700 pl-2 hidden sm:block">{{ Auth::user()->name }}</span>
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff" alt="Avatar" class="w-8 h-8 rounded-full">
                            </button>
                            
                            <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-1" style="display: none;">
                                <div class="px-4 py-2 border-b border-slate-100">
                                    <p class="text-xs text-slate-400 uppercase font-bold tracking-wider">{{ Auth::user()->role }}</p>
                                </div>
                                <a href="/profile" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">Profil</a>
                                @if(auth()->user()->role === 'reader')
                                    <a href="/myrentals" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">Ödünç Aldıklarım</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-rose-600 hover:bg-rose-50">Çıkış Yap</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 rounded-full bg-slate-900 text-white text-sm font-bold hover:bg-slate-800 transition-colors shadow-lg shadow-slate-900/20">Giriş Yap</a>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button class="lg:hidden p-2 text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-8">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-slate-500 text-sm">© {{ date('Y') }} BRS Library System. Tüm hakları saklıdır.</p>
            <div class="flex gap-6 text-slate-400">
                <a href="#" class="hover:text-indigo-600 transition-colors">Gizlilik</a>
                <a href="#" class="hover:text-indigo-600 transition-colors">Şartlar</a>
                <a href="#" class="hover:text-indigo-600 transition-colors">İletişim</a>
            </div>
        </div>
    </footer>

</body>
</html>