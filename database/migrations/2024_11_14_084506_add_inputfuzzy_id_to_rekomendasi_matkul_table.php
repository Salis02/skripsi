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
        Schema::table('rekomendasi_matkul', function (Blueprint $table) {
            // Menambahkan kolom inputfuzzy_id untuk relasi one-to-one dengan tabel inputfuzzy
            $table->foreignId('inputfuzzy_id')->nullable()->constrained('inputfuzzy')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekomendasi_matkul', function (Blueprint $table) {
            // Menghapus kolom inputfuzzy_id jika migrasi di-rollback
            $table->dropForeign(['inputfuzzy_id']);
            $table->dropColumn('inputfuzzy_id');
        });
    }
};
