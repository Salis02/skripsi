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
        $fuzzyRanges = FuzzyRange::all();
        return view('dosen.fuzzyRange', compact('fuzzyRanges'), [
            'title' => 'Rentan Fuzzy',
            'active' => 'rentanFuzzy'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.fuzzyRange-create');
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
        return view('dosen.fuzzyRange-edit', compact('fuzzyRange'));
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
