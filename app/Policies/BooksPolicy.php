<?php

namespace App\Policies;

use App\Models\Books;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class BooksPolicy
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
    public function view(User $user, Books $books): bool
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
    public function update(User $user, Books $books): bool
    {
        return in_array($user->role, ['admin', 'librarian']);
    }

    /**
     * Kullanıcının modeli silip silemeyeceğini belirle.
     */
    public function delete(User $user, Books $books): bool
    {
        return in_array($user->role, ['admin', 'librarian']);
    }

    /**
     * Kullanıcının modeli geri yükleyip yükleyemeyeceğini belirle.
     */
    public function restore(User $user, Books $books): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Kullanıcının modeli kalıcı olarak silip silemeyeceğini belirle.
     */
    public function forceDelete(User $user, Books $books): bool
    {
        return $user->role === 'admin';
    }
}
