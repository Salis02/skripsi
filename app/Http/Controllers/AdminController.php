<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $dosens = Dosen::all();
        $mahasiswas = Mahasiswa::all();
        $admins = User::where('role', 'admin')->get();
        return view('admin.dashboard', compact('dosens', 'mahasiswas', 'admins'));
    }

    public function createAdmin()
    {
        return view('admin.create_admin');
    }

    public function storeAdmin(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function editAdmin(User $admin)
    {
        return view('admin.edit_admin', compact('admin'));
    }

    public function updateAdmin(Request $request, User $admin)
    {

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.dashboard.index');
    }

    public function createDosen()
    {
        return view('admin.create_dosen');
    }

    public function storeDosen(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'dosen',
        ]);

        Dosen::create([
            'name' => $request->name,
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function editDosen(Dosen $dosen)
    {
        return view('admin.edit_dosen', compact('dosen'));
    }

    public function updateDosen(Request $request, Dosen $dosen)
    {
        $dosen->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $dosen->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function destroyDosen(Dosen $dosen)
    {
        $dosen->user->delete();
        $dosen->delete();
        return redirect()->route('admin.dashboard');
    }

    public function createMahasiswa()
    {
        $dosens = Dosen::all();
        return view('admin.create_mahasiswa', compact('dosens'));
    }

    public function storeMahasiswa(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'nim' => 'required|string|max:20|unique:mahasiswas,nim',
        'date' => 'required|date',
        'gender' => 'required|string',
        'dosen_id' => 'required|exists:dosens,id',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => 'mahasiswa',
    ]);

    // Debugging
    Log::info('User created successfully:', ['user_id' => $user->id]);
    Log::info('Validated data:', $validated);

    $mahasiswa = Mahasiswa::create([
        'name' => $validated['name'],
        'nim' => $validated['nim'],
        'tanggal_lahir' => $validated['date'],
        'jenis_kelamin' => $validated['gender'],
        'user_id' => $user->id,
        'dosen_id' => $validated['dosen_id'],
    ]);

    // Debugging
    Log::info('Mahasiswa created successfully:', ['mahasiswa_id' => $mahasiswa->id]);

    return redirect()->route('admin.dashboard')->with('success', 'Mahasiswa berhasil dibuat.');
}


    public function editMahasiswa(Mahasiswa $mahasiswa)
    {
        $dosens = Dosen::all();
        return view('admin.edit_mahasiswa', compact('mahasiswa', 'dosens'));
    }

    public function updateMahasiswa(Request $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $mahasiswa->update([
            'name' => $request->name,
            'nim' => $request->nim,
            'dosen_id' => $request->dosen_id,
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function destroyMahasiswa(Mahasiswa $mahasiswa)
    {
        $mahasiswa->user->delete();
        $mahasiswa->delete();
        return redirect()->route('admin.dashboard');
    }
}

