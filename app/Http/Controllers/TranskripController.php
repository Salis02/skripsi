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
        $mahasiswaId = $request->input('mahasiswa_id');
        $search = $request->input('search');
        
        $query = Transkrip::with(['matkul', 'mahasiswa'])
            ->when($mahasiswaId, function($query) use ($mahasiswaId) {
                $query->where('mahasiswa_id', $mahasiswaId);
            })
            ->when($search, function($query) use ($search) {
                $query->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })
            ->orderBy(Mahasiswa::select('name')->whereColumn('mahasiswas.id', 'transkrip.mahasiswa_id'));
    
        $transkrip = $query->paginate(10);
        $mahasiswas = Mahasiswa::all();
    
        return view('admin.transkrip', compact('transkrip', 'mahasiswas', 'search'), [
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

    public function storeBatch(Request $request)
    {
        $request->validate([
            'matkul_id.*' => 'required|exists:matkul,id',
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'nilai.*' => 'required',
            'bobot.*' => 'required|numeric',
            'nilai_akhir.*' => 'required|numeric',
        ]);

        // Loop through each input set
        for ($i = 0; $i < count($request->matkul_id); $i++) {
            Transkrip::create([
                'matkul_id' => $request->matkul_id[$i],
                'mahasiswa_id' => $request->mahasiswa_id,
                'nilai' => $request->nilai[$i],
                'bobot' => $request->bobot[$i],
                'nilai_akhir' => $request->nilai_akhir[$i],
            ]);
        }

        return redirect()->route('transkrip.index')->with('success', 'Transkrip berhasil ditambahkan untuk 5 mata kuliah');
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
