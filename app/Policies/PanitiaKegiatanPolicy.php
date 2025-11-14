<?php

namespace App\Policies;

use App\Models\{PanitiaKegiatan, User};

class PanitiaKegiatanPolicy
{
    public function update(User $user, PanitiaKegiatan $pk): bool
    {
        return $user->role === 'PANITIA' && $pk->user_id === $user->id;
    }
}
