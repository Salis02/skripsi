<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPK extends Model
{
    use HasFactory;

    public function Mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
