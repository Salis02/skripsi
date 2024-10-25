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
        Schema::table('inputfuzzy', function (Blueprint $table) {
            $table->json('paket_rekomendasi')->nullable()->after('hasil_defuzzifikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inputfuzzy', function (Blueprint $table) {
            $table->dropColumn('paket_rekomendasi');
        });
    }
};
