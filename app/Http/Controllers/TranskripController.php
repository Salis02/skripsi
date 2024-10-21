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
        $search = $request->input('search'); // Ambil input pencarian

        // Ambil transkrip dengan sorting berdasarkan nama mahasiswa
        $query = Transkrip::with(['matkul', 'mahasiswa'])
                    ->orderBy(Mahasiswa::select('name')->whereColumn('mahasiswas.id', 'transkrip.mahasiswa_id'));

        // Jika ada input pencarian, tambahkan kondisi where
        if ($search) {
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $transkrip = $query->paginate(10);

        return view('admin.transkrip', compact('transkrip', 'search'), [
            'title' => 'Kelola Transkrip',
            'active' => 'Transkrip'
        ]);
    }

    public function create(Request $request)
    {
        $mahasiswas = Mahasiswa::all();
        $semesters = Semester::all();
        $matkuls = Matkul::all();

        return view('admin.create_transkrip', compact('mahasiswas', 'matkuls', 'semesters'), [
            'title' => 'Kelola Transkrip',
            'active' => 'Transkrip'
        ]);
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
        return view('admin.edit_transkrip', compact('transkrip', 'matkuls', 'mahasiswas'), [
            'title' => 'Kelola Transkrip',
            'active' => 'Transkrip'
        ]);
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
