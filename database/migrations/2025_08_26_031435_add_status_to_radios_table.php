<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('radios', function (Blueprint $table) {
            $table->enum('status', ['aktif', 'nonaktif'])
                  ->default('aktif');
        });
    }

    public function down(): void
    {
        Schema::table('radios', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

};
