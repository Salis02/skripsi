@extends('admin.layout.header')

@section('container')
<div class="container">
    <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Tambah Fuzzy Range Baru</h1>

    <form action="{{ route('fuzzyRange.store') }}" method="POST" class="px-4 py-3 mb-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="variabel">Variabel</label>
            <input type="text" name="variabel" id="variabel" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="category">Kategori</label>
            <input type="text" name="category" id="category" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="min_value">Nilai Minimum</label>
            <input type="number" name="min_value" min="0" id="min_value" step="0.01" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="max_value">Nilai Maksimum</label>
            <input type="number" name="max_value" min="0" id="max_value" step="0.01" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
        </div>
        <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Simpan</button>
    </form>
</div>
@endsection
