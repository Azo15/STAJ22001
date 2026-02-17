@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Geri Dön
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100">
        <!-- Header -->
        <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">{{ $message->subject }}</h1>
                <div class="mt-2 flex items-center gap-3 text-sm text-slate-500">
                    <span class="font-medium text-slate-700">{{ $message->name }}</span>
                    <span>&bull;</span>
                    <span>{{ $message->email }}</span>
                    <span>&bull;</span>
                    <span>{{ $message->created_at->format('d.m.Y H:i') }}</span>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="mailto:{{ $message->email }}?subject=Ynt: {{ $message->subject }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-500/20">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    E-posta ile Yanıtla
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="p-8">
            <div class="prose max-w-none text-slate-600 leading-relaxed">
                {!! nl2br(e($message->message)) !!}
            </div>
        </div>
    </div>
</div>
@endsection
