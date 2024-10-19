@extends('mahasiswa.layouts.header')

@section('container')
<h1 class="text-2xl text-center font-bold mb-5">Silahkan isi data berikut</h1>
<div class="bg-">
    <div class="container mx-2 my-2 bg-gradient-to-r from-green-400 to-blue-400 bg-opacity-75 rounded-md">
        <form action="{{ route('calculate.fuzzification') }}" method="POST" class="py-2 px-2">
            @csrf

            <div class="grid grid-cols-2 gap-4">

                <div class="form-group">
                    <label for="mahasiswa" class="block text-sm font-medium text-gray-700">Mahasiswa</label>
                    <input type="text" id="ipk" name="ipk_sebelumnya" value="{{ $mahasiswa->name }}" {{ $mahasiswa->id == $mahasiswa->name ? 'selected' : '' }} class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="semester" class="block text-sm font-medium text-gray-700">Semester:</label>
                    <select name="semester" id="semester" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}" {{ $semester->id == $mahasiswa->semester_id ? 'selected' : '' }}>
                                {{ $semester->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="matkul_mengulang" class="block text-sm font-medium text-gray-700">Mata Mengulang:</label>
                    <input type="number" min="0" id="matkul_mengulang" name="matkul_mengulang" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
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
</div>


    <!-- Menampilkan hasil fuzzy jika sudah dihitung -->
    @if (isset($recommended_sks))
       <div class= "mx-2 my-2 bg-blue-300 rounded-lg px-4 py-2">
            <h2 class="text-xl text-center font-bold mb-4">Hasil Perhitungan Fuzzy untuk {{ $mahasiswa->name }} adalah sebagai berikut :</h2>
            <p class="text-lg">Rekomendasi SKS => <strong>{{ $recommended_sks }}</strong> SKS</p>

            {{-- <h3>Rekomendasi Mata Kuliah</h3>
            <ul>
                @foreach ($rekomendasi_matkul as $matkul)
                    <li>{{ $matkul->nama_matkul }} (Semester: {{ $matkul->semester_id }}, Tipe: {{ $matkul->type }})</li>
                @endforeach
            </ul> --}}
       </div>
    @endif



@endsection
