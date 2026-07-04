<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_pelamars', function (Blueprint $table) {
            // pendidikan_formal tetap JSON, kita tambahkan field 'alasan' di dalam JSON-nya
            // Tidak perlu alter table, karena JSON bisa menampung field baru
        });
    }

    public function down(): void
    {
        // Tidak ada yang diubah
    }
};