<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id', 'hrd_id', 'judul', 'banner_image', 
        'deskripsi', 'tanggal_mulai', 'tanggal_selesai', 'status'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanTenagaKerja::class);
    }

    public function hrd()
    {
        return $this->belongsTo(User::class, 'hrd_id');
    }

    public function pelamars()
    {
        return $this->hasMany(Pelamar::class);
    }
}