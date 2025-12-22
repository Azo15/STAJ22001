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
                <h3 class="text-lg font-bold text-slate-800 flex items-center">
                    <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path></svg>
                    En Popüler Kitap
                </h3>
                <span class="bg-amber-100 text-amber-700 text-xs px-2 py-1 rounded-full font-bold">Çok Okunan</span>
            </div>
            <div class="p-6 flex flex-col sm:flex-row items-center gap-8">
                <img src="{{ $popularBookCover }}" alt="kapak" class="w-32 h-48 object-cover rounded-lg shadow-lg rotate-2 hover:rotate-0 transition-transform duration-300">
                <div class="flex-1 text-center sm:text-left">
                    <h4 class="text-2xl font-bold text-slate-900 mb-2">{{ $popularBookTitle }}</h4>
                    <p class="text-slate-500 mb-4 text-lg">Yazar: <span class="font-medium text-slate-700">{{ $popularBookAuthor }}</span></p>
                    <p class="text-slate-600 leading-relaxed mb-6">Bu kitap kütüphanemizdeki okuyucular tarafından en çok tercih edilen eser oldu. Hemen incele ve okumaya başla!</p>
                    @if(isset($popularBookId))
                        <a href="{{ route('books.show', $popularBookId) }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-primary-600 hover:bg-primary-700 shadow-lg shadow-primary-500/30 transition-all transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Kitabı İncele
                        </a>
                    @else
                        <span class="text-slate-400 text-sm">Detaylar kullanılamıyor</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions or Info -->
        <div class="glass-card rounded-2xl p-6 bg-gradient-to-br from-slate-800 to-slate-900 text-white">
            <h3 class="text-xl font-bold mb-4">Hızlı Erişim</h3>
            <ul class="space-y-3">
                <li>
                    <a href="/books" class="flex items-center p-3 rounded-lg bg-white/5 hover:bg-white/10 transition-colors">
                        <span class="p-2 bg-primary-500/20 text-primary-300 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </span>
                        <span>Tüm Kitapları Gör</span>
                    </a>
                </li>
                <li>
                    <a href="/genres" class="flex items-center p-3 rounded-lg bg-white/5 hover:bg-white/10 transition-colors">
                        <span class="p-2 bg-secondary-500/20 text-secondary-300 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </span>
                        <span>Türlere Göz At</span>
                    </a>
                </li>
                @auth
                 <li>
                    <a href="/profile" class="flex items-center p-3 rounded-lg bg-white/5 hover:bg-white/10 transition-colors">
                        <span class="p-2 bg-emerald-500/20 text-emerald-300 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </span>
                        <span>Profilimi Düzenle</span>
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>

</div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Genre Distribution Chart -->
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                Kitap Tür Dağılımı
            </h3>
            <div class="relative h-64">
                <canvas id="genreChart"></canvas>
            </div>
        </div>

        <!-- Rental Trends Chart -->
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                Son 6 Ayın Kiralama Trendi
            </h3>
            <div class="relative h-64">
                <canvas id="rentalChart"></canvas>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Genre Chart
        const genreCtx = document.getElementById('genreChart').getContext('2d');
        new Chart(genreCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartGenreLabels) !!},
                datasets: [{
                    data: {!! json_encode($chartGenreCounts) !!},
                    backgroundColor: [
                        'rgba(244, 63, 94, 0.7)',  // Rose
                        'rgba(14, 165, 233, 0.7)', // Sky
                        'rgba(168, 85, 247, 0.7)', // Purple
                        'rgba(245, 158, 11, 0.7)', // Amber
                        'rgba(16, 185, 129, 0.7)', // Emerald
                        'rgba(99, 102, 241, 0.7)', // Indigo
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { font: { family: 'Outfit' }, boxWidth: 12 }
                    }
                },
                cutout: '70%',
            }
        });

        // Rental Chart
        const rentalCtx = document.getElementById('rentalChart').getContext('2d');
        new Chart(rentalCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartRentalLabels) !!},
                datasets: [{
                    label: 'Ödünç Alma',
                    data: {!! json_encode($chartRentalCounts) !!},
                    borderColor: '#0ea5e9',
                    backgroundColor: 'rgba(14, 165, 233, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#0ea5e9',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                        ticks: { stepSize: 1, font: { family: 'Outfit' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Outfit' } }
                    }
                }
            }
        });
    });
</script>

@endsection
