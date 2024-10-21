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
        Schema::create('rekomendasi_matkul', function (Blueprint $table) {
            $table->id();

            // menambahkan matkul_id yang berelasi dengan tabel matkul
            $table->foreignId('matkul_id')->constrained('matkul')->onUpdate('cascade')->onDelete('restrict');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasi_matkul');
    }
};
