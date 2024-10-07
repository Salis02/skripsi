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
            $table->decimal('bobot', 5, 2)->before('nilai_akhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transkrip', function (Blueprint $table) {
            $table->dropColumn('bobot');
        });
    }
};
