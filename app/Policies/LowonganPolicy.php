<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lowongan;

class LowonganPolicy
{
    public function view(User $user, Lowongan $lowongan): bool
    {
        return $lowongan->hrd_id === $user->id;
    }

    public function update(User $user, Lowongan $lowongan): bool
    {
        return $lowongan->hrd_id === $user->id;
    }

    public function delete(User $user, Lowongan $lowongan): bool
    {
        return $lowongan->hrd_id === $user->id;
    }

    public function print(User $user, Lowongan $lowongan): bool
    {
        return $lowongan->hrd_id === $user->id;
    }
}
