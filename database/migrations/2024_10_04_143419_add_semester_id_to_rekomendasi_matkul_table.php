<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSemesterIdToRekomendasiMatkulTable extends Migration
{
    public function up()
    {
        Schema::table('rekomendasi_matkul', function (Blueprint $table) {
            $table->unsignedBigInteger('semester_id')->after('matkul_id');
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::table('rekomendasi_matkul', function (Blueprint $table) {
            $table->dropForeign(['semester_id']);
            $table->dropColumn('semester_id');
        });
    }
}
