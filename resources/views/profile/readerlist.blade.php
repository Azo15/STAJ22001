@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">Okuyucu Listesi</h2>
            <p class="text-slate-500 mt-1">Sistemdeki kayıtlı okuyucuları buradan yönetebilirsiniz.</p>
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
                        @auth
                            @if(auth()->user()->role === 'admin')
                            <th class="px-6 py-4 text-center">Yönetici İşlemleri</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                        <td class="px-6 py-4 font-mono text-sm text-slate-500">#{{ $user->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-100 to-violet-100 flex items-center justify-center text-xs font-bold text-indigo-600 uppercase">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <span class="font-bold text-slate-800">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $user->created_at }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('readers.rentals', $user->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 hover:border-indigo-200 transition-all shadow-sm group">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                Ödünç Almaları Görüntüle
                            </a>
                        </td>
                            @auth
                            @if(auth()->user()->role === 'admin')
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('users.edit', $user->id) }}" class="p-2 bg-amber-50 border border-amber-200 rounded-lg text-amber-600 hover:bg-amber-100 transition-colors" title="Düzenle">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>

                                    <!-- Promote Button -->
                                    <form action="{{ route('readers.promotelibrarian', $user->id) }}" method="POST" onsubmit="return confirm('Bu kullanıcıyı Kütüphaneci yapmak istediğinize emin misiniz?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="p-2 bg-indigo-50 border border-indigo-200 rounded-lg text-indigo-600 hover:bg-indigo-100 transition-colors" title="Kütüphaneci Yap">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bu kullanıcıyı kalıcı olarak silmek istediğinize emin misiniz?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 border border-red-200 rounded-lg text-red-600 hover:bg-red-100 transition-colors" title="Kalıcı Olarak Sil">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                            @endauth
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                            Okuyucu bulunamadı.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
