<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    /**
     * Gelen isteği işle.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  Rotaya erişim için gerekli rol
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // if (Auth::check()) {
        //     foreach ($roles as $role) {
        //         // Kullanıcının rollerden birine sahip olması durumunda isteğe izin ver
        //         if (Auth::user()->role === $role) {
        //             return $next($request);
        //         }
        //     }
        // }
        
        // Kullanıcı kimlik doğrulaması yapılmamışsa veya gerekli rollere sahip değilse yönlendir
        // return redirect('/books');
        // return redirect('auth.login');

        // Eğer rol belirtilmemişse veya kullanıcı misafir ise isteği devam ettir
        if (empty($roles) || !Auth::check()) {
            return $next($request);
        }

        // Kullanıcının gerekli rollerden hiçbirine sahip olmaması durumunda yönlendir
        // Uygulamanızın gereksinimlerine göre farklı bir rotaya yönlendirebilir veya hata sayfası gösterebilirsiniz.
        // Örneğin, '403 Yasak' sayfasına ya da yetkiniz yok açıklaması olan bir sayfaya yönlendirme yapılabilir.
        if (!in_array(Auth::user()->role, $roles)) {
            return redirect('/forbidden');
        }

        // Kullanıcı kimliği doğrulanmış ve gerekli rollerden birine sahip, isteğe devam et
        return $next($request);
    }
}
