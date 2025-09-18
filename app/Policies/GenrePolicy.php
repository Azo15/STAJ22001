<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class GenrePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->role === 'admin') {
            return true;  // Tüm yetkileri admin'e ver
        }
    }
    
    /**
     * Kullanıcının tüm modelleri görüntüleyip görüntüleyemeyeceğini belirle.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Kullanıcının belirli bir modeli görüntüleyip görüntüleyemeyeceğini belirle.
     */
    public function view(User $user, Genre $genre): bool
    {
        return true;
    }

    /**
     * Kullanıcının yeni model oluşturup oluşturamayacağını belirle.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'librarian']);
    }

    /**
     * Kullanıcının modeli güncelleyip güncelleyemeyeceğini belirle.
     */
    public function update(User $user, Genre $genre): bool
    {
        return in_array($user->role, ['admin', 'librarian']);
    }

    /**
     * Kullanıcının modeli silip silemeyeceğini belirle.
     */
    public function delete(User $user, Genre $genre): bool
    {
        return in_array($user->role, ['admin', 'librarian']);
    }

    /**
     * Kullanıcının modeli geri yükleyip yükleyemeyeceğini belirle.
     */
    public function restore(User $user, Genre $genre): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Kullanıcının modeli kalıcı olarak silip silemeyeceğini belirle.
     */
    public function forceDelete(User $user, Genre $genre): bool
    {
        return $user->role === 'admin';
    }
}
