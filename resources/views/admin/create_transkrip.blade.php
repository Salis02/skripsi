@extends('admin.layout.header')

@section('container')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container mx-auto mt-4">
            <h2 class="text-2xl font-bold">Tambah Transkrip</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white p-2 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('transkrip.store') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="matkul_id" class="block text-sm">Mata Kuliah:</label>
                    <select name="matkul_id" id="matkul_id" class="w-full border rounded p-2">
                        @foreach($matkuls as $matkul)
                            <option value="{{ $matkul->id }}" data-sks="{{ $matkul->totalSks }}">{{ $matkul->namaMatkul }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-4">
                    <label for="mahasiswa_id" class="block text-sm">Mahasiswa:</label>
                    <select name="mahasiswa_id" id="mahasiswa_id" class="w-full border rounded p-2">
                        @foreach($mahasiswas as $mahasiswa)
                            <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="nilai_akhir" class="block text-sm">Nilai Akhir:</label>
                    <input type="number" step="0.01" name="nilai_akhir" id="nilai_akhir" class="w-full border rounded p-2" readonly>
                </div>

                <div class="mb-4">
                    <label for="nilai" class="block text-sm">Nilai:</label>
                    <input type="text" name="nilai" id="nilai" class="w-full border rounded p-2">
                </div>
                <div class="mb-4">
                    <label for="bobot" class="block text-gray-700 text-sm font-bold mb-2">Bobot:</label>
                    <input type="number" step="0.01" name="bobot" id="bobot" value="{{ old('bobot', $transkrip->bobot ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <button type="submit" class="bg-blue-500 text-white p-2 rounded">Simpan</button>
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
