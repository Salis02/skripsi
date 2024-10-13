<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        // Mengambil data mahasiswa yang terkait dengan user yang sedang login
        $mahasiswa = Auth::user()->mahasiswa;

        return view('/mahasiswa/riwayat', [
            'title' => 'Riwayat Saya',
            'active' => 'riwayat',
            'mahasiswa' => $mahasiswa
        ]);
    }
}
