<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pelamar extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'lowongan_id', 'nama_lengkap', 'email', 'no_telepon', 
        'tempat_lahir', 'tanggal_lahir', 'alamat', 'pendidikan_terakhir',
        'jurusan', 'tahun_lulus', 'pengalaman_kerja', 'cv_path', 
        'ijazah_path', 'status', 'catatan', 'psikotest_link', 
        'psikotest_dikirim_at', 'psikotest_selesai_at'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'psikotest_dikirim_at' => 'datetime',
        'psikotest_selesai_at' => 'datetime',
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }

    public function formulirJawaban()
    {
        return $this->hasMany(FormulirJawaban::class);
    }

    // Cek kelulusan berdasarkan kriteria
    public function cekKelulusan()
    {
        $lowongan = $this->lowongan;
        $pengajuan = $lowongan->pengajuan;
        
        // Parse kriteria dan persyaratan (bisa disimpan sebagai JSON)
        $kriteria = json_decode($pengajuan->kriteria, true) ?? [];
        
        // Logika pengecekan kelulusan
        // Contoh sederhana:
        $lolos = true;
        
        // Cek pendidikan
        if (isset($kriteria['pendidikan_minimal'])) {
            $tingkat_pendidikan = ['sd' => 1, 'smp' => 2, 'sma' => 3, 'd3' => 4, 's1' => 5, 's2' => 6];
            $pendidikan_pelamar = $tingkat_pendidikan[strtolower($this->pendidikan_terakhir)] ?? 0;
            $pendidikan_required = $tingkat_pendidikan[strtolower($kriteria['pendidikan_minimal'])] ?? 0;
            
            if ($pendidikan_pelamar < $pendidikan_required) {
                $lolos = false;
            }
        }
        
        // Cek pengalaman
        if (isset($kriteria['pengalaman_minimal']) && $kriteria['pengalaman_minimal'] > 0) {
            // Parse pengalaman kerja (contoh: "3 tahun di PT XYZ")
            // Implementasi sesuai kebutuhan
        }
        
        return $lolos;
    }
}