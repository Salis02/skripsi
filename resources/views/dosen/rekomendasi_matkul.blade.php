@extends('dosen.layout.header')

@section('container')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Kelola Rekomendasi Mata Kuliah</h1>

    <a href="{{ route('rekomendasi_matkul.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Rekomendasi</a>

    <table class="min-w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Semester</th>
                <th class="px-4 py-2">Mata Kuliah</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @foreach($rekomendasiMatkuls as $rekomendasi)
                <tr>
                    <td class="border px-4 py-2">{{ $i++ }}</td>
                    <td class="border px-4 py-2">{{ $rekomendasi->type }}</td>
                    <td class="border px-4 py-2">{{ $rekomendasi->matkul->semesterId }}</td>
                    <td class="border px-4 py-2">{{ $rekomendasi->matkul->namaMatkul }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('rekomendasi_matkul.edit', $rekomendasi->id) }}" class="bg-yellow-500 text-black px-4 py-2 rounded">Edit</a>
                        <button onclick="document.getElementById('delete-{{ $rekomendasi->id }}').submit();" class="bg-red-500 text-black px-4 py-2 rounded">Delete</button>

                        <form id="delete-{{ $rekomendasi->id }}" action="{{ route('rekomendasi_matkul.destroy', $rekomendasi->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
