<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Transkrip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function index()
    {
        // Mendapatkan dosen yang sedang login
        $dosenId = Auth::user()->dosen->id;

        // Mengambil mahasiswa yang berelasi dengan dosen yang sedang login
        $mahasiswas = Mahasiswa::with(['user', 'dosen']) // Eager load relasi user dan dosen
        ->where('dosen_id', $dosenId) // Filter berdasarkan dosen yang sedang login
        ->get();
        return view('dosen.dashboard', compact('mahasiswas', 'dosenId') ,[
            'title' => 'Dashboard',
            'active' => 'Dashboard'
        ]);
    }

    public function transkrip($id)
    {
        // Mengambil mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::with(['user', 'dosen'])->findOrFail($id);

        // Mengambil transkrip yang sesuai dengan ID mahasiswa
        $transkrip = Transkrip::where('mahasiswa_id', $id)->with('matkul')->get();

        return view('dosen.transkrip', compact('mahasiswa', 'transkrip'), [
            'title' => 'Transkrip ' . $mahasiswa->name,
            'active' => 'Dashboard'
        ]);
    }
}

