<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanTenagaKerja extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_tenaga_kerjas';

    protected $fillable = [
        'divisi_id', 'user_id', 'jenis', 'posisi', 'jumlah', 
        'kriteria', 'persyaratan', 'deskripsi_pekerjaan', 
        'status', 'alasan_penolakan', 'approved_by', 'approved_at'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'kriteria' => 'array',
        'persyaratan' => 'array',
        'tugas' => 'array',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function lowongan()
    {
        return $this->hasOne(Lowongan::class, 'pengajuan_id');
    }
}