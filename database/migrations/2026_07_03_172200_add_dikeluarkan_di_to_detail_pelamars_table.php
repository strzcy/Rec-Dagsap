<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_pelamars', function (Blueprint $table) {
            if (!Schema::hasColumn('detail_pelamars', 'dikeluarkan_di')) {
                $table->string('dikeluarkan_di')->nullable()->after('no_ktp');
            }
        });
    }

    public function down(): void
    {
        Schema::table('detail_pelamars', function (Blueprint $table) {
            $table->dropColumn('dikeluarkan_di');
        });
    }
};