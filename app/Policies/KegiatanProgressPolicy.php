<?php

namespace App\Policies;

use App\Models\{Kegiatan, KegiatanProgress, User};

class KegiatanProgressPolicy
{
    // Admin atau panitia yang terdaftar di kegiatan boleh menambah
    public function create(User $user, Kegiatan $kegiatan): bool
    {
        if ($user->role === 'ADMIN') return true;
        return $kegiatan->panitia()->where('user_id', $user->id)->exists();
    }

    // Update/Delete: admin atau pembuat progres
    public function update(User $user, KegiatanProgress $progress): bool
    {
        return $user->role === 'ADMIN' || $progress->user_id === $user->id;
    }
    public function delete(User $user, KegiatanProgress $progress): bool
    {
        return $user->role === 'ADMIN' || $progress->user_id === $user->id;
    }
}
