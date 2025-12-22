@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-orange-600">Kütüphaneci Listesi</h2>
            <p class="text-slate-500 mt-1">Sistemdeki yetkili kütüphanecileri buradan yönetebilirsiniz.</p>
        </div>
    </div>

    <div class="glass-card rounded-2xl overflow-hidden border border-slate-200/60">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500 font-semibold">
                        <th class="px-6 py-4">Kullanıcı ID</th>
                        <th class="px-6 py-4">Ad Soyad</th>
                        <th class="px-6 py-4">E-posta</th>
                        <th class="px-6 py-4">Profil Oluşturma Tarihi</th>
                        <th class="px-6 py-4 text-center">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                        <td class="px-6 py-4 font-mono text-sm text-slate-500">#{{ $user->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-100 to-red-100 flex items-center justify-center text-xs font-bold text-orange-600 uppercase">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <span class="font-bold text-slate-800">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $user->created_at }}</td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('librarians.deletelibrarian', $user->id) }}" method="POST" onsubmit="return confirm('Bu kullanıcının kütüphaneci yetkisini almak istediğinize emin misiniz?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 text-sm font-bold rounded-lg transition-colors border border-red-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Kütüphaneciyi Sil
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                            Kütüphaneci bulunamadı.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
