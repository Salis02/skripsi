@extends('admin.layout.header')

@section('container')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container mx-auto mt-4">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Edit Transkrip</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white p-2 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('transkrip.update', $transkrip->id) }}" method="POST" class="px-4 py-3 mb-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="matkul_id" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Mata Kuliah:</label>
                    <select name="matkul_id" id="matkul_id" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                        @foreach($matkuls as $matkul)
                            <option value="{{ $matkul->id }}" data-sks="{{ $matkul->totalSks }}" {{ $transkrip->matkul_id == $matkul->id ? 'selected' : '' }}>{{ $matkul->namaMatkul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="mahasiswa_id" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Mahasiswa:</label>
                    <select name="mahasiswa_id" id="mahasiswa_id" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                        @foreach($mahasiswas as $mahasiswa)
                            <option value="{{ $mahasiswa->id }}" {{ $transkrip->mahasiswa_id == $mahasiswa->id ? 'selected' : '' }}>{{ $mahasiswa->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="nilai_akhir" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Nilai Akhir:</label>
                    <input type="number" step="0.01" name="nilai_akhir" id="nilai_akhir" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $transkrip->nilai_akhir }}" readonly>
                </div>

                <div class="mb-4">
                    <label for="nilai" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Nilai:</label>
                    <input type="text" name="nilai" id="nilai" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $transkrip->nilai }}">
                </div>
                <div class="mb-4">
                    <label for="bobot" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Bobot:</label>
                    <input type="number" step="0.01" name="bobot" id="bobot" value="{{ old('bobot', $transkrip->bobot ?? '') }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                </div>

                <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Update</button>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const matkulSelect = document.getElementById('matkul_id');
                    const bobotInput = document.getElementById('bobot');
                    const nilaiAkhirInput = document.getElementById('nilai_akhir');

                    function calculateNilaiAkhir() {
                        // Ambil nilai bobot dan konversi menjadi angka desimal
                        const bobot = parseFloat(bobotInput.value.replace(',', '.')) || 0;

                        // Ambil totalSks dari matkul yang dipilih
                        const selectedMatkul = matkulSelect.options[matkulSelect.selectedIndex];
                        const totalSks = parseFloat(selectedMatkul.getAttribute('data-sks')) || 0;

                        // Hitung nilai akhir
                        const nilaiAkhir = bobot * totalSks;

                        // Tampilkan hasil ke input nilai_akhir
                        nilaiAkhirInput.value = nilaiAkhir.toFixed(2);
                    }

                    // Event listener untuk matkul dan bobot
                    matkulSelect.addEventListener('change', calculateNilaiAkhir);
                    bobotInput.addEventListener('input', calculateNilaiAkhir);
                });


            </script>
        </div>

    </main>
@endsection
