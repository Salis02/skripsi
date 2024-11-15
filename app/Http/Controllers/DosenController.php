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
        $user = auth()->user();
        $dosenId = Auth::user()->dosen->id;

        // Mengambil mahasiswa yang berelasi dengan dosen yang sedang login
        $mahasiswas = Mahasiswa::with(['user', 'dosen']) // Eager load relasi user dan dosen
        ->where('dosen_id', $dosenId) // Filter berdasarkan dosen yang sedang login
        ->get();
        return view('dosen.dashboard', compact('mahasiswas','user', 'dosenId') ,[
            'title' => 'Dashboard',
            'active' => 'Dashboard'
        ]);
    }

    public function transkrip($id)
    {
        // Mengambil mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::with(['user', 'dosen'])->findOrFail($id);
        $user = auth()->user();

        // Mengambil transkrip yang sesuai dengan ID mahasiswa
        $transkrip = Transkrip::where('mahasiswa_id', $id)->with('matkul')->get();

        $totalSks = 0;
        $totalNilaiSks = 0;

        // Loop untuk menghitung total SKS dan total nilai akhir * SKS
        foreach ($transkrip as $item) {
            $sks = $item->matkul->totalSks;
            $nilaiAkhir = $item->nilai_akhir;

            $totalSks += $sks;
            $totalNilaiSks += $nilaiAkhir; // Perhatikan perkalian nilai akhir dengan SKS
        }

        // Menghitung IPK dengan menghindari pembagian dengan nol
        $indeksPrestasi = $totalSks ? $totalNilaiSks / $totalSks : 0;

        return view('dosen.transkrip', compact('mahasiswa', 'transkrip', 'user', 'indeksPrestasi'), [
            'title' => 'Transkrip ' . $mahasiswa->name,
            'active' => 'Dashboard',
            'totalSks' => $totalSks,
            'totalNilaiSks' => $totalNilaiSks
        ]);
    }
}

