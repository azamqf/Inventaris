<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kerangka');
            $table->string('nomor_mesin');
            $table->string('nomor_polisi');
            $table->string('merk');
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->enum('tipe', ['Roda2', 'Roda4']);
            $table->foreignId('condition_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
