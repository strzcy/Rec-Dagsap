<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pelamar;

class PelamarPolicy
{
    public function view(User $user, Pelamar $pelamar): bool
    {
        return $pelamar->lowongan->hrd_id === $user->id;
    }

    public function downloadCv(User $user, Pelamar $pelamar): bool
    {
        return $pelamar->lowongan->hrd_id === $user->id;
    }

    public function downloadIjazah(User $user, Pelamar $pelamar): bool
    {
        return $pelamar->lowongan->hrd_id === $user->id;
    }

    public function print(User $user, Pelamar $pelamar): bool
    {
        return $pelamar->lowongan->hrd_id === $user->id;
    }

    public function updateStatus(User $user, Pelamar $pelamar): bool
    {
        return $pelamar->lowongan->hrd_id === $user->id;
    }
}
