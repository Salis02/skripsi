@extends('dosen.layout.header')

@section('container')
<div class="container mx-auto p-4">
    <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Tambah Rekomendasi Mata Kuliah</h1>

    <form action="{{ route('rekomendasi_matkul.store') }}" method="POST" class="px-4 py-3 mb-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
        @csrf

        <div class="mb-4">
            <label for="type" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Type:</label>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="text" name="type" id="type" value="{{ old('type') }}">
        </div>

        <div class="mb-4">
            <label for="matkul_id" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Mata Kuliah:</label>
            <select name="matkul_id" id="matkul_id" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                @foreach($matkuls as $matkul)
                    <option value="{{ $matkul->id }}">{{ $matkul->namaMatkul }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
