@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-slate-800">Logo Tasarım Önerileri</h1>
            <p class="text-slate-500 mt-2">Sistem için hazırlanan 3 farklı logo konsepti. Hangisini tercih edersiniz?</p>
        </div>

        <div class="grid gap-8 md:grid-cols-1">
            <!-- Option 1: Modern & Tech -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col items-center hover:shadow-md transition-shadow">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Seçenek 1: Modern & Teknolojik</span>
                
                <div class="flex items-center gap-3 scale-150 transform p-4">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-cyan-500 flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-2xl font-bold text-slate-900 leading-none tracking-tight">BOOKA</span>
                        <span class="text-[0.6rem] font-bold text-blue-500 uppercase tracking-widest leading-none mt-0.5">Library System</span>
                    </div>
                </div>
                <p class="mt-6 text-sm text-slate-500 text-center px-8">Mevcut tasarımın daha modern ve "app-like" bir yorumu. Canlı mavi tonları ve net tipografi.</p>
            </div>

            <!-- Option 2: Elegant & Classic -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col items-center hover:shadow-md transition-shadow">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Seçenek 2: Klasik & Prestijli</span>
                
                <div class="flex items-center gap-4 scale-150 transform p-4">
                    <div class="relative">
                        <svg class="w-10 h-10 text-indigo-900" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v18.5c-2.3 0-4-1.2-6-1.2s-6 1.2-6 1.2V3c0 2 2.7 3.5 6 3.5s6-1.5 6-3.5zm0 0v18.5c2.3 0 4-1.2 6-1.2s6 1.2 6 1.2V3c0 2-2.7 3.5-6 3.5s-6-1.5-6-3.5z"/></svg>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-amber-400 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-3xl font-serif font-bold text-indigo-950 leading-none">BOOKA</span>
                    </div>
                </div>
                <p class="mt-6 text-sm text-slate-500 text-center px-8">Serif font ve ikon kullanımı ile daha akademik ve ciddi bir duruş. Lacivert ve altın tonları.</p>
            </div>

            <!-- Option 3: Minimalist abstract -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col items-center hover:shadow-md transition-shadow">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Seçenek 3: Minimalist & Soyut</span>
                
                <div class="flex items-center gap-3 scale-150 transform p-4">
                    <div class="flex space-x-1">
                        <div class="w-2 h-8 bg-emerald-500 rounded-sm"></div>
                        <div class="w-2 h-8 bg-teal-500 rounded-sm mt-2"></div>
                        <div class="w-2 h-8 bg-cyan-500 rounded-sm"></div>
                    </div>
                    <span class="text-2xl font-black text-slate-800 tracking-tighter">booka<span class="text-teal-500">.</span></span>
                </div>
                <p class="mt-6 text-sm text-slate-500 text-center px-8">Kitap sırtlarını temsil eden soyut geometrik şekiller. Küçük harf kullanımı ile modern ve ulaşılabilir.</p>
            </div>
        </div>
    </div>
</div>
@endsection
