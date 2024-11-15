@extends('admin.layout.header')

@section('container')
<div class="container">
    <h2
      class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
    >
        Edit Fuzzy Range
    </h2>

    <form action="{{ route('fuzzyRange.update', $fuzzyRange->id) }}" method="POST" class="px-4 py-3 mb-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="form-group mr-4 mb-4">
                <label for="variabel" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Variabel</label>
                <input type="text" name="variabel" id="variabel" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $fuzzyRange->variabel }}" required>
            </div>
            <div class="form-group mr-4 mb-4">
                <label for="category" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Kategori</label>
                <input type="text" name="category" id="category" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $fuzzyRange->category }}" required>
            </div>
            <div class="form-group mr-4 mb-4">
                <label for="min_value" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Nilai Minimum</label>
                <input type="number" name="min_value" id="min_value" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" step="0.01" value="{{ $fuzzyRange->min_value }}" required>
            </div>
            <div class="form-group mr-4 mb-4">
                <label for="max_value" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Nilai Maksimum</label>
                <input type="number" name="max_value" id="max_value" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" step="0.01" value="{{ $fuzzyRange->max_value }}" required>
            </div>
        </div>
        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Update</button>
    </form>
</div>
@endsection
