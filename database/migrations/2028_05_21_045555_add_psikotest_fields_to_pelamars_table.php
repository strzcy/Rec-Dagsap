<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pelamars', function (Blueprint $table) {
            if (!Schema::hasColumn('pelamars', 'ipk')) {
                $table->string('ipk')->nullable()->after('tahun_lulus');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->dropColumn('ipk');
        });
    }
};