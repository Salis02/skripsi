@extends('admin.layout.header')

@section('container')
<div class="container">
    <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Tambah Aturan Inferensi</h1>
    <form action="{{ route('inference_rule.store') }}" method="POST" class="px-4 py-3 mb-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        <div class="form-group">
            <label for="ipk_category" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="variabel">IPK Category</label>
            <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="ipk_category" name="ipk_category" required>
        </div>
        <div class="form-group">
            <label for="matkul_category" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Mata Kuliah Category</label>
            <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="matkul_category" name="matkul_category" required>
        </div>
        <div class="form-group">
            <label for="sks_category" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">SKS Category</label>
            <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="sks_category" name="sks_category" required>
        </div>
        <div class="form-group">
            <label for="min_sks" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Min SKS</label>
            <input type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="min_sks" name="min_sks" min="15" max="24" required>
        </div>
        <div class="form-group">
            <label for="max_sks" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Max SKS</label>
            <input type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="max_sks" name="max_sks" min="15" max="24" required>
        </div>
        <button type="submit" class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Save</button>
    </form>
</div>
@endsection
