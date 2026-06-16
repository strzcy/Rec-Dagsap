<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_pelamars', function (Blueprint $table) {
            // Ubah kolom data_orang_tua menjadi required (tidak boleh null)
            $table->json('data_orang_tua')->nullable(false)->default(json_encode([
                'ayah_nama' => '',
                'ayah_agama' => '',
                'ayah_usia' => '',
                'ayah_pekerjaan' => '',
                'ayah_alamat' => '',
                'ibu_nama' => '',
                'ibu_agama' => '',
                'ibu_usia' => '',
                'ibu_pekerjaan' => '',
                'ibu_alamat' => ''
            ]))->change();
        });
    }

    public function down(): void
    {
        Schema::table('detail_pelamars', function (Blueprint $table) {
            $table->json('data_orang_tua')->nullable()->change();
        });
    }
};