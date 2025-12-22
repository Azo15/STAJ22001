@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="py-12 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('books.index') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kitap Listesine Dön
            </a>
        </div>

        <div class="glass-card rounded-3xl p-8 md:p-12 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl -mr-32 -mt-32 pointer-events-none"></div>
            
            <h2 class="text-3xl font-bold text-slate-900 mb-2 relative z-10">Kitabı Düzenle</h2>
            <p class="text-slate-500 mb-8 relative z-10">{{ $book->title }} kitabının bilgilerini güncelleyin.</p>

            <form action="{{ route('books.update', $book->id) }}" method="POST" class="space-y-6 relative z-10">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Sol Sütun -->
                    <div class="space-y-6">
                         <div>
                            <label for="title" class="block text-sm font-bold text-slate-700 mb-2">Başlık</label>
                            <input type="text" name="title" id="title" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('title', $book->title) }}" required>
                            @error('title')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="author" class="block text-sm font-bold text-slate-700 mb-2">Yazar</label>
                            <input type="text" name="author" id="author" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('author', $book->author) }}" required>
                            @error('author')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-bold text-slate-700 mb-2">Açıklama</label>
                            <textarea name="description" id="description" rows="6" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description', $book->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="cover" class="block text-sm font-bold text-slate-700 mb-2">Kapak Görseli URL</label>
                            <input type="text" name="cover" id="cover" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm font-mono text-slate-600" value="{{ old('cover', $book->cover) }}" required>
                            @error('cover')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Sağ Sütun -->
                    <div class="space-y-6">
                        <div>
                            <label for="release_date" class="block text-sm font-bold text-slate-700 mb-2">Yayın Tarihi</label>
                            <input type="date" name="release_date" id="release_date" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('release_date', $book->release_date) }}" required>
                            @error('release_date')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="genres" class="block text-sm font-bold text-slate-700 mb-2">Türler (Çoklu seçim için Ctrl'ye basılı tutun)</label>
                            <select name="genres[]" id="genres" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 min-h-[120px]" multiple>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" class="py-1"
                                        {{ in_array($genre->id, old('genres', $book->genres->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('genres')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                         <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="language" class="block text-sm font-bold text-slate-700 mb-2">Dil</label>
                                <input type="text" name="language" id="language" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('language', $book->language) }}" placeholder="Eng" required>
                                @error('language')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="pages" class="block text-sm font-bold text-slate-700 mb-2">Sayfa Sayısı</label>
                                <input type="number" name="pages" id="pages" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('pages', $book->pages) }}" required>
                                @error('pages')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                         <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="isbn" class="block text-sm font-bold text-slate-700 mb-2">ISBN</label>
                                <input type="text" name="isbn" id="isbn" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('isbn', $book->isbn) }}" required>
                                @error('isbn')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="in_stock" class="block text-sm font-bold text-slate-700 mb-2">Stok Adedi</label>
                                <input type="number" name="in_stock" id="in_stock" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('in_stock', $book->in_stock) }}" required>
                                @error('in_stock')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-8 border-t border-slate-100">
                    <a href="{{ route('books.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-all">İptal</a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl shadow-lg hover:bg-indigo-700 transition-all transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Değişiklikleri Kaydet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
