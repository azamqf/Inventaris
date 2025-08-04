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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama member
            $table->string('nrp')->unique(); //nrp
            $table->string('phone')->nullable(); // Nomor Whatsapp
            $table->enum('gender', ['male', 'female'])->nullable(); // Jenis kelamin
            $table->string('thumbnail')->nullable();
            $table->foreignId('rank_id')->constrained('ranks')->cascadeOnDelete(); // pangkat
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // kesatuan

            // 👉 Tambahkan ini:
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
