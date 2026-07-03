<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'catatan_ptk')) {
                $table->text('catatan_ptk')->nullable()->after('lampiran_jenis');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'catatan_dibuat_oleh')) {
                $table->string('catatan_dibuat_oleh')->nullable()->after('catatan_ptk');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'catatan_jabatan_dibuat')) {
                $table->string('catatan_jabatan_dibuat')->nullable()->after('catatan_dibuat_oleh');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'catatan_dibuat_at')) {
                $table->timestamp('catatan_dibuat_at')->nullable()->after('catatan_jabatan_dibuat');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'catatan_diubah_oleh')) {
                $table->string('catatan_diubah_oleh')->nullable()->after('catatan_dibuat_at');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'catatan_jabatan_diubah')) {
                $table->string('catatan_jabatan_diubah')->nullable()->after('catatan_diubah_oleh');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'catatan_diubah_at')) {
                $table->timestamp('catatan_diubah_at')->nullable()->after('catatan_jabatan_diubah');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            $table->dropColumn([
                'catatan_ptk',
                'catatan_dibuat_oleh',
                'catatan_jabatan_dibuat',
                'catatan_dibuat_at',
                'catatan_diubah_oleh',
                'catatan_jabatan_diubah',
                'catatan_diubah_at'
            ]);
        });
    }
};