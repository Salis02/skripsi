@extends('dosen.layout.header')

@section('container')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Rekomendasi Mata Kuliah</h1>

    <form action="{{ route('rekomendasi_matkul.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="type" class="block">Type:</label>
            <input type="text" name="type" id="type" class="border rounded w-full py-2 px-3" value="{{ old('type') }}">
        </div>

        <div class="mb-4">
            <label for="matkul_id" class="block">Mata Kuliah:</label>
            <select name="matkul_id" id="matkul_id" class="border rounded w-full py-2 px-3">
                @foreach($matkuls as $matkul)
                    <option value="{{ $matkul->id }}">{{ $matkul->namaMatkul }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
