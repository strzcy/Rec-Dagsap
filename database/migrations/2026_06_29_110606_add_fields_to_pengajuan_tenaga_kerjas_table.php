<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'area_penempatan')) {
                $table->string('area_penempatan')->nullable()->after('posisi');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'toko_penempatan')) {
                $table->string('toko_penempatan')->nullable()->after('area_penempatan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            $table->dropColumn(['area_penempatan', 'toko_penempatan']);
        });
    }
};