@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ search: '' }">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-fuchsia-600 to-purple-600">Tür Listesi</h2>
            <p class="text-slate-500 mt-1">Kitap türlerini ve kategorilerini yönetin.</p>
        </div>
        
        <div class="flex gap-4">
            <div class="relative w-full sm:w-64">
                <input type="text" x-model="search" placeholder="Tür ara..." class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-white shadow-sm focus:border-fuchsia-500 focus:ring-fuchsia-500 transition-all">
                <svg class="w-5 h-5 text-slate-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            
            @auth
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
                    <a href="{{ route('genres.create') }}" class="inline-flex items-center px-6 py-3 bg-fuchsia-600 hover:bg-fuchsia-700 text-white font-bold rounded-xl shadow-lg shadow-fuchsia-500/30 transition-all transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Yeni Tür Ekle
                    </a>
                @endif
            @endauth
        </div>
    </div>

    <div class="glass-card rounded-2xl overflow-hidden border border-slate-200/60">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500 font-semibold">
                        <th class="px-6 py-4">#</th>
                        <th class="px-6 py-4">Ad</th>
                        <th class="px-6 py-4">Stil</th>
                        <th class="px-6 py-4 text-right">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($genres as $genre)
                    <tr class="hover:bg-slate-50/80 transition-colors duration-150" x-show="!search || '{{ strtolower($genre->name) }}'.includes(search.toLowerCase())">
                        <td class="px-6 py-4 font-mono text-sm text-slate-500">#{{ $genre->id }}</td>
                        <td class="px-6 py-4 font-bold text-slate-800">{{ $genre->name }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $genre->style }}-100 text-{{ $genre->style }}-800">
                                {{ $genre->style }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('genres.show', $genre->id) }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:text-indigo-600 hover:border-indigo-200 transition-all" title="Kitapları Görüntüle">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                                @auth
                                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
                                        <a href="{{ route('genres.edit', $genre->id) }}" class="p-2 bg-amber-50 border border-amber-200 rounded-lg text-amber-600 hover:bg-amber-100 transition-colors" title="Düzenle">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        
                                        <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu türü silmek istediğinize emin misiniz?');">
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
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                            Tür bulunamadı.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
