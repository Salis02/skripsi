<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiMatkul extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi_matkul';

    protected $fillable = ['type', 'matkul_id'];

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }
}
