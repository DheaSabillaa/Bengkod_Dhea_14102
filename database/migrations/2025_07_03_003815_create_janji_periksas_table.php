<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('janji_periksas', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm')->unique();
            $table->foreignId('id_pasien')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_jadwal_periksa')->constrained('jadwal_periksas')->onDelete('cascade');
            $table->foreignId('id_poli')->constrained('polis')->onDelete('cascade');
            $table->text('keluhan');
            $table->string('no_antrian', 10);
            $table->enum('status', ['Belum diperiksa', 'Sudah diperiksa']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('janji_periksas');
    }
};
