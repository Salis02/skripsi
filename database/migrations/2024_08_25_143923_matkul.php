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
        Schema::create('matkul', function (Blueprint $table) {
            $table->id();
            $table->string('kodeMatkul');
            $table->string('namaMatkul');
            $table->integer('teori')->default(0); // Berikan default value
            $table->integer('praktek')->default(0); // Berikan default value
            $table->integer('praktekLapangan')->default(0); // Berikan default value
            $table->integer('totalSks')->default(0);
            $table->foreignId('semesterId')->constrained('semester');
            $table->foreignId('typeId')->constrained('typeMatkul');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matkul');
    }
};
