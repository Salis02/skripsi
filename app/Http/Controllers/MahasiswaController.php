<?php

namespace App\Http\Controllers;

use App\Models\Transkrip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{

    public function index()
    {

        $mahasiswa = Auth::user()->mahasiswa;
        return view('mahasiswa.dashboard', [
            'title' => 'Dashboard' ,
            'active' => 'dashboard' ,
            'mahasiswa' => $mahasiswa
        ]);
    }
    public function data()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // Ambil data menggunakan query builder
        // Menggunakan Eloquent dan relasi
        $transkrip = $mahasiswa->transkrip()->with('matkul')->get();

        $totalSks = 0;
        $totalNilaiSks = 0; // Untuk total nilai akhir dikalikan SKS

        // Loop melalui transkrip untuk menghitung total SKS dan total nilai akhir * SKS
        foreach ($transkrip as $item) {
            $sks = $item->matkul->totalSks;
            $nilaiAkhir = $item->nilai_akhir;

            // Hitung total SKS
            $totalSks += $sks;

            // Hitung total nilai akhir x SKS
            $totalNilaiSks += $nilaiAkhir ;
        }

        // Menghindari pembagian dengan nol dan menghitung IPK
        $indeksPrestasi = $totalSks ? $totalNilaiSks / $totalSks : 0;

        return view('mahasiswa.data', [
            'title' => 'Data Saya' ,
            'active' => 'data',
            'mahasiswa' => $mahasiswa,
            'indeksPrestasi' => number_format($indeksPrestasi, 2), // Format dengan 2 angka di belakang koma
            'totalSks' => $totalSks // Tampilkan total SKS
        ]);
    }
}
