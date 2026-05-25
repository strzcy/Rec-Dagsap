<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'diajukan_oleh')) {
                $table->string('diajukan_oleh')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'disetujui_oleh')) {
                $table->string('disetujui_oleh')->nullable()->after('approved_by');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            $table->dropColumn(['diajukan_oleh', 'disetujui_oleh']);
        });
    }
};