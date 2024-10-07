@extends('dosen.layout.header')

@section('container')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Daftar Fuzzy Range</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('fuzzyRange.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Fuzzy Range</a>
    </div>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Variabel</th>
                <th class="px-4 py-2">Kategori</th>
                <th class="px-4 py-2">Nilai Minimum</th>
                <th class="px-4 py-2">Nilai Maksimum</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fuzzyRanges as $fuzzyRange)
            <tr>
                <td class="border px-4 py-2">{{ $fuzzyRange->id }}</td>
                <td class="border px-4 py-2">{{ $fuzzyRange->variable }}</td>
                <td class="border px-4 py-2">{{ $fuzzyRange->category }}</td>
                <td class="border px-4 py-2">{{ $fuzzyRange->min_value }}</td>
                <td class="border px-4 py-2">{{ $fuzzyRange->max_value }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('fuzzyRange.edit', $fuzzyRange->id) }}" class="bg-yellow-500 px-2 py-1 rounded">Edit</a>
                    <form action="{{ route('fuzzyRange.destroy', $fuzzyRange->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-black px-2 py-1 rounded" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
