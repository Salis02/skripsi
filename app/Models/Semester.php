<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table = 'semester';

    public function matkul()
    {
        return $this->hasMany(Matkul::class);
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'semester_id');
    }
    
}
