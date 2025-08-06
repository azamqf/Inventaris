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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('serial_number')->unique();
            $table->string('status')->default('Aktif');
            $table->date('purchase_date')->nullable();
            $table->date('warranty_expiry')->nullable();
            $table->unsignedBigInteger('member_id')->nullable(); // ganti dari location_id ke member_id
            $table->timestamps();

            // Foreign key ke tabel members
            $table->foreign('member_id')->references('id')->on('members')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
