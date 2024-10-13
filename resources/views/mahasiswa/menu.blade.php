@extends('mahasiswa.layouts.header')

@section('container')
<div class="container">
    <h1>Form Input Fuzzy</h1>
    <div class="container">
        <form action="{{ route('calculate.fuzzification') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2 gap-4">

                <div class="form-group">
                    <label for="semester" class="block text-sm font-medium text-gray-700">Semester:</label>
                    <select name="semester" id="semester" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}">{{ $semester->semester }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="matkul_mengulang" class="block text-sm font-medium text-gray-700">Mata Mengulang:</label>
                    <input type="number" id="matkul_mengulang" name="matkul_mengulang" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>

                <div class="form-group">
                    <label for="ipk" class="block text-sm font-medium text-gray-700">IPK Semester Sebelumnya:</label>
                    <input type="float" id="ipk" name="ipk_sebelumnya" value="{{ $indeksPrestasi }}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="form-group">
                    <label for="peminatan" class="block text-sm font-medium text-gray-700">Peminatan:</label>
                    <select name="peminatan" id="peminatan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="Software Developer">Software Developer</option>
                        <option value="Data Scientist">Data Scientist</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 text-center">
                <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Hitung</button>
            </div>
        </form>
    </div>


    <!-- Menampilkan hasil fuzzy jika sudah dihitung -->
    @if (isset($recommended_sks))
        <h2>Hasil Perhitungan Fuzzy</h2>
        <p>Rekomendasi SKS: <strong>{{ $recommended_sks }}</strong> SKS</p>

        <h3>Rekomendasi Mata Kuliah</h3>
        <ul>
            @foreach ($rekomendasi_matkul as $matkul)
                <li>{{ $matkul->nama_matkul }} (Semester: {{ $matkul->semester_id }}, Tipe: {{ $matkul->type }})</li>
            @endforeach
        </ul>
    @endif



@endsection
