<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Şifre sıfırlama bağlantısı isteği ekranını görüntüle.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Gelen şifre sıfırlama bağlantısı isteğini işle.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Bu kullanıcıya şifre sıfırlama bağlantısını göndereceğiz. Bağlantıyı göndermeyi
        // denedikten sonra yanıtı inceleyip kullanıcıya gösterilecek mesajı belirleyeceğiz.
        // Son olarak uygun bir yanıt göndereceğiz.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
