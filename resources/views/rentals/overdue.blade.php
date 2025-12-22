@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-rose-600">Geciken Ödünç Almalar</h2>
            <p class="text-slate-500 mt-1">Teslim tarihi geçmiş kitapların listesi.</p>
        </div>
        <form action="{{ route('rentals.markoverdue') }}" method="POST">
            @csrf
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg shadow-red-500/30 transition-all transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Gecikenleri Kontrol Et ve İşaretle
            </button>
        </form>
    </div>

    <div class="glass-card rounded-2xl overflow-hidden border border-slate-200/60">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500 font-semibold">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Kitap</th>
                        <th class="px-6 py-4">Kullanıcı</th>
                        <th class="px-6 py-4">Başlangıç Tarihi</th>
                        <th class="px-6 py-4">Teslim Tarihi</th>
                        <th class="px-6 py-4 text-right">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($rentals as $rental)
                    <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                        <td class="px-6 py-4 font-mono text-sm text-slate-500">#{{ $rental->id }}</td>
                        <td class="px-6 py-4 font-bold text-slate-800">{{ $rental->book->title }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-100 to-fuchsia-100 flex items-center justify-center text-xs font-bold text-indigo-600">
                                    {{ substr($rental->user->name, 0, 1) }}
                                </div>
                                <span class="text-slate-700 font-medium">{{ $rental->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ $rental->rental_start_at }}
                        </td>
                        <td class="px-6 py-4 text-sm text-red-600 font-bold">
                            {{ $rental->rental_due_at }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('books.rentals.edit', ['book' => $rental->book->id, 'rental' => $rental->id]) }}" method="GET">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-lg shadow-md shadow-amber-500/20 transition-all transform hover:-translate-y-0.5">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Düzenle
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                <p>Geciken ödünç alma işlemi bulunmamaktadır.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
