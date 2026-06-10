<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanTenagaKerja extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_tenaga_kerjas';

    protected $fillable = [
        'divisi_id', 
        'departemen_dipilih', 
        'user_id', 
        'nama_pemohon', 
        'nip_pemohon', 
        'jabatan_pemohon', 
        'no_hp_pemohon',
        'diajukan_oleh', 
        'disetujui_oleh',
        'jenis', 
        'posisi', 
        'jumlah', 
        'tanggal_dibutuhkan',
        'kriteria', 
        'persyaratan', 
        'deskripsi_pekerjaan', 
        'tugas',
        'status', 
        'alasan_penolakan', 
        'disetujui_oleh',
        'jabatan_penyetuju',
        'approved_by', 
        'approved_at'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'kriteria' => 'array',
        'persyaratan' => 'array',
        'tugas' => 'array',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }

    public function departemen()
    {
        return $this->belongsTo(Divisi::class, 'departemen_dipilih');
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