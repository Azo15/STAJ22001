@extends('layouts.main')

@section('title', 'İletişim')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Contact Info -->
        <div>
            <h1 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-violet-600 mb-4">İletişime Geçin</h1>
            <p class="text-slate-500 text-lg mb-8">Sorularınız, önerileriniz veya destek talepleriniz için bize her zaman ulaşabilirsiniz.</p>

            <div class="grid gap-6">
                <!-- User Provided Info -->
                <div class="glass-card p-6 rounded-2xl border border-slate-200/60 flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">E-posta Adresi</h3>
                        <p class="text-slate-500 text-sm mb-1">Genel sorular ve destek için</p>
                        <a href="mailto:ismailazo260@gmail.com" class="text-indigo-600 font-medium hover:underline">ismailazo260@gmail.com</a>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-2xl border border-slate-200/60 flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center text-rose-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Konum</h3>
                        <p class="text-slate-500 text-sm mb-1">Merkez Ofis</p>
                        <span class="text-slate-700 font-medium">Kırklareli, Türkiye</span>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-2xl border border-slate-200/60 flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Çalışma Saatleri</h3>
                        <p class="text-slate-500 text-sm mb-1">Hafta içi her gün</p>
                        <span class="text-slate-700 font-medium">09:00 - 18:00</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form (Visual Only for now) -->
        <div class="glass-card p-8 rounded-2xl border border-slate-200/60 shadow-lg">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <h3 class="text-xl font-bold text-slate-800 mb-6">Bize Mesaj Gönderin</h3>
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Adınız Soyadınız</label>
                        <input type="text" name="name" required class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all" placeholder="Adınız">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">E-posta Adresiniz</label>
                        <input type="email" name="email" required class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all" placeholder="ornek@email.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Konu</label>
                        <select name="subject" class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all bg-white">
                            <option value="Genel Sorular">Genel Sorular</option>
                            <option value="Teknik Destek">Teknik Destek</option>
                            <option value="Öneri / Şikayet">Öneri / Şikayet</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Mesajınız</label>
                        <textarea name="message" required rows="4" class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all" placeholder="Mesajınızı buraya yazın..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-xl hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-500/20">
                        Mesajı Gönder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
