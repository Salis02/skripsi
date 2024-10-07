<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transkrip extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama model
    protected $table = 'transkrip';

    protected $fillable = [
        'matkul_id', 'mahasiswa_id', 'nilai_akhir','nilai','bobot'
    ];

    // Relasi ke model Matkul
    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }

    // Relasi ke model Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
