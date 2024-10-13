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
    Schema::create('transkrip', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('matkul_id');
        $table->unsignedBigInteger('mahasiswa_id');
        $table->decimal('nilai_akhir', 5, 2);
        $table->string('nilai');
        $table->timestamps();

        // Sesuaikan nama tabel foreign key dengan benar
        $table->foreign('matkul_id')->references('id')->on('matkul')->onDelete('cascade');
        $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade'); // Ubah 'mahasiswa' menjadi 'mahasiswas'
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transkrips');
    }
};
