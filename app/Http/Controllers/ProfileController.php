<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Rental;
use App\Models\Books;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    /**
     * Kullanıcının profil formunu görüntüle.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Kullanıcının profil bilgilerini güncelle.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Kullanıcının hesabını sil.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function showReaders()
    {
        $users = User::where('role', 'reader')->get();

        return view('profile.readerlist', compact('users'));
    }

    public function showLibrarians()
    {
        $users = User::where('role', 'librarian')->get();

        return view('profile.librarianlist', compact('users'));
    }

    public function changeLibrarianToReader(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'role' => 'reader',
        ]);

        return back()->with('success', 'Librarian role removed.');
    }

    public function changeReaderToLibrarian(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'role' => 'librarian',
        ]);

        return back()->with('success', 'Librarian role added.');
    }

    /**
     * Admin: Kullanıcı düzenleme formunu göster.
     */
    public function adminEdit(User $user)
    {
        return view('profile.admin-edit', compact('user'));
    }

    /**
     * Admin: Kullanıcı bilgilerini güncelle.
     */
    public function adminUpdate(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'string', 'in:admin,librarian,reader'],
        ]);

        $user->update($validated);

        // Eğer kullanıcı okuyucu ise okuyucu listesine, kütüphaneci ise kütüphaneci listesine yönlendir.
        // Basitçe geldiği listeye göre veya role göre yönlendirme yapabiliriz.
        if ($user->role === 'librarian') {
            return redirect()->route('librarians.showlibrarians')->with('success', 'Kullanıcı başarıyla güncellendi.');
        } else {
            return redirect()->route('readers.showreaders')->with('success', 'Kullanıcı başarıyla güncellendi.');
        }
    }

    /**
     * Admin: Kullanıcıyı sil.
     */
    public function adminDestroy(User $user)
    {
        // Kendini silmeyi engelle
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Kendi hesabınızı buradan silemezsiniz.');
        }

        $user->delete();

        return back()->with('success', 'Kullanıcı başarıyla silindi.');
    }
}
