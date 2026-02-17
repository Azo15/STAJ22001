@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" 
     x-data="{ 
        search: '', 
        hasResults: true,
        updateResults() {
            this.$nextTick(() => {
                // tbody içindeki satırları kontrol et
                const rows = this.$refs.tbody ? Array.from(this.$refs.tbody.querySelectorAll('tr')) : [];
                // Eğer en az bir satır görünürse (style.display !== 'none'), sonuç var demektir
                this.hasResults = rows.some(row => row.style.display !== 'none');
            });
        }
     }"
     x-init="$watch('search', () => updateResults())">
    
    <!-- Header & Search -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-700">Kitap Koleksiyonu</h2>
            <p class="text-slate-500 mt-1">Kütüphanedeki tüm kitapları buradan yönetebilir ve inceleyebilirsiniz.</p>
        </div>
        
        <div class="flex gap-4 w-full md:w-auto">
            <div class="relative w-full md:w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" x-model="search" class="block w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all shadow-sm group-hover:shadow-md" placeholder="Tabloda ara...">
            </div>

            @auth
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
                    <a href="{{ route('books.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5 whitespace-nowrap">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Yeni Kitap Ekle
                    </a>
                @endif
            @endauth
        </div>
    </div>

    <!-- Table Container -->
    <div class="glass-card rounded-2xl overflow-hidden border border-slate-200/60">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500 font-semibold">
                        <th class="px-6 py-4">Kapak</th>
                        <th class="px-6 py-4">Kitap Bilgileri</th>
                        <th class="px-6 py-4">Tür</th>
                        <th class="px-6 py-4 text-center">Detaylar</th>
                        <th class="px-6 py-4 text-center">Stok</th>
                        <th class="px-6 py-4 text-right">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100" x-ref="tbody">
                    @foreach($books as $book)
                    <tr class="hover:bg-slate-50/80 transition-colors duration-150 group" x-show="!search || '{{ strtolower($book->title) }}'.includes(search.toLowerCase()) || '{{ strtolower($book->author) }}'.includes(search.toLowerCase())">
                        <td class="px-6 py-4 w-24">
                            <div class="relative h-24 w-16 shadow-md rounded overflow-hidden transform group-hover:scale-110 transition-transform duration-300">
                                <img src="{{ $book->cover }}" onerror="this.onerror=null;this.src='https://easydrawingguides.com/wp-content/uploads/2020/10/how-to-draw-an-open-book-featured-image-1200.png';" alt="Kapak" class="h-full w-full object-cover">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800 text-base mb-1">{{ $book->title }}</span>
                                <span class="text-sm text-slate-500 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $book->author }}
                                </span>
                                <span class="text-xs text-slate-400 mt-1">{{ $book->language }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach($book->genres as $genre)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-secondary-50 text-secondary-700 border border-secondary-100">
                                        {{ $genre->name }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex flex-col items-center">
                                <span class="text-sm font-semibold text-slate-700">{{ $book->pages }}</span>
                                <span class="text-[10px] uppercase text-slate-400">Sayfa</span>
                                <span class="text-xs text-slate-500 mt-1">{{ $book->release_date }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($book->in_stock > 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    {{ $book->in_stock }} Adet
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Tükendi
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('books.show', $book->id) }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:text-primary-600 hover:border-primary-200 hover:shadow-sm transition-all" title="Görüntüle">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>

                                @auth
                                    @if(auth()->user()->role === 'reader')
                                        <form action="{{ route('books.rentals.store', ['book' => $book->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="p-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 shadow-sm transition-colors" title="Ödünç Al">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </button>
                                        </form>
                                    @endif

                                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
                                        <a href="{{ route('books.edit', $book->id) }}" class="p-2 bg-amber-50 border border-amber-200 rounded-lg text-amber-600 hover:bg-amber-100 transition-colors" title="Düzenle">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu kitabı silmek istediğinize emin misiniz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-50 border border-red-200 rounded-lg text-red-600 hover:bg-red-100 transition-colors" title="Sil">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Empty State -->
        <div x-show="!hasResults && search.length > 0" class="p-12 text-center" style="display: none;">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            <h3 class="text-lg font-medium text-slate-900">Sonuç Bulunamadı</h3>
            <p class="text-slate-500 mt-1">Arama kriterlerinize uygun kitap bulunamadı.</p>
        </div>
    </div>
</div>

@endsection
