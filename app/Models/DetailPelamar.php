<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPelamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelamar_id',
        'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
        'tinggi_badan', 'berat_badan', 'kewarganegaraan', 'agama', 'golongan_darah',
        'alamat_tinggal', 'rt_rw_tinggal', 'kelurahan_tinggal', 'kecamatan_tinggal',
        'kabupaten_tinggal', 'kota_tinggal', 'provinsi_tinggal', 'kode_pos_tinggal',
        'no_telp', 'no_hp', 'no_wa', 'alamat_ktp', 'rt_rw_ktp', 'kelurahan_ktp',
        'kecamatan_ktp', 'kabupaten_ktp', 'kota_ktp', 'provinsi_ktp', 'kode_pos_ktp',
        'no_ktp', 'no_npwp', 'no_bpjs_ketenagakerjaan', 'no_bpjs_kesehatan',
        'status_perkawinan', 'email', 'hobby', 'organisasi',
        'pendidikan_formal', 'pelatihan', 'keterampilan', 'bahasa_asing',
        'kekuatan_kelemahan', 'pengalaman_kerja', 'bidang_minat',
        'referensi', 'punya_saudara_di_perusahaan', 'saudara_di_perusahaan',
        'pernah_sakit_berat', 'sakit_berat_keterangan', 'punya_penyakit_keturunan',
        'penyakit_keturunan_keterangan', 'pakai_kacamata', 'ukuran_kacamata',
        'punya_alergi', 'alergi_keterangan',
        'data_pasangan', 'data_anak', 'riwayat_penyakit_keluarga',
        'data_orang_tua', 'kontak_darurat', 'saudara_kandung',
        'gaji_diharapkan', 'waktu_bergabung',
        'pernyataan_setuju', 'tempat_pernyataan', 'tanggal_pernyataan'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_pernyataan' => 'date',
        'pendidikan_formal' => 'array',
        'pelatihan' => 'array',
        'keterampilan' => 'array',
        'bahasa_asing' => 'array',
        'kekuatan_kelemahan' => 'array',
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