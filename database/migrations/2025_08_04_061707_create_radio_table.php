<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('radios', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number');
            $table->foreignId('radio_type_id')
                ->constrained('radio_types') // eksplisit ke nama tabel relasi
                ->onDelete('cascade');
            $table->foreignId('member_id')
                ->constrained('members') // eksplisit juga
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('radios');
    }
};
