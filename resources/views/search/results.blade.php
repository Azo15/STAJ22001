@extends('layouts.main')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-violet-600">Arama Sonuçları</h2>
            <p class="text-slate-500 mt-1">"{{ request('query') }}" araması için bulunan sonuçlar.</p>
        </div>
    </div>

    @if($books->isNotEmpty())
        <div class="glass-card rounded-2xl overflow-hidden border border-slate-200/60">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500 font-semibold">
                            <th class="px-6 py-4">Kapak</th>
                            <th class="px-6 py-4">Kitap Bilgileri</th>
                            <th class="px-6 py-4">Tür</th>
                            <th class="px-6 py-4 text-center">Detaylar</th>
                            <th class="px-6 py-4 text-right">İşlem</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($books as $book)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150 group">
                            <td class="px-6 py-4 w-24">
                                <div class="relative h-24 w-16 shadow-md rounded overflow-hidden transform group-hover:scale-110 transition-transform duration-300">
                                    <img src="{{ $book->cover ?? 'https://easydrawingguides.com/wp-content/uploads/2020/10/how-to-draw-an-open-book-featured-image-1200.png' }}" alt="Kapak" class="h-full w-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800 text-base mb-1">{{ $book->title }}</span>
                                    <span class="text-sm text-slate-500 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        {{ $book->author }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($book->genres as $genre)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                            {{ $genre->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="inline-flex flex-col items-center">
                                    <span class="text-sm font-semibold text-slate-700">{{ $book->release_date }}</span>
                                    <span class="text-[10px] uppercase text-slate-400">Yayın Tarihi</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('books.show', $book->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-lg shadow-md shadow-indigo-500/20 transition-all transform hover:-translate-y-0.5">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    İncele
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="glass-card rounded-2xl p-12 text-center border border-slate-200/60">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 mb-6 ring-4 ring-slate-50 shadow-inner">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">Sonuç Bulunamadı</h3>
            <p class="text-slate-500 max-w-md mx-auto">
                "<span class="font-semibold text-slate-700">{{ request('query') }}</span>" araması için herhangi bir sonuç bulamadık. Lütfen farklı anahtar kelimelerle tekrar deneyin veya türler sayfasına göz atın.
            </p>
            <div class="mt-8">
                <a href="/books" class="inline-flex items-center px-5 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-semibold hover:bg-slate-50 hover:text-slate-900 transition-colors shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Tüm Kitapları Gör
                </a>
            </div>
        </div>
    @endif
</div>

@endsection
