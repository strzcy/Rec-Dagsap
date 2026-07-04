<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_pelamars', function (Blueprint $table) {
            // Ubah organisasi dari text ke json
            if (Schema::hasColumn('detail_pelamars', 'organisasi')) {
                $table->json('organisasi')->nullable()->change();
            } else {
                $table->json('organisasi')->nullable();
            }

            // No. Rumah sebelum RT/RW
            if (!Schema::hasColumn('detail_pelamars', 'no_rumah_tinggal')) {
                $table->string('no_rumah_tinggal')->nullable()->after('alamat_tinggal');
            }
            if (!Schema::hasColumn('detail_pelamars', 'no_rumah_ktp')) {
                $table->string('no_rumah_ktp')->nullable()->after('alamat_ktp');
            }

            // BPJS Kesehatan & BPJS Ketenagakerjaan
            if (!Schema::hasColumn('detail_pelamars', 'no_bpjs_kesehatan')) {
                $table->string('no_bpjs_kesehatan')->nullable()->after('no_bpjs_ketenagakerjaan');
            }

            // No KTP & Passport dipisah
            if (!Schema::hasColumn('detail_pelamars', 'no_passport')) {
                $table->string('no_passport')->nullable()->after('no_ktp');
            }

            // Kekuatan & Kelemahan jadi JSON
            if (Schema::hasColumn('detail_pelamars', 'kekuatan')) {
                $table->json('kekuatan')->nullable()->change();
            } else {
                $table->json('kekuatan')->nullable();
            }
            
            if (Schema::hasColumn('detail_pelamars', 'kelemahan')) {
                $table->json('kelemahan')->nullable()->change();
            } else {
                $table->json('kelemahan')->nullable();
            }

            // Remunerasi: gaji + tipe (brutto/netto)
            if (!Schema::hasColumn('detail_pelamars', 'gaji_tipe')) {
                $table->enum('gaji_tipe', ['brutto', 'netto'])->nullable()->after('gaji_diharapkan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('detail_pelamars', function (Blueprint $table) {
            $table->dropColumn([
                'no_rumah_tinggal',
                'no_rumah_ktp',
                'no_bpjs_kesehatan',
                'no_passport',
                'gaji_tipe'
            ]);
            
            // Kembalikan ke text
            $table->text('organisasi')->nullable()->change();
            $table->text('kekuatan')->nullable()->change();
            $table->text('kelemahan')->nullable()->change();
        });
    }
};
