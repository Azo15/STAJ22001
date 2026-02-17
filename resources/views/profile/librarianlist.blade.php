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
                            <div class="flex items-center justify-center gap-2">
                                <!-- Edit Button -->
                                <a href="{{ route('users.edit', $user->id) }}" class="p-2 bg-amber-50 border border-amber-200 rounded-lg text-amber-600 hover:bg-amber-100 transition-colors" title="Düzenle">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>

                                <!-- Demote (Remove Librarian Role) Button -->
                                <form action="{{ route('librarians.deletelibrarian', $user->id) }}" method="POST" onsubmit="return confirm('Bu kullanıcının kütüphaneci yetkisini almak istediğinize emin misiniz?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="p-2 bg-orange-50 hover:bg-orange-100 text-orange-700 font-bold rounded-lg transition-colors border border-orange-200" title="Kütüphaneci Yetkisini Al">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>

                                <!-- Permanent Delete Button -->
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bu kullanıcıyı kalıcı olarak silmek istediğinize emin misiniz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 border border-red-200 rounded-lg text-red-600 hover:bg-red-100 transition-colors" title="Kalıcı Olarak Sil">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6"></path></svg>
                                    </button>
                                </form>
                            </div>
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
