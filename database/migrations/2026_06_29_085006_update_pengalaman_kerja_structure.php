<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kita tidak perlu mengubah struktur database karena pengalaman_kerja sudah JSON
        // Cukup di model dan view yang diubah
        Schema::table('detail_pelamars', function (Blueprint $table) {
            // Kolom pengalaman_kerja tetap JSON, hanya strukturnya yang berubah di aplikasi
            // Tidak perlu alter table
        });
    }

    public function down(): void
    {
        // Tidak ada yang diubah
    }
};