<?php

namespace App\Http\Controllers;


use App\Models\Matkul;
use App\Models\Mahasiswa;
use App\Models\Transkrip;
use App\Models\Semester;
use Illuminate\Http\Request;

class TranskripController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter sorting dari request
        $sortOrder = $request->get('sort', 'asc'); // default asc jika tidak ada parameter

        // Ambil transkrip dengan sorting berdasarkan nama mahasiswa
        $transkrip = Transkrip::with(['matkul', 'mahasiswa'])
                    ->orderBy(Mahasiswa::select('name')->whereColumn('mahasiswas.id', 'transkrip.mahasiswa_id'), $sortOrder)
                    ->get();

        return view('admin.transkrip', compact('transkrip', 'sortOrder'));
    }

    public function create(Request $request)
    {
        $mahasiswas = Mahasiswa::all();
        $semesters = Semester::all();

        // Cek apakah mahasiswa_id diterima
        if ($request->has('mahasiswa_id')) {
            $mahasiswa = Mahasiswa::find($request->mahasiswa_id);

            if ($mahasiswa) {
                // Ambil mata kuliah yang sesuai dengan semester mahasiswa
                $matkuls = Matkul::where('semester_id', $mahasiswa->semester_id)->get();
            } else {
                // Jika mahasiswa tidak ditemukan, berikan response atau redirect
                return redirect()->back()->withErrors(['Mahasiswa tidak ditemukan.']);
            }
        } else {
            $mahasiswa = null;
            $matkuls = collect(); // Kosongkan collection jika tidak ada mahasiswa
        }

        return view('admin.create_transkrip', compact('mahasiswas', 'matkuls', 'semesters', 'mahasiswa'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'matkul_id' => 'required|exists:matkul,id',
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'nilai_akhir' => 'required|numeric',
            'nilai' => 'required',
            'bobot' => 'required|numeric',
        ]);

        Transkrip::create($request->all());
        return redirect()->route('transkrip.index')->with('success', 'Transkrip berhasil ditambahkan');
    }

    public function edit(Transkrip $transkrip)
    {

        $matkuls = Matkul::all();
        $mahasiswas = Mahasiswa::all();
        return view('admin.edit_transkrip', compact('transkrip', 'matkuls', 'mahasiswas'));
    }

    public function update(Request $request, Transkrip $transkrip)
    {
        $request->validate([
            'matkul_id' => 'required|exists:matkul,id',
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'nilai_akhir' => 'required|numeric',
            'nilai' => 'required',
            'bobot' => 'required|numeric'
        ]);

        $transkrip->update($request->all());
        return redirect()->route('transkrip.index')->with('success', 'Transkrip berhasil diperbarui');
    }

    public function destroy(Transkrip $transkrip)
    {
        $transkrip->delete();
        return redirect()->route('transkrip.index')->with('success', 'Transkrip berhasil dihapus');
    }
}
