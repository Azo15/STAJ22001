@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="py-12 px-6">
    <div class="max-w-xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('genres.index') }}" class="text-sm font-medium text-slate-500 hover:text-fuchsia-600 transition-colors flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Tür Listesine Dön
            </a>
        </div>

        <div class="glass-card rounded-3xl p-8 md:p-12 relative overflow-hidden">
             <div class="absolute top-0 right-0 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl -mr-32 -mt-32 pointer-events-none"></div>

            <h2 class="text-3xl font-bold text-slate-900 mb-2 relative z-10">Türü Düzenle</h2>
            <p class="text-slate-500 mb-8 relative z-10"><b>{{ $genre->name }}</b> türünü güncelleyin.</p>

            <form action="{{ route('genres.update', $genre->id) }}" method="POST" class="space-y-6 relative z-10">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Tür Adı</label>
                    <input type="text" id="name" name="name" class="w-full rounded-xl border-slate-200 focus:border-fuchsia-500 focus:ring-fuchsia-500" value="{{ $genre->name }}" required>
                    @error('name')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="style" class="block text-sm font-bold text-slate-700 mb-2">Stil</label>
                    <div class="relative">
                        <select id="style" name="style" class="w-full rounded-xl border-slate-200 focus:border-fuchsia-500 focus:ring-fuchsia-500 bg-white">
                            <option value="primary" {{ $genre->style == 'primary' ? 'selected' : '' }}>Birincil (Mavi)</option>
                            <option value="secondary" {{ $genre->style == 'secondary' ? 'selected' : '' }}>İkincil (Gri)</option>
                            <option value="success" {{ $genre->style == 'success' ? 'selected' : '' }}>Başarılı (Yeşil)</option>
                            <option value="danger" {{ $genre->style == 'danger' ? 'selected' : '' }}>Tehlikeli (Kırmızı)</option>
                            <option value="warning" {{ $genre->style == 'warning' ? 'selected' : '' }}>Uyarı (Sarı)</option>
                            <option value="info" {{ $genre->style == 'info' ? 'selected' : '' }}>Bilgi (Turkuaz)</option>
                            <option value="light" {{ $genre->style == 'light' ? 'selected' : '' }}>Açık (Beyaz)</option>
                            <option value="dark" {{ $genre->style == 'dark' ? 'selected' : '' }}>Koyu (Siyah)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                             <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                     @error('style')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end pt-6 border-t border-slate-100">
                     <button type="submit" class="inline-flex items-center px-8 py-3 bg-fuchsia-600 text-white font-bold rounded-xl shadow-lg hover:bg-fuchsia-700 transition-all transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Türü Güncelle
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
