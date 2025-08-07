<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('networks', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number');

            // Pastikan foreignId dibuat dengan unsignedBigInteger secara default
            $table->unsignedBigInteger('network_type_id');
            $table->unsignedBigInteger('member_id')->nullable();
            $table->foreignId('condition_id')->constrained()->onDelete('cascade');

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('network_type_id')->references('id')->on('network_types')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('networks');
    }
};
