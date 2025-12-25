@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="max-w-4xl mx-auto mt-20">
    <div class="glass-card p-12 text-center rounded-3xl relative overflow-hidden">
        <div class="absolute inset-0 bg-red-500/5 z-0"></div>
        <div class="relative z-10">
            <div class="mb-6 inline-flex p-6 rounded-full bg-red-100 text-red-600 shadow-inner">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h2 class="text-4xl font-bold text-slate-800 mb-4 font-heading">Erişim Engellendi (403)</h2>
            <p class="text-lg text-slate-600 mb-8 max-w-lg mx-auto">Bu sayfayı görüntülemek için yeterli yetkiye sahip değilsiniz. Lütfen yöneticinizle iletişime geçin veya ana sayfaya dönün.</p>
            
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-medium rounded-xl text-white bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 shadow-lg shadow-red-500/30 transition-all transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Ana Sayfaya Dön
            </a>
        </div>
    </div>
</div>

@endsection