<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPelamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelamar_id',
        // A
        'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
        'tinggi_badan', 'berat_badan', 'kewarganegaraan', 'agama', 'golongan_darah',
        'alamat_tinggal', 'rt_rw_tinggal', 'kelurahan_tinggal', 'kecamatan_tinggal',
        'kabupaten_tinggal', 'kota_tinggal', 'provinsi_tinggal', 'kode_pos_tinggal',
        'no_telp', 'no_hp', 'no_wa', 'alamat_ktp', 'rt_rw_ktp', 'kelurahan_ktp',
        'kecamatan_ktp', 'kabupaten_ktp', 'kota_ktp', 'provinsi_ktp', 'kode_pos_ktp',
        'no_ktp', 'no_npwp', 'no_bpjs_ketenagakerjaan', 'status_perkawinan', 'email', 'hobby', 'organisasi',
        // B
        'pendidikan_formal', 'pelatihan',
        // C
        'keterampilan',
        // D
        'bahasa_asing',
        // E
        'kekuatan', 'kelemahan',
        // F
        'pengalaman_kerja', 'bidang_minat',
        // G
        'referensi', 'punya_saudara_di_perusahaan', 'saudara_di_perusahaan',
        // H
        'pernah_sakit_berat', 'sakit_berat_keterangan', 'punya_penyakit_keturunan',
        'penyakit_keturunan_keterangan', 'pakai_kacamata', 'ukuran_kacamata', 'punya_alergi', 'alergi_keterangan',
        // I
        'punya_pasangan', 'data_pasangan', 'punya_anak', 'data_anak',
        'riwayat_penyakit_keluarga', 'data_orang_tua', 'kontak_darurat', 'saudara_kandung',
        // J
        'gaji_diharapkan',
        // K
        'waktu_bergabung',
        // L
        'pernyataan_setuju', 'tempat_pernyataan', 'tanggal_pernyataan'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_pernyataan' => 'date',
        'pendidikan_formal' => 'array',
        'pelatihan' => 'array',
        'keterampilan' => 'array',
        'bahasa_asing' => 'array',
        'pengalaman_kerja' => 'array',
        'bidang_minat' => 'array',
        'referensi' => 'array',
        'saudara_di_perusahaan' => 'array',
        'data_pasangan' => 'array',
        'data_anak' => 'array',
        'riwayat_penyakit_keluarga' => 'array',
        'data_orang_tua' => 'array',
        'kontak_darurat' => 'array',
        'saudara_kandung' => 'array',
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class);
    }
}