<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tidak perlu alter table, karena organisasi tetap JSON
        // Kita hanya akan mengubah struktur di aplikasi
    }

    public function down(): void
    {
        // Tidak ada yang diubah
    }
};