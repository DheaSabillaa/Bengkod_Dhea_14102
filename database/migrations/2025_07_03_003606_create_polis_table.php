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
         Schema::create('polis', function (Blueprint $table) {
            $table->id(); // Primary Key (id)
            $table->string('nama_poli'); // Nama Poli
            $table->text('keterangan')->nullable(); // Keterangan Poli, nullable if not provided
            $table->timestamps(); // created_at & updated_at
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
