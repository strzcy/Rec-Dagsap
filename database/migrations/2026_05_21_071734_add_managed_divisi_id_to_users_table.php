<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'managed_divisi_id')) {
                $table->foreignId('managed_divisi_id')->nullable()->after('divisi_id')
                      ->constrained('divisis')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'managed_divisi_id')) {
                $table->dropForeign(['managed_divisi_id']);
                $table->dropColumn('managed_divisi_id');
            }
        });
    }
};