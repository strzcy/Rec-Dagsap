<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PengajuanTenagaKerja;

class PengajuanTenagaKerjaPolicy
{
    public function view(User $user, PengajuanTenagaKerja $pengajuan): bool
    {
        $nik = session('verified_nik');
        return $pengajuan->nip_pemohon == $nik;
    }
}
