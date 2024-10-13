<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\FuzzyTsukamotoService;

class MenuController extends Controller
{
    private $fuzzyService;

    public function __construct(FuzzyTsukamotoService $fuzzyService)
    {
        $this->fuzzyService = $fuzzyService;
    }

    public function index()
    {
        // Mengambil data mahasiswa yang terkait dengan user yang sedang login
        $mahasiswa = Auth::user()->mahasiswa;

        // Menampilkan form dan hasil fuzzy dalam satu view
        return view('mahasiswa.menu', [
            'title' => 'Menu Rekomendasi',
            'active' => 'menu',
            'mahasiswa' => $mahasiswa,
            'hasil' => null  // Tidak ada hasil fuzzy di awal
        ]);
    }

    public function calculateFuzzy(Request $request)
    {
        $validatedData = $request->validate([
            'ipk_sebelumnya' => 'required|numeric|min:0|max:4',
            'matkul_dibawah_c' => 'required|integer|min:0'
        ]);

        // Proses perhitungan fuzzy
        $hasil = $this->fuzzyService->hitungRekomendasi(
            $validatedData['ipk_sebelumnya'],
            $validatedData['matkul_dibawah_c']
        );

        // Mengambil data mahasiswa yang terkait dengan user yang sedang login
        $mahasiswa = Auth::user()->mahasiswa;

        // Kembali ke halaman menu mahasiswa, tetapi kali ini dengan hasil perhitungan fuzzy
        return view('mahasiswa.menu', [
            'title' => 'Menu Rekomendasi',
            'active' => 'menu',
            'mahasiswa' => $mahasiswa,
            'hasil' => $hasil
        ]);
    }
}

