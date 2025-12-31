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
    <nav class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo & Primary Nav -->
                <div class="flex items-center gap-10">
                    <!-- Logo -->
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="h-10 w-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/30 transform group-hover:scale-110 transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <span class="text-2xl font-bold text-slate-900 tracking-tight">BRS</span>
                    </a>

                    <!-- Desktop Nav -->
                    <div class="hidden lg:flex items-center gap-2">
                        <a href="/" class="px-3 py-2 rounded-md text-sm font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all {{ request()->is('/') ? 'text-indigo-600 bg-indigo-50' : '' }}">Ana Sayfa</a>
                        <a href="/books" class="px-3 py-2 rounded-md text-sm font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all {{ request()->is('books*') ? 'text-indigo-600 bg-indigo-50' : '' }}">Kitaplar</a>
                        <a href="/genres" class="px-3 py-2 rounded-md text-sm font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all {{ request()->is('genres*') ? 'text-indigo-600 bg-indigo-50' : '' }}">Türler</a>
                        
                        @auth
                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
                                <div class="relative group">
                                    <button class="flex items-center gap-1 px-3 py-2 rounded-md text-sm font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                                        Yönetim
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                    <div class="absolute left-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-slate-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-left z-50">
                                        <div class="px-4 py-2 border-b border-slate-50 mb-1">
                                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kiralama İşlemleri</span>
                                        </div>
                                        <a href="/rentals/pendinglist" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 font-medium">Bekleyen Talepler</a>
                                        <a href="/rentals/approvedlist" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 font-medium">Onaylananlar</a>
                                        <a href="/rentals/ongoinglist" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 font-medium">Devam Edenler</a>
                                        <a href="/rentals/overdue" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 font-medium">Geciken İadeler</a>
                                        <div class="px-4 py-2 border-b border-slate-50 mb-1 mt-1">
                                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kullanıcılar</span>
                                        </div>
                                        <a href="/readers" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 font-medium">Okuyucu Listesi</a>
                                        @if(auth()->user()->role === 'admin')
                                        <a href="/librarians" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 font-medium">Kütüphaneciler</a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

                <!-- Right Side Actions -->
                <div class="flex items-center gap-6">
                    <!-- Search Bar -->
                    <div class="hidden md:block relative w-64" x-data="{ search: '', results: [], open: false }">
                        <input 
                            type="text" 
                            x-model="search"
                            @input.debounce.300ms="if(search.length > 2) { fetch('/search/suggestions?term=' + search).then(res => res.json()).then(data => { results = data; open = true; }) } else { open = false }"
                            placeholder="Kitap ara..." 
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm outline-none font-medium"
                        >
                        <svg class="absolute left-3 top-3 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        
                        <!-- Search Dropdown -->
                        <div x-show="open && results.length > 0" @click.away="open = false" class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-2xl border border-slate-100 overflow-hidden z-50">
                            <template x-for="result in results" :key="result.value">
                                <a :href="result.url" class="block px-4 py-3 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 border-b border-slate-50 last:border-0 font-medium flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                    <span x-text="result.label"></span>
                                </a>
                            </template>
                        </div>
                    </div>

                    @auth
                        <!-- Notification Icon (Working) -->
                        <div class="relative" x-data="{ open: false, unread: {{ auth()->user()->unreadNotifications->count() > 0 ? 'true' : 'false' }} }">
                            <button @click="open = !open; if(unread) { fetch('{{ route('notifications.read') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } }); unread = false; }" class="relative p-2 text-slate-400 hover:text-indigo-600 transition-colors rounded-full hover:bg-slate-50">
                                <span x-show="unread" class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            </button>

                            <!-- Notification Dropdown -->
                            <div x-show="open" 
                                 @click.away="open = false" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 translate-y-2"
                                 class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-slate-100 overflow-hidden z-50">
                                <div class="px-4 py-3 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Bildirimler</span>
                                    <span class="text-xs text-indigo-600 font-medium cursor-pointer" @click="unread = false">Tümünü Okundu Say</span>
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    @forelse(auth()->user()->unreadNotifications as $notification)
                                        <a href="{{ $notification->data['url'] ?? '#' }}" class="block px-4 py-3 hover:bg-indigo-50 transition-colors border-b border-slate-50 last:border-0 group">
                                            <div class="flex items-start gap-3">
                                                <div class="mt-1 p-1.5 rounded-full {{ isset($notification->data['status']) && $notification->data['status'] == 'rejected' ? 'bg-red-100 text-red-600' : (isset($notification->data['status']) && $notification->data['status'] == 'approved' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600') }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-slate-700 font-medium group-hover:text-indigo-700 leading-snug">{{ $notification->data['message'] }}</p>
                                                    <p class="text-xs text-slate-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="p-8 text-center text-slate-400">
                                            <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                            <p class="text-sm">Yeni bildiriminiz yok.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- User Dropdown -->
                        <div class="relative group">
                            <button class="flex items-center gap-3 pl-2 pr-1 py-1 rounded-full border border-slate-200 hover:border-indigo-300 transition-all bg-white shadow-sm">
                                <span class="text-sm font-bold text-slate-700 pl-2 hidden sm:block">{{ Auth::user()->name }}</span>
                                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs uppercase border border-indigo-200">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </button>
                            
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-2xl border border-slate-100 py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50">
                                <div class="px-4 py-2 border-b border-slate-100">
                                    <p class="text-xs text-slate-400 uppercase font-bold tracking-wider">{{ Auth::user()->role }}</p>
                                </div>
                                <a href="/profile" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 font-medium transition-colors">Profil</a>
                                @if(auth()->user()->role === 'reader')
                                    <a href="/myrentals" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 font-medium transition-colors">Ödünç Aldıklarım</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 font-medium transition-colors">Çıkış Yap</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/20 transform hover:-translate-y-0.5">Giriş Yap</a>
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