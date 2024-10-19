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
        Schema::table('inputfuzzy', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_id')->after('id'); // Unique untuk one-to-one
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('restrict'); // Foreign key dengan restrict
        });
        
    }

    public function down()
    {
        Schema::table('inputfuzzy', function (Blueprint $table) {
            $table->dropForeign(['mahasiswa_id']);
            $table->dropColumn('mahasiswa_id');
        });
    }

};
