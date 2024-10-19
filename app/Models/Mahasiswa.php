<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Tentukan nama tabel yang benar
    protected $table = 'mahasiswas';

    protected $fillable = [
        'name',
        'nim',
        'tanggal_lahir',
        'jenis_kelamin',
        'user_id',
        'dosen_id',
        'semester_id'
    ];



    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transkrip()
    {
        return $this->hasOne(Transkrip::class, 'mahasiswa_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function inputFuzzy()
    {
        return $this->hasMany(InputFuzzy::class, 'mahasiswa_id');
    }

}
