<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->index('lowongan_id');
        });

        Schema::table('detail_pelamars', function (Blueprint $table) {
            $table->index('pelamar_id');
        });

        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            $table->index('divisi_id');
            $table->index('user_id');
            $table->index('approved_by');
            $table->index('departemen_dipilih');
            $table->index('nip_pemohon');
        });

        Schema::table('lowongans', function (Blueprint $table) {
            $table->index('pengajuan_id');
            $table->index('hrd_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->dropIndex(['lowongan_id']);
        });

        Schema::table('detail_pelamars', function (Blueprint $table) {
            $table->dropIndex(['pelamar_id']);
        });

        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            $table->dropIndex(['divisi_id']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['approved_by']);
            $table->dropIndex(['departemen_dipilih']);
            $table->dropIndex(['nip_pemohon']);
        });

        Schema::table('lowongans', function (Blueprint $table) {
            $table->dropIndex(['pengajuan_id']);
            $table->dropIndex(['hrd_id']);
        });
    }
};
