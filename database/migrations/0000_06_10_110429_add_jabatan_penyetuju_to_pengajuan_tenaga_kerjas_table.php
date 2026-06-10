<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'jabatan_penyetuju')) {
                $table->string('jabatan_penyetuju')->nullable()->after('disetujui_oleh');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            $table->dropColumn('jabatan_penyetuju');
        });
    }
};