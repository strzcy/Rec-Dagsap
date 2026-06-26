<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'lampiran_path')) {
                $table->string('lampiran_path')->nullable()->after('deskripsi_pekerjaan');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'lampiran_nama')) {
                $table->string('lampiran_nama')->nullable()->after('lampiran_path');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'lampiran_jenis')) {
                $table->string('lampiran_jenis')->nullable()->after('lampiran_nama');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            $table->dropColumn(['lampiran_path', 'lampiran_nama', 'lampiran_jenis']);
        });
    }
};