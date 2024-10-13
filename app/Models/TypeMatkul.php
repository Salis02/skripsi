<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMatkul extends Model
{
    use HasFactory;
    protected $table = 'typematkul';

    public function matkul()
    {
        return $this->hasMany(Matkul::class);
    }
}
