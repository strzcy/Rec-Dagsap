<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('divisi_id')->constrained('divisis');
            $table->foreignId('user_id')->constrained('users'); // user divisi yang mengajukan
            $table->enum('jenis', ['penambahan', 'penggantian']);
            $table->string('posisi');
            $table->integer('jumlah');
            $table->text('kriteria');
            $table->text('persyaratan');
            $table->text('deskripsi_pekerjaan');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->text('alasan_penolakan')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_tenaga_kerjas');
    }
};