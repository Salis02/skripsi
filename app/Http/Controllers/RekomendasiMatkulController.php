<?php

namespace App\Http\Controllers;

use App\Models\RekomendasiMatkul;
use App\Models\Matkul;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class RekomendasiMatkulController extends Controller
{
    public function index( Request $request)
    {
        $user = auth()->user();
        $dosenId = $user->dosen->id;
       
        // Mengambil mahasiswa yang berelasi dengan dosen yang sedang login
        $mahasiswas = Mahasiswa::with(['inputFuzzy', 'inputFuzzy.rekomendasiMatkul.matkul']) // Eager load relasi inputFuzzy dan rekomendasiMatkul
        ->where('dosen_id', $dosenId) // Filter berdasarkan dosen yang sedang login
        ->get();

        // $rekomendasiMatkuls = RekomendasiMatkul::with('matkul', 'inputfuzzy')->get();

        // Memfilter rekomendasi berdasarkan mahasiswa yang dipilih
        $rekomendasiMatkuls = [];
        if ($request->filled('mahasiswa_id')) {
            $rekomendasiMatkuls = RekomendasiMatkul::with(['matkul', 'inputFuzzy'])
                ->whereHas('inputFuzzy', function ($query) use ($request) {
                    $query->where('mahasiswa_id', $request->mahasiswa_id);
                })
                ->get();
        }
        return view('dosen.rekomendasi_matkul', compact('rekomendasiMatkuls', 'user', 'mahasiswas'), [
            'title' => 'Paket Rekomendasi',
            'active' => 'rekomendasi',
            'selectedMahasiswa' => $request->mahasiswa_id ?? null
        ]);
    }

    public function create()
    {
        $user = auth()->user();
        $matkuls = Matkul::all();
        return view('dosen.rekomendasi_matkul-create', compact('matkuls', 'user'),  [
            'title' => 'Paket Rekomendasi',
            'active' => 'rekomendasi'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'matkul_id' => 'required|exists:matkul,id',
        ]);

        RekomendasiMatkul::create($request->all());

        return redirect()->route('rekomendasi_matkul.index')->with('success', 'Rekomendasi Mata Kuliah berhasil ditambahkan.');
    }

    public function edit(RekomendasiMatkul $rekomendasiMatkul)
    {
        $user = auth()->user();
        $matkuls = Matkul::all();
        return view('dosen.rekomendasi_matkul-edit', compact('rekomendasiMatkul','user', 'matkuls'), [
            'title' => 'Paket Rekomendasi',
            'active' => 'rekomendasi'
        ]);
    }

    // public function update(Request $request, RekomendasiMatkul $rekomendasiMatkul)
    // {
    //     $request->validate([
    //         'type' => 'required',
    //         'matkul_id' => 'required|exists:matkul,id',
    //     ]);

    //     $rekomendasiMatkul->update($request->all());

    //     return redirect()->route('rekomendasi_matkul.index')->with('success', 'Rekomendasi Mata Kuliah berhasil diperbarui.');
    // }

    public function update(Request $request, RekomendasiMatkul $rekomendasiMatkul)
    {
        $request->validate([
            'type' => 'required',
            'matkul_id' => 'required|exists:matkul,id',
        ]);

        $rekomendasiMatkul->update($request->all());

        // Redirect ke index dengan mahasiswa_id
        return redirect()->route('rekomendasi_matkul.index', [
            'mahasiswa_id' => $rekomendasiMatkul->inputFuzzy->mahasiswa_id
        ])->with('success', 'Rekomendasi Mata Kuliah berhasil diperbarui.');
    }


    public function destroy(RekomendasiMatkul $rekomendasiMatkul)
    {
        // Simpan mahasiswa_id sebelum menghapus
        $mahasiswaId = $rekomendasiMatkul->inputFuzzy->mahasiswa_id;

        // Redirect ke index dengan mahasiswa_id yang dipilih
        $rekomendasiMatkul->delete();
        return redirect()->route('rekomendasi_matkul.index', ['mahasiswa_id' => $mahasiswaId])->with('success', 'Rekomendasi Mata Kuliah berhasil dihapus.');
    }
}
