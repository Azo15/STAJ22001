@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="max-w-7xl mx-auto space-y-8">

    <!-- Welcome Section -->
    <div class="glass p-8 rounded-2xl bg-gradient-to-r from-primary-600 to-secondary-600 text-white relative overflow-hidden">
        <div class="relative z-10">
            @auth
                <h1 class="text-3xl font-bold mb-2">Hoşgeldin, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-primary-100 text-lg">Kütüphane yönetim paneline erişimin hazır. Bugün ne yapmak istersin?</p>
            @else
                <h1 class="text-3xl font-bold mb-2">Hoşgeldin, Kitap Sever! 👋</h1>
                <p class="text-primary-100 text-lg">Binlerce kitabı keşfetmek ve ödünç almak için hemen giriş yap veya kayıt ol.</p>
            @endauth
        </div>
        <div class="absolute right-0 top-0 h-full w-1/3 bg-white/10 skew-x-12 transform translate-x-12"></div>
        <div class="absolute right-20 bottom-0 h-48 w-48 bg-secondary-500/30 rounded-full blur-3xl"></div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        
        <!-- Okuyucu Sayısı -->
        <div class="glass-card p-6 rounded-2xl border-l-4 border-l-blue-500 relative overflow-hidden group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 text-sm font-medium uppercase tracking-wider mb-1">Okuyucular</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $numberOfReaders }}</h3>
                </div>
                <div class="p-3 bg-blue-50 rounded-xl text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-green-600 font-medium">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                <span>Aktif Kullanıcılar</span>
            </div>
        </div>

        <!-- Tür Sayısı -->
        <div class="glass-card p-6 rounded-2xl border-l-4 border-l-amber-500 relative overflow-hidden group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 text-sm font-medium uppercase tracking-wider mb-1">Türler</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $numberOfGenres }}</h3>
                </div>
                <div class="p-3 bg-amber-50 rounded-xl text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-slate-400 font-medium">
                <span>Kategorize edilmiş</span>
            </div>
        </div>

        <!-- Kitap Sayısı -->
        <div class="glass-card p-6 rounded-2xl border-l-4 border-l-emerald-500 relative overflow-hidden group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 text-sm font-medium uppercase tracking-wider mb-1">Kitaplar</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $numberOfBooks }}</h3>
                </div>
                <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-green-600 font-medium">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Yeni Ekle</span>
            </div>
        </div>

        <!-- Aktif Ödünç -->
        <div class="glass-card p-6 rounded-2xl border-l-4 border-l-rose-500 relative overflow-hidden group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 text-sm font-medium uppercase tracking-wider mb-1">Aktif Ödünç</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $numberOfActiveRentals }}</h3>
                </div>
                <div class="p-3 bg-rose-50 rounded-xl text-rose-600 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-rose-600 font-medium">
                <span>Takip Ediliyor</span>
            </div>
        </div>
    </div>

    <!-- Featured Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Popular Book -->
        <div class="lg:col-span-2 glass-card rounded-2xl p-0 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">🔥 En Popüler Kitap</h3>
                <span class="bg-amber-100 text-amber-700 text-xs px-2 py-1 rounded-full font-bold">Çok Okunan</span>
            </div>
            <div class="p-6 flex flex-col sm:flex-row items-center gap-8">
                <img src="{{ $popularBookCover }}" alt="kapak" class="w-32 h-48 object-cover rounded-lg shadow-lg rotate-2 hover:rotate-0 transition-transform duration-300">
                <div class="flex-1 text-center sm:text-left">
                    <h4 class="text-2xl font-bold text-slate-900 mb-2">{{ $popularBookTitle }}</h4>
                    <p class="text-slate-500 mb-4 text-lg">Yazar: <span class="font-medium text-slate-700">{{ $popularBookAuthor }}</span></p>
                    <p class="text-slate-600 leading-relaxed mb-6">Bu kitap kütüphanemizdeki okuyucular tarafından en çok tercih edilen eser oldu. Hemen incele ve okumaya başla!</p>
                    <a href="#" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-primary-600 hover:bg-primary-700 shadow-lg shadow-primary-500/30 transition-all transform hover:-translate-y-1">
                        Kitabı İncele
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions or Info -->
        <div class="glass-card rounded-2xl p-6 bg-gradient-to-br from-slate-800 to-slate-900 text-white">
            <h3 class="text-xl font-bold mb-4">Hızlı Erişim</h3>
            <ul class="space-y-3">
                <li>
                    <a href="/books" class="flex items-center p-3 rounded-lg bg-white/5 hover:bg-white/10 transition-colors">
                        <span class="p-2 bg-primary-500/20 text-primary-300 rounded-lg mr-3">📚</span>
                        <span>Tüm Kitapları Gör</span>
                    </a>
                </li>
                <li>
                    <a href="/genres" class="flex items-center p-3 rounded-lg bg-white/5 hover:bg-white/10 transition-colors">
                        <span class="p-2 bg-secondary-500/20 text-secondary-300 rounded-lg mr-3">🎭</span>
                        <span>Türlere Göz At</span>
                    </a>
                </li>
                @auth
                 <li>
                    <a href="/profile" class="flex items-center p-3 rounded-lg bg-white/5 hover:bg-white/10 transition-colors">
                        <span class="p-2 bg-emerald-500/20 text-emerald-300 rounded-lg mr-3">👤</span>
                        <span>Profilimi Düzenle</span>
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>

</div>

@endsection
