<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    //harus diisi
    protected $fillable = ['name', 'user_id'];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
