<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputFuzzy extends Model
{
    use HasFactory;

    protected $table = 'inputfuzzy';

    protected $fillable = [
        'mahasiswa_id',
        'semester_id',
        'ipk_sebelumnya',
        'matkul_mengulang',
        'peminatan',
        'hasil_defuzzifikasi',
    ];

    // Relasi ke tabel semester
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    // Relasi ke tabel mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}

