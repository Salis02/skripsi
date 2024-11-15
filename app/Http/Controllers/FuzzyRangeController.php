<?php

namespace App\Http\Controllers;

use App\Models\FuzzyRange;
use Illuminate\Http\Request;

class FuzzyRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $fuzzyRanges = FuzzyRange::all();
        return view('admin.fuzzyRange', compact('fuzzyRanges','user'), [
            'title' => 'Rentan Fuzzy',
            'active' => 'rentanFuzzy'
        ]);
    }

    public function showDosen()
    {
        $user = auth()->user();
        $fuzzyRanges = FuzzyRange::all();
        return view('dosen.fuzzyRange', compact('fuzzyRanges', 'user'), [
            'title' => 'Rentan Fuzzy',
            'active' => 'rentanFuzzy'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        return view('admin.fuzzyRange-create', compact('user'),  [
            'title' => 'Rentan Fuzzy',
            'active' => 'rentanFuzzy'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'variabel' => 'required|string',
            'category' => 'required|string',
            'min_value' => 'required|numeric',
            'max_value' => 'required|numeric',
        ]);

        FuzzyRange::create($request->all());

        return redirect()->route('fuzzyRange.index')
                         ->with('success', 'Fuzzy range created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuzzyRange $fuzzyRange)
    {
        $user = auth()->user();
        return view('admin.fuzzyRange-edit', compact('fuzzyRange', 'user'),  [
            'title' => 'Rentan Fuzzy',
            'active' => 'rentanFuzzy'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FuzzyRange $fuzzyRange)
    {
        $request->validate([
            'variabel' => 'required|string',
            'category' => 'required|string',
            'min_value' => 'required|numeric',
            'max_value' => 'required|numeric',
        ]);

        $fuzzyRange->update($request->all());

        return redirect()->route('fuzzyRange.index')
                         ->with('success', 'Fuzzy range updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuzzyRange $fuzzyRange)
    {
        $fuzzyRange->delete();

        return redirect()->route('fuzzyRange.index')
                         ->with('success', 'Fuzzy range deleted successfully.');
    }
}
