<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            // Tambah kolom status kalau belum ada
            if (!Schema::hasColumn('members', 'status')) {
                $table->enum('status', ['active', 'inactive'])
                      ->default('active'); // default semua member baru jadi aktif
            }
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            if (Schema::hasColumn('members', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
