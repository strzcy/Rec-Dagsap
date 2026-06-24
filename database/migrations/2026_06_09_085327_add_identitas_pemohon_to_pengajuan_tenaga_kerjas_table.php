<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'nama_pemohon')) {
                $table->string('nama_pemohon')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'nip_pemohon')) {
                $table->string('nip_pemohon')->nullable()->after('nama_pemohon');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'jabatan_pemohon')) {
                $table->string('jabatan_pemohon')->nullable()->after('nip_pemohon');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'no_hp_pemohon')) {
                $table->string('no_hp_pemohon')->nullable()->after('jabatan_pemohon');
            }
            if (!Schema::hasColumn('pengajuan_tenaga_kerjas', 'departemen_dipilih')) {
                $table->foreignId('departemen_dipilih')->nullable()->after('divisi_id')
                      ->constrained('divisis')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_tenaga_kerjas', function (Blueprint $table) {
            $table->dropColumn(['nama_pemohon', 'nip_pemohon', 'jabatan_pemohon', 'no_hp_pemohon', 'departemen_dipilih']);
        });
    }
};