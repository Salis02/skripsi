<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $table = 'matkul';
    protected $fillable = [
        'kodeMatkul', 'namaMatkul', 'teori', 'praktek', 'praktekLapangan', 'totalSks', 'semesterId', 'typeId'
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semesterId');
    }

    public function typeMatkul()
    {
        return $this->belongsTo(TypeMatkul::class, 'typeId');
    }
    public function transkrip()
    {
        return $this->hasOne(Transkrip::class);
    }

}
