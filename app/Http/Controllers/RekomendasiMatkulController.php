<?php

namespace App\Http\Controllers;

use App\Models\RekomendasiMatkul;
use App\Models\Matkul;
use Illuminate\Http\Request;

class RekomendasiMatkulController extends Controller
{
    public function index()
    {
        $rekomendasiMatkuls = RekomendasiMatkul::with('matkul')->get();
        return view('dosen.rekomendasi_matkul', compact('rekomendasiMatkuls'));
    }

    public function create()
    {
        $matkuls = Matkul::all();
        return view('dosen.rekomendasi_matkul-create', compact('matkuls'));
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
        $matkuls = Matkul::all();
        return view('dosen.rekomendasi_matkul-edit', compact('rekomendasiMatkul', 'matkuls'));
    }

    public function update(Request $request, RekomendasiMatkul $rekomendasiMatkul)
    {
        $request->validate([
            'type' => 'required',
            'matkul_id' => 'required|exists:matkul,id',
        ]);

        $rekomendasiMatkul->update($request->all());

        return redirect()->route('rekomendasi_matkul.index')->with('success', 'Rekomendasi Mata Kuliah berhasil diperbarui.');
    }

    public function destroy(RekomendasiMatkul $rekomendasiMatkul)
    {
        $rekomendasiMatkul->delete();
        return redirect()->route('rekomendasi_matkul.index')->with('success', 'Rekomendasi Mata Kuliah berhasil dihapus.');
    }
}
