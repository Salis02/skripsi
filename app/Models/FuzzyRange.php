<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuzzyRange extends Model
{
    use HasFactory;

    protected $table = 'fuzzyRange';

    // Kolom yang boleh diisi secara massal
    protected $fillable = ['variabel', 'category', 'min_value', 'max_value'];
}
