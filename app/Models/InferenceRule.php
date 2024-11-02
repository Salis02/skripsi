<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InferenceRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'ipk_category',
        'matkul_category',
        'sks_category',
        'min_sks',
        'max_sks',
    ];
}
