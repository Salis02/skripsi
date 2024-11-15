<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use App\Models\User;
use App\Models\Semester;
use App\Models\TypeMatkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function index(Request $request) {

        $user = auth()->user();
        $search = $request->get('search');
        $semesterId = $request->get('semesterId');

        // Query dasar untuk mata kuliah dengan relasi semester dan typeMatkul
        $query = Matkul::with('semester', 'typeMatkul');

        // Filter berdasarkan pencarian kode atau nama matkul
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('kodeMatkul', 'LIKE', "%{$search}%")
                ->orWhere('namaMatkul', 'LIKE', "%{$search}%");
            });
        }

        // Filter berdasarkan semester jika semester dipilih
        if ($semesterId) {
            $query->where('semesterId', $semesterId);
        }

        $matkuls = $query->get();

        // Kelompokkan data berdasarkan semesterId
        $groupedMatkuls = $matkuls->groupBy(function($matkul) {
            return $matkul->semester ? $matkul->semester->semester : 'N/A';
        });

        // Hitung total SKS
        $totalSks = null;
        if (!$search && !$semesterId) {
            $totalSks = Matkul::sum('totalSks');
        }

        $semesters = Semester::all();  // Ambil data semua semester untuk form select

        return view('admin.matkul', compact('matkuls', 'user', 'groupedMatkuls', 'semesters', 'totalSks'), [
            'title' => 'Kelola Matkul',
            'active' => 'Matkul'
        ]);
    }

    public function create() {
        $user = auth()->user();
        $semesters = Semester::all();
        $types = TypeMatkul::all();
        return view('admin.create_matkul', compact('user','semesters', 'types'), [
            'title' => 'Kelola Matkul',
            'active' => 'Matkul'
        ]);
    }

    public function store(Request $request) {
        // Validasi input
        $request->validate([
            'kodeMatkul' => 'required',
            'namaMatkul' => 'required',
            'teori' => 'required|integer|min:0',
            'praktek' => 'required|integer|min:0',
            'praktekLapangan' => 'required|integer|min:0',
            'totalSks' => 'required|integer|min:0',
            'semesterId' => 'required|exists:semester,id',
            'typeId' => 'required|exists:typeMatkul,id',
        ]);

        // Buat data baru pada tabel matkul
        Matkul::create($request->all());

        return redirect()->route('matkul.index')->with('success', 'Mata kuliah berhasil ditambahkan');
    }


    public function edit(Matkul $matkul)
    {
        $user = auth()->user();
        $semesters = Semester::all();
        $types = TypeMatkul::all();
        return view('admin.edit_matkul', compact('matkul','user', 'semesters', 'types'), [
            'title' => 'Kelola Matkul',
            'active' => 'Matkul'
        ]);
    }

    public function update(Request $request, Matkul $matkul)
    {
    // Validasi input
    $request->validate([
        'kodeMatkul' => 'required',
        'namaMatkul' => 'required',
        'teori' => 'required|integer',
        'praktek' => 'required|integer',
        'praktekLapangan' => 'required|integer',
        'totalSks' => 'required|integer',
        'semesterId' => 'required',
        'typeId' => 'required',
    ]);

    // Update data terkait pada model yang relevan
    $matkul->update($request->all());

    // Redirect kembali ke halaman daftar mata kuliah dengan pesan sukses
    return redirect()->route('matkul.index')->with('success', 'Mata kuliah berhasil diperbarui');
    }

    public function destroy(Matkul $matkul)
    {
        $matkul->delete();
        return redirect()->route('matkul.index')->with('success', 'Mata kuliah berhasil dihapus');
    }

}
