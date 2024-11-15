<?php

namespace App\Http\Controllers;

use App\Models\InferenceRule;
use Illuminate\Http\Request;

class InferenceRuleController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $rules = InferenceRule::all();
        return view('admin.inference', compact('rules', 'user'),[
            'title' => 'Inference',
            'active' => 'inference'
        ]);
    }

    public function showDosen()
    {
        $user = auth()->user();
        $rules = InferenceRule::all();
        return view('dosen.inference', compact('rules', 'user'), [
            'title' => 'Inference',
            'active' => 'inference'
        ]);
    }

    public function create()
    {
        $user = auth()->user();
        return view('admin.inference-create', compact('user'), [
            'title' => 'Inference',
            'active' => 'inference'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ipk_category' => 'required|string',
            'matkul_category' => 'required|string',
            'sks_category' => 'required|string',
            'min_sks' => 'required|integer',
            'max_sks' => 'required|integer',
        ]);

        InferenceRule::create($request->all());
        return redirect()->route('inference_rule.index')->with('success', 'Rule created successfully.');
    }

    public function edit(InferenceRule $inference_rule)
    {
        $user = auth()->user();
        return view('admin.inference-edit', compact('inference_rule', 'user'), [
            'title' => 'Inference',
            'active' => 'inference'
        ]);
    }

    public function update(Request $request, InferenceRule $inference_rule)
    {
        $request->validate([
            'ipk_category' => 'required|string',
            'matkul_category' => 'required|string',
            'sks_category' => 'required|string',
            'min_sks' => 'required|integer',
            'max_sks' => 'required|integer',
        ]);

        $inference_rule->update($request->all());
        return redirect()->route('inference_rule.index')->with('success', 'Rule updated successfully.');
    }

    public function destroy(InferenceRule $inference_rule)
    {
        $inference_rule->delete();
        return redirect()->route('inference_rule.index')->with('success', 'Rule deleted successfully.');
    }
}
