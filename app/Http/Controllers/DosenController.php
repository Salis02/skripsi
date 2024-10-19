<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::with('user')->get();
        return view('dosen.dashboard', [
            'title' => 'dashboard',
            'active' => 'Dashboard'
        ]);
    }
}

