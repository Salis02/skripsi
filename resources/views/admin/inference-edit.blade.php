@extends('dosen.layout.header')

@section('container')
<div class="container">
    <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Edit Inference Rule</h1>
    <form action="{{ route('inference_rule.update', $inference_rule->id) }}" method="POST" class="px-4 py-3 mb-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="ipk_category" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">IPK Category</label>
            <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="ipk_category" id="ipk_category" name="ipk_category" value="{{ $inference_rule->ipk_category }}" required>
        </div>
        <div class="form-group">
            <label for="matkul_category" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Mata Kuliah Category</label>
            <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="ipk_category" id="matkul_category" name="matkul_category" value="{{ $inference_rule->matkul_category }}" required>
        </div>
        <div class="form-group">
            <label for="sks_category" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">SKS Category</label>
            <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="ipk_category" id="sks_category" name="sks_category" value="{{ $inference_rule->sks_category }}" required>
        </div>
        <div class="form-group">
            <label for="min_sks" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Min SKS</label>
            <input type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="ipk_category" id="min_sks" name="min_sks" value="{{ $inference_rule->min_sks }}" required>
        </div>
        <div class="form-group">
            <label for="max_sks" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Max SKS</label>
            <input type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="ipk_category" id="max_sks" name="max_sks" value="{{ $inference_rule->max_sks }}" required>
        </div>
        <button type="submit" class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Update</button>
    </form>
</div>
@endsection
