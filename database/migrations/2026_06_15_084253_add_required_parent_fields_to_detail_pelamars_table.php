<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek dulu apakah kolom data_orang_tua ada
        if (Schema::hasColumn('detail_pelamars', 'data_orang_tua')) {
            // Ubah kolom menjadi nullable (boleh null) karena MySQL tidak support default value untuk JSON
            Schema::table('detail_pelamars', function (Blueprint $table) {
                $table->json('data_orang_tua')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        Schema::table('detail_pelamars', function (Blueprint $table) {
            // Kembalikan ke nullable
            $table->json('data_orang_tua')->nullable()->change();
        });
    }
};