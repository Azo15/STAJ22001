@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-amber-600 to-orange-600">Bekleyen Talepler</h2>
            <p class="text-slate-500 mt-1">Onay bekleyen ödünç alma taleplerini buradan yönetebilirsiniz.</p>
        </div>
    </div>

    <div class="glass-card rounded-2xl overflow-hidden border border-slate-200/60">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500 font-semibold">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Kitap</th>
                        <th class="px-6 py-4">Kullanıcı</th>
                        <th class="px-6 py-4">Talep Tarihi</th>
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
                            {{ $rental->rental_requested_at }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <form action="{{ route('rentals.approve', $rental->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-lg shadow-md shadow-emerald-500/20 transition-all transform hover:-translate-y-0.5" title="Onayla">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Onayla
                                    </button>
                                </form>
                                <form action="{{ route('rentals.reject', $rental->id) }}" method="POST" onsubmit="return confirm('Bu talebi reddetmek istediğinize emin misiniz?');">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-bold rounded-lg shadow-md shadow-rose-500/20 transition-all transform hover:-translate-y-0.5" title="Reddet">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Reddet
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                <p>Bekleyen talep bulunmamaktadır.</p>
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
