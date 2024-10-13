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
        Schema::create('inputfuzzy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->constrained('semester'); // Relasi dengan tabel semester
            $table->decimal('ipk_sebelumnya', 3, 2); // Menyimpan nilai IPK sebelumnya
            $table->integer('matkul_mengulang'); // Menyimpan jumlah matkul yang diulang
            $table->string('peminatan'); // Peminatan bisa "Software Developer" atau "Data Scientist"
            $table->decimal('hasil_defuzzifikasi', 5, 2); // Hasil perhitungan fuzzy
            $table->timestamps(); // Waktu pembuatan dan update record
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inputfuzzy');
    }
};
