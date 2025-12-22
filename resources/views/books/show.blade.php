@extends('layouts.main')

@section('content')

@include('flashmsg')

@php
    $user = auth()->user();
    $isAdmin = $user && ($user->role === 'admin');
    $isLibrarian = $user && ($user->role === 'librarian');
    $isReader = $user && ($user->role === 'reader');
@endphp

<div class="px-6 py-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Book Details Card -->
        <div class="glass-card rounded-3xl overflow-hidden mb-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                <!-- Cover Image Section -->
                <div class="bg-gradient-to-br from-slate-100 to-slate-200 p-8 flex items-center justify-center lg:border-r border-white/20">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-fuchsia-500 rounded-lg blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                        <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="relative w-64 h-96 object-cover rounded-lg shadow-2xl transform transition-transform duration-300 group-hover:scale-105">
                    </div>
                </div>

                <!-- Info Section -->
                <div class="lg:col-span-2 p-8 lg:p-12 flex flex-col justify-between">
                    <div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($book->genres as $genre)
                                <span class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">{{ $genre->name }}</span>
                            @endforeach
                        </div>

                        <h1 class="text-4xl font-extrabold text-slate-900 mb-2">{{ $book->title }}</h1>
                        <p class="text-xl text-slate-500 mb-6 font-medium">by <span class="text-slate-800">{{ $book->author }}</span></p>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8 border-y border-slate-100 py-6">
                            <div>
                                <p class="text-xs text-slate-400 uppercase tracking-wider font-bold mb-1">Yayın Tarihi</p>
                                <p class="text-slate-700 font-semibold">{{ $book->release_date }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 uppercase tracking-wider font-bold mb-1">Sayfa</p>
                                <p class="text-slate-700 font-semibold">{{ $book->pages }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 uppercase tracking-wider font-bold mb-1">Dil</p>
                                <p class="text-slate-700 font-semibold">{{ $book->language }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 uppercase tracking-wider font-bold mb-1">Stok</p>
                                <p class="text-slate-700 font-semibold">{{ $book->in_stock }} / <span class="text-slate-400">{{ $book->in_stock }}</span></p>
                            </div>
                        </div>

                        <div class="prose prose-slate max-w-none text-slate-600 mb-8 leading-relaxed">
                            {{ $book->description }}
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 mt-auto">
                        @auth
                            @if($isAdmin || $isLibrarian)
                                <a href="{{ route('books.edit', $book->id) }}" class="inline-flex items-center px-6 py-3 bg-white border border-slate-200 rounded-xl font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Düzenle
                                </a>
                            @endif

                             @if($isReader)
                                <form action="{{ route('books.rentals.store', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-fuchsia-600 border border-transparent rounded-xl font-bold text-white shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:from-indigo-700 hover:to-fuchsia-700 transform hover:-translate-y-0.5 transition-all duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        Ödünç Al
                                    </button>
                                </form>
                            @endif
                        @else
                             <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-slate-900 rounded-xl font-bold text-white shadow-lg hover:bg-slate-800 transition-all duration-200">
                                Giriş Yap ve Ödünç Al
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Review Form -->
            <div class="lg:col-span-1">
                <div class="glass-card rounded-2xl p-6 sticky top-24">
                    <h3 class="text-xl font-bold text-slate-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Yorum Yap
                    </h3>
                    @auth
                        <form action="{{ route('reviews.store', $book->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Puanınız</label>
                                <div class="flex flex-row-reverse justify-end gap-2">
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{$i}}" name="rating" value="{{ $i }}" class="sr-only peer" required>
                                        <label for="star{{$i}}" class="cursor-pointer text-slate-200 peer-checked:text-amber-400 hover:text-amber-300 peer-hover:text-amber-300 transition-colors">
                                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Düşünceleriniz</label>
                                <textarea name="comment" rows="4" class="w-full rounded-xl border-slate-200 bg-white/50 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Bu kitap hakkında ne düşünüyorsunuz?"></textarea>
                            </div>
                            <button type="submit" class="w-full py-3 bg-slate-900 text-white rounded-xl font-bold hover:bg-indigo-600 transition-colors shadow-lg">Yorumu Yayınla</button>
                        </form>
                    @else
                        <div class="text-center py-6 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                            <p class="text-slate-500 mb-3">Yorum yapmak için giriş yapmalısınız.</p>
                            <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">Giriş Yap</a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Reviews List -->
            <div class="lg:col-span-2">
                <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    Okuyucu Yorumları ({{ $book->reviews->count() }})
                </h3>

                <div class="space-y-4">
                    @forelse($book->reviews->sortByDesc('created_at') as $review)
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-100 to-fuchsia-100 flex items-center justify-center text-indigo-600 font-bold border border-white shadow-sm">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-800 text-sm">{{ $review->user->name }}</h4>
                                        <span class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="flex text-amber-400">
                                    @for($i=0; $i<$review->rating; $i++) <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> @endfor
                                </div>
                            </div>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                            <span class="text-4xl grayscale opacity-30">💭</span>
                            <p class="text-slate-500 mt-2 font-medium">Henüz yorum yapılmamış. İlk yorumu sen yap!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
