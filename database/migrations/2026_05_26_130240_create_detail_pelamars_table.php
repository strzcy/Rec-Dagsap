<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pelamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_id')->constrained('pelamars')->onDelete('cascade');
            
            // A. Data Pribadi
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('kewarganegaraan')->default('Indonesia');
            $table->string('agama');
            $table->string('golongan_darah')->nullable();
            $table->text('alamat_tinggal');
            $table->string('rt_rw_tinggal')->nullable();
            $table->string('kelurahan_tinggal')->nullable();
            $table->string('kecamatan_tinggal')->nullable();
            $table->string('kabupaten_tinggal')->nullable();
            $table->string('kota_tinggal')->nullable();
            $table->string('provinsi_tinggal')->nullable();
            $table->string('kode_pos_tinggal')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('no_hp');
            $table->string('no_wa')->nullable();
            $table->text('alamat_ktp');
            $table->string('rt_rw_ktp')->nullable();
            $table->string('kelurahan_ktp')->nullable();
            $table->string('kecamatan_ktp')->nullable();
            $table->string('kabupaten_ktp')->nullable();
            $table->string('kota_ktp')->nullable();
            $table->string('provinsi_ktp')->nullable();
            $table->string('kode_pos_ktp')->nullable();
            $table->string('no_ktp');
            $table->string('no_npwp')->nullable();
            $table->string('no_bpjs_ketenagakerjaan')->nullable();
            $table->string('no_bpjs_kesehatan')->nullable();
            $table->enum('status_perkawinan', ['Lajang', 'Nikah', 'Bercerai', 'Pasangan Meninggal']);
            $table->string('email');
            $table->string('hobby')->nullable();
            $table->text('organisasi')->nullable();
            
            // B. Riwayat Pendidikan - Formal (disimpan sebagai JSON)
            $table->json('pendidikan_formal')->nullable();
            // Pelatihan/Kursus (JSON)
            $table->json('pelatihan')->nullable();
            
            // C. Keterampilan (JSON)
            $table->json('keterampilan')->nullable();
            
            // D. Bahasa Asing (JSON)
            $table->json('bahasa_asing')->nullable();
            
            // E. Kekuatan & Kelemahan (JSON)
            $table->json('kekuatan_kelemahan')->nullable();
            
            // F. Riwayat Pekerjaan
            $table->json('pengalaman_kerja')->nullable();
            $table->json('bidang_minat')->nullable();
            
            // G. Referensi
            $table->json('referensi')->nullable();
            $table->boolean('punya_saudara_di_perusahaan')->default(false);
            $table->json('saudara_di_perusahaan')->nullable();
            
            // H. Riwayat Kesehatan
            $table->boolean('pernah_sakit_berat')->default(false);
            $table->text('sakit_berat_keterangan')->nullable();
            $table->boolean('punya_penyakit_keturunan')->default(false);
            $table->text('penyakit_keturunan_keterangan')->nullable();
            $table->boolean('pakai_kacamata')->default(false);
            $table->string('ukuran_kacamata')->nullable();
            $table->boolean('punya_alergi')->default(false);
            $table->text('alergi_keterangan')->nullable();
            
            // I. Data Keluarga
            $table->json('data_pasangan')->nullable();
            $table->json('data_anak')->nullable();
            $table->json('riwayat_penyakit_keluarga')->nullable();
            $table->json('data_orang_tua')->nullable();
            $table->json('kontak_darurat')->nullable();
            $table->json('saudara_kandung')->nullable();
            
            // J. Remunerasi
            $table->string('gaji_diharapkan')->nullable();
            
            // K. Waktu bergabung
            $table->string('waktu_bergabung')->nullable();
            
            // L. Pernyataan
            $table->boolean('pernyataan_setuju')->default(false);
            $table->string('tempat_pernyataan')->nullable();
            $table->date('tanggal_pernyataan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pelamars');
    }
};