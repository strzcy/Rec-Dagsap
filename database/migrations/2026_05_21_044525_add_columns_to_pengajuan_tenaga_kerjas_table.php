<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            $table->json('tugas')->nullable()->after('deskripsi_pekerjaan');
            $table->date('tanggal_dibutuhkan')->nullable()->after('jumlah');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            $table->dropColumn(['tugas', 'tanggal_dibutuhkan']);
        });
    }
};