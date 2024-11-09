@extends('admin.layout.header')

@section('container')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container mx-auto mt-4">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Tambah Transkrip</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white p-2 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('transkrip.store') }}" method="POST" class="px-4 py-3 mb-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
                @csrf
                <div class="mb-4">
                    {{-- <label for="matkul_id" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Mata Kuliah:</label>
                    <select name="matkul_id" id="matkul_id" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
                        <option value="">--Pilih Mata Kuliah--</option>
                        @foreach($matkuls as $matkul)
                            <option value="{{ $matkul->id }}" data-sks="{{ $matkul->totalSks }}">{{ $matkul->namaMatkul }}</option>
                        @endforeach
                    </select> --}}
                    <label for="matkul_id" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Mata Kuliah:</label>
                    <input list="matkul_list" name="matkul_id" id="matkul_id_input" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Masukkan mata kuliah" required>
                    <datalist id="matkul_list">
                        @foreach($matkuls as $matkul)
                            <option value="{{ $matkul->id }}" data-sks="{{ $matkul->totalSks }}">{{ $matkul->namaMatkul }}</option>
                        @endforeach
                    </datalist>

                </div>

                <div class="mb-4">
                    <label for="mahasiswa_id" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Mahasiswa:</label>
                    <select name="mahasiswa_id" id="mahasiswa_id" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
                        <option value="">--Pilih Mahasiswa--</option>
                        @foreach($mahasiswas as $mahasiswa)
                            <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-4">
                    <label for="nilai" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Nilai:</label>
                    <input type="text" name="nilai" id="nilai" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                </div>
                <div class="mb-4">
                    <label for="bobot" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Bobot:</label>
                    <input type="number" step="0.01" name="bobot" id="bobot" value="{{ old('bobot', $transkrip->bobot ?? '') }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                </div>

                <div class="mb-4">
                    <label for="nilai_akhir" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Nilai Akhir:</label>
                    <input type="number" step="0.01" name="nilai_akhir" id="nilai_akhir" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" readonly>
                </div>

                <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Simpan</button>
            </form>

            <form action="{{ route('transkrip.storeBatch') }}" method="POST" class="px-4 py-3 mb-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
                @csrf
                <div class="mb-4">
                    <label for="mahasiswa_id" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Mahasiswa:</label>
                    <select name="mahasiswa_id" id="mahasiswa_id" class="block w-full mt-1 text-sm form-input" required>
                        <option value="">--Pilih Mahasiswa--</option>
                        @foreach($mahasiswas as $mahasiswa)
                            <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                @for($i = 0; $i < 17; $i++)
                    <div class="mb-4">
                        <label for="matkul_id_{{ $i }}" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Mata Kuliah {{ $i + 1 }}:</label>
                        <select name="matkul_id[]" id="matkul_id_{{ $i }}" class="block w-full mt-1 text-sm form-input" required>
                            <option value="">--Pilih Mata Kuliah--</option>
                            @foreach($matkuls as $matkul)
                                <option value="{{ $matkul->id }}">{{ $matkul->namaMatkul }}</option>
                            @endforeach
                        </select>
                        
                        
                    </div>
            
                    <div class="mb-4">
                        <label for="nilai_{{ $i }}" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Nilai:</label>
                        <input type="text" name="nilai[]" id="nilai_{{ $i }}" class="block w-full mt-1 text-sm form-input" required>
                    </div>
            
                    <div class="mb-4">
                        <label for="bobot_{{ $i }}" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Bobot:</label>
                        <input type="number" step="0.01" name="bobot[]" id="bobot_{{ $i }}" class="block w-full mt-1 text-sm form-input" required>
                    </div>
            
                    <div class="mb-4">
                        <label for="nilai_akhir_{{ $i }}" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Nilai Akhir:</label>
                        <input type="number" step="0.01" name="nilai_akhir[]" id="nilai_akhir_{{ $i }}" class="block w-full mt-1 text-sm form-input" required>
                    </div>
                    <hr class="mb-4">
                @endfor
            
                <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-purple-600 rounded-lg">Simpan</button>
            </form>
            

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const matkulInput = document.getElementById('matkul_id_input');
                    const matkulList = document.getElementById('matkul_list');
                    const bobotInput = document.getElementById('bobot');
                    const nilaiAkhirInput = document.getElementById('nilai_akhir');
            
                    function calculateNilaiAkhir() {
                        const bobot = parseFloat(bobotInput.value.replace(',', '.')) || 0;
                        const selectedMatkul = Array.from(matkulList.options).find(option => option.value === matkulInput.value);
                        const totalSks = selectedMatkul ? parseFloat(selectedMatkul.getAttribute('data-sks')) : 0;
                        const nilaiAkhir = bobot * totalSks;
                        nilaiAkhirInput.value = nilaiAkhir.toFixed(2);
                    }
            
                    matkulInput.addEventListener('input', calculateNilaiAkhir);
                    bobotInput.addEventListener('input', calculateNilaiAkhir);
            
                    document.getElementById('mahasiswa_id').addEventListener('change', function() {
                        const mahasiswaId = this.value;
                        const semesterId = this.options[this.selectedIndex].dataset.semesterId;
            
                        fetch(`/admin/matkul/${semesterId}`)
                            .then(response => response.json())
                            .then(data => {
                                matkulList.innerHTML = '';
                                data.forEach(matkul => {
                                    const option = document.createElement('option');
                                    option.value = matkul.id;
                                    option.textContent = matkul.namaMatkul;
                                    option.setAttribute('data-sks', matkul.totalSks);
                                    matkulList.appendChild(option);
                                });
                            });
                    });
                });
                document.addEventListener('DOMContentLoaded', function () {
                const bobotInputs = document.querySelectorAll('[id^="bobot"]');
                const nilaiAkhirInputs = document.querySelectorAll('[id^="nilai_akhir"]');
                
                bobotInputs.forEach((bobotInput, index) => {
                    const matkulInput = document.getElementById(`matkul_id_input_${index}`);
                    const matkulList = document.getElementById(`matkul_list_${index}`);
                    const nilaiAkhirInput = nilaiAkhirInputs[index];

                    function calculateNilaiAkhir() {
                        const bobot = parseFloat(bobotInput.value.replace(',', '.')) || 0;
                        const selectedMatkul = Array.from(matkulList.options).find(option => option.value === matkulInput.value);
                        const totalSks = selectedMatkul ? parseFloat(selectedMatkul.getAttribute('data-sks')) : 0;
                        const nilaiAkhir = bobot * totalSks;
                        nilaiAkhirInput.value = nilaiAkhir.toFixed(2);
                    }

                    matkulInput.addEventListener('input', calculateNilaiAkhir);
                    bobotInput.addEventListener('input', calculateNilaiAkhir);
                });
            });
            </script>
        </div>
    </main>
@endsection
