@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="py-12 px-6">
    <div class="max-w-2xl mx-auto">
        <div class="mb-4">
            <a href="{{ url()->previous() }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Geri Dön
            </a>
        </div>

        <div class="glass-card rounded-3xl p-8 md:p-12 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-amber-500/10 rounded-full blur-3xl -mr-32 -mt-32 pointer-events-none"></div>
            
            <h2 class="text-3xl font-bold text-slate-900 mb-2 relative z-10">Ödünç Almayı Düzenle</h2>
            <p class="text-slate-500 mb-8 relative z-10">Kiralama durumunu ve tarihlerini buradan güncelleyebilirsiniz.</p>

            <form action="{{ route('books.rentals.update', ['book' => $rental->book->id, 'rental' => $rental->id]) }}" method="POST" class="space-y-6 relative z-10">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kullanıcı</label>
                        <input type="text" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 font-medium cursor-not-allowed" value="{{ $rental->user->name }}" disabled>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kitap Başlığı</label>
                        <input type="text" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 font-medium cursor-not-allowed" value="{{ $rental->book->title }}" disabled>
                    </div>
                </div>

                <div>
                    <label for="status" class="block text-sm font-bold text-slate-700 mb-2">Durum</label>
                    <div class="relative">
                        <select id="status" name="status" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white">
                            <option value="Pending Review" {{ $rental->status == 'Pending Review' ? 'selected' : '' }}>İncelemede</option>
                            <option value="Approved" {{ $rental->status == 'Approved' ? 'selected' : '' }}>Onaylandı</option>
                            <option value="Returned" {{ $rental->status == 'Returned' ? 'selected' : '' }}>İade Edildi</option>
                            <option value="Overdue" {{ $rental->status == 'Overdue' ? 'selected' : '' }}>Gecikmiş</option>
                            <option value="Cancelled" {{ $rental->status == 'Cancelled' ? 'selected' : '' }}>İptal Edildi</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    @error('status')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Ödünç Alma Talep Tarihi</label>
                    <input type="text" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 font-mono text-sm" value="{{ $rental->rental_requested_at }}" readonly>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="rental_start_at" class="block text-sm font-bold text-slate-700 mb-2">Başlangıç Tarihi</label>
                        <input type="datetime-local" id="rental_start_at" name="rental_start_at" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" value="{{ $rental->rental_start_at ? $rental->rental_start_at->format('Y-m-d\TH:i') : '' }}">
                        @error('rental_start_at')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="rental_due_at" class="block text-sm font-bold text-slate-700 mb-2">Teslim Tarihi</label>
                        <input type="datetime-local" id="rental_due_at" name="rental_due_at" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" value="{{ $rental->rental_due_at ? $rental->rental_due_at->format('Y-m-d\TH:i') : '' }}">
                        @error('rental_due_at')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="rental_returned_at" class="block text-sm font-bold text-slate-700 mb-2">İade Tarihi (Opsiyonel)</label>
                    <input type="datetime-local" id="rental_returned_at" name="rental_returned_at" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" value="{{ $rental->returned_at ? $rental->returned_at->format('Y-m-d\TH:i') : '' }}">
                    <p class="text-xs text-slate-400 mt-1">Kitap iade edildiğinde bu alanı doldurun.</p>
                    @error('rental_returned_at')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end pt-6 border-t border-slate-100">
                     <button type="submit" class="inline-flex items-center px-8 py-4 bg-slate-900 text-white font-bold rounded-xl shadow-lg hover:bg-slate-800 transition-all transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Güncelle
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
