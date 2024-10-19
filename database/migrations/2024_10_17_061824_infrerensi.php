<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inference_rules', function (Blueprint $table) {
            $table->id();
            $table->string('ipk_category');
            $table->string('matkul_category');
            $table->string('sks_category');
            $table->integer('min_sks');
            $table->integer('max_sks');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inference_rules');
    }
};
