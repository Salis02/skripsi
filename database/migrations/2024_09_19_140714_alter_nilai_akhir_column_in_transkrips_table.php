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
        Schema::table('transkrip', function (Blueprint $table) {
            $table->decimal('nilai_akhir', 8, 2)->change();  // Mengubah menjadi decimal
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transkrip', function (Blueprint $table) {
            $table->integer('nilai_akhir')->change();  // Mengembalikan menjadi integer
        });
    }
};
