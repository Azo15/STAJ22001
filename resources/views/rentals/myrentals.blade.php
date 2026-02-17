@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-teal-600 to-emerald-600">Ödünç Aldıklarım</h2>
            <p class="text-slate-500 mt-1">Kitap kiralama geçmişinizi ve aktif kiralamalarınızı buradan takip edin.</p>
        </div>
    </div>

    <div class="glass-card rounded-2xl overflow-hidden border border-slate-200/60">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500 font-semibold">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Kitap</th>
                        <th class="px-6 py-4">Durum</th>
                        <th class="px-6 py-4">Talep Tarihi</th>
                        <th class="px-6 py-4">Başlangıç</th>
                        <th class="px-6 py-4">Son Teslim</th>
                        <th class="px-6 py-4">İade</th>
                        <th class="px-6 py-4 text-center">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($rentals as $rental)
                    <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                        <td class="px-6 py-4 font-mono text-sm text-slate-500">#{{ $rental->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800">{{ $rental->book->title }}</span>
                                <span class="text-xs text-slate-500">{{ $rental->book->author }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusClasses = [
                                    'Pending Review' => 'bg-amber-100 text-amber-800',
                                    'Approved' => 'bg-teal-100 text-teal-800',
                                    'Returned' => 'bg-emerald-100 text-emerald-800',
                                    'Overdue' => 'bg-rose-100 text-rose-800',
                                    'Cancelled' => 'bg-slate-100 text-slate-800',
                                ];
                                $statusClass = $statusClasses[$rental->status] ?? 'bg-gray-100 text-gray-800';
                                
                                $statusLabels = [
                                    'Pending Review' => 'İncelemede',
                                    'Approved' => 'Onaylandı',
                                    'Returned' => 'İade Edildi',
                                    'Overdue' => 'Gecikmiş',
                                    'Cancelled' => 'İptal Edildi',
                                ];
                                $statusLabel = $statusLabels[$rental->status] ?? $rental->status;
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $rental->rental_requested_at }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $rental->rental_start_at ? \Carbon\Carbon::parse($rental->rental_start_at)->format('d.m.Y H:i') : '-' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $rental->rental_due_at ? \Carbon\Carbon::parse($rental->rental_due_at)->format('d.m.Y H:i') : '-' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            @if($rental->returned_at)
                                <span class="text-emerald-600 font-medium">{{ \Carbon\Carbon::parse($rental->returned_at)->format('d.m.Y H:i') }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($rental->status == 'Approved' || $rental->status == 'Overdue')
                                <form action="{{ route('rentals.return', $rental->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 text-xs font-bold rounded-lg transition-colors border border-amber-200 shadow-sm">
                                        Kitabı İade Et
                                    </button>
                                </form>
                            @elseif($rental->status == 'Pending Review')
                                <form action="{{ route('rentals.cancelrequest', $rental->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold rounded-lg transition-colors border border-rose-200 shadow-sm">
                                        Talebi İptal Et
                                    </button>
                                </form>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-500">
                                    İşlem Yok
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                         <td colspan="8" class="px-6 py-12 text-center text-slate-500">
                            Henüz bir ödünç alma işleminiz bulunmuyor. <a href="/books" class="text-indigo-600 hover:underline">Hemen kitaplara göz atın!</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
