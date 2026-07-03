<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username', 'name', 'email', 'password', 'role', 
        'divisi_id', 'managed_divisi_id', 'no_telepon'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function username()
    {
        return 'username';
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }

    // Management menangani divisi tertentu
    public function managedDivisi()
    {
        return $this->belongsTo(Divisi::class, 'managed_divisi_id');
    }

    public function isDivisi()
    {
        return $this->role === 'divisi';
    }

    public function isManagement()
    {
        return $this->role === 'management';
    }

    public function isHrd()
    {
        return $this->role === 'hrd';
    }

    public function pengajuan()
    {
        return $this->hasMany(PengajuanTenagaKerja::class, 'user_id');
    }

    public function approvedPengajuan()
    {
        return $this->hasMany(PengajuanTenagaKerja::class, 'approved_by');
    }

    public function lowongan()
    {
        return $this->hasMany(Lowongan::class, 'hrd_id');
    }

    public function getManagementEmail($divisiId)
    {
        $management = User::where('role', 'management')
            ->where('managed_divisi_id', $divisiId)
            ->first();
    
        return $management->email ?? 'hrd@dagsap.com';
    }
}