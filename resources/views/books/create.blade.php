@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="max-w-5xl mx-auto px-4 py-8">
    
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Yeni Kitap Ekle</h1>
            <p class="text-slate-500 mt-1">Kütüphane koleksiyonuna yeni bir eser ekleyin.</p>
        </div>
        <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-slate-600 font-medium rounded-xl border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Geri Dön
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100 relative">
        <!-- Decorative Gradient Top -->
        <div class="h-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

        <form action="{{ route('books.store') }}" method="POST" class="p-8">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column: Core Info -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-2 text-indigo-600 mb-4 pb-2 border-b border-indigo-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <span class="font-bold text-sm uppercase tracking-wider">Temel Bilgiler</span>
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Kitap Başlığı</label>
                        <input type="text" name="title" id="title" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none" placeholder="Örn: Sefiller" value="{{ old('title') }}" required>
                        @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="author" class="block text-sm font-semibold text-slate-700 mb-2">Yazar</label>
                        <input type="text" name="author" id="author" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none" placeholder="Örn: Victor Hugo" value="{{ old('author') }}" required>
                        @error('author') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Kitap Açıklaması</label>
                        <textarea name="description" id="description" rows="5" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none resize-none" placeholder="Kitap hakkında kısa bir özet..." required>{{ old('description') }}</textarea>
                        @error('description') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="cover" class="block text-sm font-semibold text-slate-700 mb-2">Kapak Görseli URL</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3.5 text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </span>
                            <input type="url" name="cover" id="cover" class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none" placeholder="https://..." value="{{ old('cover') }}" required>
                        </div>
                        <p class="text-slate-400 text-xs mt-1">Görsel adresi geçerli bir URL olmalıdır.</p>
                        @error('cover') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Right Column: Details & Taxonomy -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-2 text-emerald-600 mb-4 pb-2 border-b border-emerald-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span class="font-bold text-sm uppercase tracking-wider">Detaylar & Sınıflandırma</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="release_date" class="block text-sm font-semibold text-slate-700 mb-2">Yayın Tarihi</label>
                            <input type="date" name="release_date" id="release_date" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none" value="{{ old('release_date') }}" required>
                            @error('release_date') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="language" class="block text-sm font-semibold text-slate-700 mb-2">Dil</label>
                            <select name="language" id="language" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                                <option value="Türkçe">Türkçe</option>
                                <option value="İngilizce">İngilizce</option>
                                <option value="Almanca">Almanca</option>
                                <option value="Fransızca">Fransızca</option>
                                <option value="Diğer">Diğer</option>
                            </select>
                            @error('language') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="genres" class="block text-sm font-semibold text-slate-700 mb-2">Türler</label>
                        <select name="genres[]" id="genres" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none" multiple>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ in_array($genre->id, old('genres', [])) ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-slate-400 text-xs mt-1">Birden fazla tür seçebilirsiniz.</p>
                        @error('genres') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="pages" class="block text-sm font-semibold text-slate-700 mb-2">Sayfa</label>
                            <input type="number" name="pages" id="pages" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none" value="{{ old('pages') }}" required>
                            @error('pages') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="in_stock" class="block text-sm font-semibold text-slate-700 mb-2">Stok</label>
                            <input type="number" name="in_stock" id="in_stock" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none" value="{{ old('in_stock') }}" required>
                            @error('in_stock') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                         <div>
                            <label for="isbn" class="block text-sm font-semibold text-slate-700 mb-2">ISBN</label>
                            <input type="text" name="isbn" id="isbn" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none" placeholder="13 hane..." value="{{ old('isbn') }}" required>
                            @error('isbn') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end space-x-4">
                 <a href="{{ route('books.index') }}" class="px-6 py-3 rounded-xl text-slate-600 font-bold hover:bg-slate-50 transition-colors">
                    İptal Et
                </a>
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:scale-105 transition-all transform flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Kitabı Oluştur
                </button>
            </div>
        </form>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    /* Customizing Select2 to match Tailwind Theme */
    .select2-container .select2-selection--multiple {
        border-color: #e2e8f0;
        border-radius: 0.75rem;
        padding: 0.5rem;
        min-height: 50px;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #10b981; 
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); 
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #ecfdf5; 
        border-color: #10b981;
        color: #065f46;
        border-radius: 0.5rem;
        padding: 2px 8px;
        margin-top: 4px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #065f46;
        margin-right: 5px;
        border-right: 1px solid #10b981;
    }
</style>

<script>
$(document).ready(function() {
    $('#genres').select2({
        placeholder: "Türleri seçin (Birden fazla seçilebilir)",
        allowClear: true,
        width: '100%' 
    });
});
</script>

@endsection
