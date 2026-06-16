<?php

namespace Database\Factories;

use App\Models\DetailPelamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DetailPelamar>
 */
class DetailPelamarFactory extends Factory
{
    protected $model = DetailPelamar::class;

    public function definition(): array
    {
        $jenisKelamin = fake()->randomElement(['L', 'P']);
        $namaLengkap = fake('id_ID')->name($jenisKelamin == 'L' ? 'male' : 'female');
        $statusPerkawinan = fake()->randomElement(['Lajang', 'Nikah', 'Bercerai']);
        $email = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $namaLengkap)) . fake()->numberBetween(10, 99) . '@example.com';

        $punyaPasangan = ($statusPerkawinan === 'Nikah');
        $dataPasangan = null;
        if ($punyaPasangan) {
            $dataPasangan = [
                'nama_lengkap' => fake('id_ID')->name($jenisKelamin == 'L' ? 'female' : 'male'),
                'tempat_lahir' => fake('id_ID')->city(),
                'tanggal_lahir' => fake()->dateTimeBetween('-35 years', '-20 years')->format('Y-m-d'),
                'tanggal_menikah' => fake()->dateTimeBetween('-5 years', '-1 years')->format('Y-m-d'),
                'agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
                'alamat' => fake('id_ID')->address(),
                'pendidikan' => fake()->randomElement(['SMA/SMK', 'D3', 'S1']),
                'pekerjaan' => fake()->jobTitle(),
                'jabatan' => 'Staff',
            ];
        }

        $punyaAnak = $punyaPasangan && fake()->boolean();
        $dataAnak = [];
        if ($punyaAnak) {
            $jumlahAnak = fake()->numberBetween(1, 2);
            for ($i = 0; $i < $jumlahAnak; $i++) {
                $dataAnak[] = [
                    'nama' => fake('id_ID')->name(),
                    'jenis_kelamin' => fake()->randomElement(['L', 'P']),
                    'tempat_lahir' => fake('id_ID')->city(),
                    'tanggal_lahir' => fake()->dateTimeBetween('-5 years', '-1 years')->format('Y-m-d'),
                    'pendidikan' => 'Belum Sekolah',
                ];
            }
        }

        $dataOrangTua = [
            'ayah_nama' => fake('id_ID')->name('male'),
            'ayah_agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
            'ayah_usia' => (string)fake()->numberBetween(50, 70),
            'ayah_pekerjaan' => fake()->jobTitle(),
            'ayah_alamat' => fake('id_ID')->address(),
            'ibu_nama' => fake('id_ID')->name('female'),
            'ibu_agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
            'ibu_usia' => (string)fake()->numberBetween(45, 65),
            'ibu_pekerjaan' => 'Ibu Rumah Tangga',
            'ibu_alamat' => fake('id_ID')->address(),
        ];

        $kontakDarurat = [
            'nama' => fake('id_ID')->name(),
            'hubungan' => fake()->randomElement(['Kakak', 'Paman', 'Bibi', 'Saudara']),
            'alamat' => fake('id_ID')->address(),
            'no_telp' => '6221' . fake()->numberBetween(1111111, 9999999),
            'no_hp' => '628' . fake()->numberBetween(111111111, 999999999),
            'pekerjaan' => fake()->jobTitle(),
            'jabatan' => 'Staff',
        ];

        $pendidikanFormal = [
            [
                'tingkat' => 'SMA/SMK',
                'nama_sekolah' => 'SMK Negeri 1 Jakarta',
                'kota' => 'Jakarta',
                'jurusan' => 'Administrasi Perkantoran',
                'tahun_lulus' => '2019',
                'ipk' => '82.5',
            ]
        ];

        $pelatihan = [
            [
                'nama' => 'Pelatihan Customer Service Excellence',
                'lembaga' => 'LPK Jakarta',
                'tgl_selesai' => '2020-05-10',
                'sertifikat' => 'Ada',
            ]
        ];

        $keterampilan = [
            [
                'nama' => 'Microsoft Office',
                'tingkat' => 'Sangat Mahir',
            ],
            [
                'nama' => 'Komunikasi Interpersonal',
                'tingkat' => 'Mahir',
            ]
        ];

        $bahasaAsing = [
            [
                'nama' => 'Inggris',
                'membaca' => 'Cukup',
                'berbicara' => 'Cukup',
                'menulis' => 'Cukup',
            ]
        ];

        $pengalamanKerja = [
            [
                'perusahaan' => 'PT Trans Retail Indonesia',
                'jabatan' => 'Customer Service',
                'tgl_masuk' => '2020-06-01',
                'tgl_keluar' => '2022-06-01',
                'gaji' => 'Rp 4.500.000',
                'alasan_keluar' => 'Habis masa kontrak kerja.',
            ]
        ];

        $referensi = [
            [
                'nama' => fake('id_ID')->name(),
                'alamat' => fake('id_ID')->address(),
                'telp' => '628' . fake()->numberBetween(111111111, 999999999),
                'hubungan' => 'Mantan Supervisor',
                'lama_kenal' => '2 Tahun',
            ]
        ];

        $saudaraKandung = [
            [
                'nama' => fake('id_ID')->name(),
                'jenis_kelamin' => fake()->randomElement(['L', 'P']),
                'usia' => (string)fake()->numberBetween(20, 30),
                'pendidikan' => 'S1',
                'pekerjaan' => fake()->jobTitle(),
                'hubungan' => 'Adik',
            ]
        ];

        $tempat = fake('id_ID')->city();

        return [
            'pelamar_id' => \App\Models\Pelamar::factory()->lolosTahap1(),
            'nama_lengkap' => $namaLengkap,
            'jenis_kelamin' => $jenisKelamin,
            'tempat_lahir' => fake('id_ID')->city(),
            'tanggal_lahir' => fake()->dateTimeBetween('-35 years', '-20 years')->format('Y-m-d'),
            'tinggi_badan' => (string)fake()->numberBetween(155, 185),
            'berat_badan' => (string)fake()->numberBetween(45, 90),
            'kewarganegaraan' => 'Indonesia',
            'agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
            'golongan_darah' => fake()->randomElement(['A', 'B', 'AB', 'O']),
            'alamat_tinggal' => fake('id_ID')->address(),
            'rt_rw_tinggal' => sprintf('0%d/0%d', fake()->numberBetween(1, 9), fake()->numberBetween(1, 9)),
            'kelurahan_tinggal' => 'Menteng',
            'kecamatan_tinggal' => 'Menteng',
            'kabupaten_tinggal' => 'Jakarta Pusat',
            'kota_tinggal' => 'Jakarta',
            'provinsi_tinggal' => 'DKI Jakarta',
            'kode_pos_tinggal' => (string)fake()->numberBetween(10000, 99999),
            'no_telp' => null,
            'no_hp' => '628' . fake()->numberBetween(111111111, 999999999),
            'no_wa' => '628' . fake()->numberBetween(111111111, 999999999),
            'alamat_ktp' => fake('id_ID')->address(),
            'rt_rw_ktp' => sprintf('0%d/0%d', fake()->numberBetween(1, 9), fake()->numberBetween(1, 9)),
            'kelurahan_ktp' => 'Menteng',
            'kecamatan_ktp' => 'Menteng',
            'kabupaten_ktp' => 'Jakarta Pusat',
            'kota_ktp' => 'Jakarta',
            'provinsi_ktp' => 'DKI Jakarta',
            'kode_pos_ktp' => (string)fake()->numberBetween(10000, 99999),
            'no_ktp' => '31710' . fake()->numberBetween(10000000000, 99999999999),
            'no_npwp' => '09' . fake()->numberBetween(1000000000000, 9999999999999),
            'no_bpjs_ketenagakerjaan' => '190' . fake()->numberBetween(10000000, 99999999),
            'status_perkawinan' => $statusPerkawinan,
            'email' => $email,
            'hobby' => fake()->randomElement(['Membaca', 'Olahraga', 'Musik', 'Travelling']),
            'organisasi' => 'Ketua Himpunan Mahasiswa Jurusan (2018-2019)',
            'pendidikan_formal' => $pendidikanFormal,
            'pelatihan' => $pelatihan,
            'keterampilan' => $keterampilan,
            'bahasa_asing' => $bahasaAsing,
            'kekuatan' => 'Disiplin tinggi, mampu bekerja dalam tim, memiliki orientasi detail.',
            'kelemahan' => 'Terkadang kurang sabar ketika mendekati deadline, tetapi diatasi dengan manajemen waktu.',
            'pengalaman_kerja' => $pengalamanKerja,
            'bidang_minat' => ['Administration', 'Human Resources', 'Operations'],
            'referensi' => $referensi,
            'punya_saudara_di_perusahaan' => false,
            'saudara_di_perusahaan' => null,
            'pernah_sakit_berat' => false,
            'sakit_berat_keterangan' => null,
            'punya_penyakit_keturunan' => false,
            'penyakit_keturunan_keterangan' => null,
            'pakai_kacamata' => false,
            'ukuran_kacamata' => null,
            'punya_alergi' => false,
            'alergi_keterangan' => null,
            'punya_pasangan' => $punyaPasangan,
            'data_pasangan' => $dataPasangan,
            'punya_anak' => $punyaAnak,
            'data_anak' => $dataAnak,
            'riwayat_penyakit_keluarga' => null,
            'data_orang_tua' => $dataOrangTua,
            'kontak_darurat' => $kontakDarurat,
            'saudara_kandung' => $saudaraKandung,
            'gaji_diharapkan' => 'Rp 5.000.000',
            'waktu_bergabung' => 'Secepatnya',
            'pernyataan_setuju' => true,
            'tempat_pernyataan' => $tempat,
            'tanggal_pernyataan' => now()->subDays(1)->format('Y-m-d'),
        ];
    }
}
