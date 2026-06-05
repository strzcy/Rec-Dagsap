<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lowongan_id')->constrained('lowongans');
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('no_telepon');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('pendidikan_terakhir');
            $table->string('jurusan');
            $table->integer('tahun_lulus');
            $table->text('pengalaman_kerja')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('ijazah_path')->nullable();
            $table->enum('status', ['pending', 'lolos_tahap1', 'psikotest', 'lolos_psikotest', 'interview', 'diterima', 'ditolak'])->default('pending');
            $table->text('catatan')->nullable();
            $table->string('psikotest_link')->nullable();
            $table->timestamp('psikotest_dikirim_at')->nullable();
            $table->timestamp('psikotest_selesai_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelamars');
    }
};