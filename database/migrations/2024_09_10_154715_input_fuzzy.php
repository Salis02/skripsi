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
        Schema::create('inputFuzzy', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('semester');
            $table->string('peminatan');
            $table->decimal('ipk_sebelumnya');
            $table->integer('matkul_dibawah_c');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inputFuzzy');

    }
};
