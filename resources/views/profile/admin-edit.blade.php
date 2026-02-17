@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100 relative">
        <!-- Decorative Gradient Top -->
        <div class="h-2 bg-gradient-to-r from-blue-500 via-indigo-500 to-violet-500"></div>

        <div class="p-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-800">Kullanıcı Düzenle</h2>
                <p class="text-slate-500 mt-1">{{ $user->name }} kullanıcısının bilgilerini ve rolünü güncelleyin.</p>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Ad Soyad</label>
                        <input type="text" name="name" id="name" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none" value="{{ old('name', $user->name) }}" required>
                        @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">E-posta Adresi</label>
                        <input type="email" name="email" id="email" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none" value="{{ old('email', $user->email) }}" required>
                        @error('email') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Role -->
                    <div class="md:col-span-2">
                        <label for="role" class="block text-sm font-semibold text-slate-700 mb-2">Kullanıcı Rolü</label>
                        <div class="relative">
                            <select name="role" id="role" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none appearance-none bg-white">
                                <option value="reader" {{ old('role', $user->role) === 'reader' ? 'selected' : '' }}>Okuyucu (Reader)</option>
                                <option value="librarian" {{ old('role', $user->role) === 'librarian' ? 'selected' : '' }}>Kütüphaneci (Librarian)</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Yönetici (Admin)</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('role') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end space-x-4">
                     <a href="{{ url()->previous() }}" class="px-6 py-3 rounded-xl text-slate-600 font-bold hover:bg-slate-50 transition-colors">
                        İptal Et
                    </a>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:scale-105 transition-all transform flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Değişiklikleri Kaydet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
