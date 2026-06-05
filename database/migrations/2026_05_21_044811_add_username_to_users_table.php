<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Cek apakah kolom username sudah ada
        if (!Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('username')->unique()->nullable()->after('id');
            });
        }
        
        // Isi username untuk user yang sudah ada (ambil dari email sebelum @)
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            if (empty($user->username)) {
                $username = explode('@', $user->email)[0];
                // Pastikan username unik
                $originalUsername = $username;
                $counter = 1;
                while (DB::table('users')->where('username', $username)->exists()) {
                    $username = $originalUsername . $counter;
                    $counter++;
                }
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['username' => $username]);
            }
        }
        
        // Set kolom username menjadi NOT NULL setelah terisi
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};