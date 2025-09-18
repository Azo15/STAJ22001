<?php

namespace App\Policies;

use App\Models\Rental;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RentalPolicy
{
    /**
     * Kullanıcının tüm modelleri görüntüleyip görüntüleyemeyeceğini belirle.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Kullanıcının belirli bir modeli görüntüleyip görüntüleyemeyeceğini belirle.
     */
    public function view(User $user, Rental $rental): bool
    {
        //
    }

    /**
     * Kullanıcının yeni model oluşturup oluşturamayacağını belirle.
     */
    public function create(User $user): bool
    {
        return $user->role === 'reader';
    }

    /**
     * Kullanıcının modeli güncelleyip güncelleyemeyeceğini belirle.
     */
    public function update(User $user, Rental $rental): bool
    {
        return in_array($user->role, ['admin', 'librarian']);
    }

    /**
     * Kullanıcının modeli silip silemeyeceğini belirle.
     */
    public function delete(User $user, Rental $rental): bool
    {
        //
    }

    /**
     * Kullanıcının modeli geri yükleyip yükleyemeyeceğini belirle.
     */
    public function restore(User $user, Rental $rental): bool
    {
        //
    }

    /**
     * Kullanıcının modeli kalıcı olarak silip silemeyeceğini belirle.
     */
    public function forceDelete(User $user, Rental $rental): bool
    {
        //
    }

    /**
     * Kullanıcının Ödünç Alma işlemlerini yönetip yönetemeyeceğini belirle.
     */
    public function manage(User $user, Rental $rental): bool
    {
        return in_array($user->role, ['admin', 'librarian']);
    }
}
