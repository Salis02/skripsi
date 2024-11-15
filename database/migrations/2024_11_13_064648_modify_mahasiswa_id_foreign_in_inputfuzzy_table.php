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
            // Hapus foreign key yang ada
            $table->dropForeign(['mahasiswa_id']);
            
            // Tambahkan kembali foreign key dengan onDelete cascade
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('inputfuzzy', function (Blueprint $table) {
            // Kembalikan ke pengaturan restrict jika ingin undo
            $table->dropForeign(['mahasiswa_id']);
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('restrict');
        });
    }

};
