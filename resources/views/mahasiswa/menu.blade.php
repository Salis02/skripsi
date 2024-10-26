@extends('mahasiswa.layouts.header')

@section('container')
<h1 class="text-2xl text-center font-bold mb-5">Silahkan isi data berikut</h1>
<div class="bg-white rounded-lg shadow-lg p-10 w-full">
    <div class="w-full container mx-2 my-2 bg-teal-500 rounded-md">
        <form action="{{ route('calculate.fuzzification') }}" method="POST" class="py-2 px-2">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <input type="hidden" id="ipk" name="ipk_sebelumnya" value="{{ $mahasiswa->name }}" {{ $mahasiswa->id == $mahasiswa->name ? 'selected' : '' }} class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
                <div class="form-group">  
                    <input type="hidden" name="semester" value="{{ $mahasiswa->semester_id }}">
                    <label for="semester" class="block text-sm font-medium text-gray-700">Semester:</label>
                    <span class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm">
                        
                        @foreach ($semesters as $semester)
                            @if ($semester->id == $mahasiswa->semester_id)
                                {{ $semester->semester }}
                            @endif
                        @endforeach
                    </span>
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
                <button type="submit" class="bg-blue-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Hitung</button>
            </div>
        </form>
    </div>
    <!-- Menampilkan hasil fuzzy jika sudah dihitung -->
    @if (isset($recommended_sks))
       <div class= "mx-2 my-2 w-full bg-blue-300 rounded-lg px-4 py-2">
            <h2 class="text-xl text-left font-bold mb-4">Hasil Perhitungan Fuzzy :</h2>
            <p class="text-lg">Rekomendasi SKS => <span class="bg-green-400 p-1 rounded-md"><b>{{ $recommended_sks }} SKS</b></span></p>
            <div class="mt-4">
                <h4 class="text-lg">Paket Rekomendasi Mata Kuliah</h4>
                <table class="min-w-full text-white bg-cyan-900 border border-gray-300">
                    <thead class="text-left">
                        <tr>
                            <th class="py-2 px-4 border-b">Kode Matkul</th>
                            <th class="py-2 px-4 border-b">Nama Matkul</th>
                            <th class="py-2 px-4 border-b">Semester</th>
                            <th class="py-2 px-4 border-b">Jumlah SKS</th>
                            <th class="py-2 px-4 border-b">Sifat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekomendasi_matkul as $matkul)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $matkul->kodeMatkul }}</td>
                                <td class="py-2 px-4 border-b">{{ $matkul->namaMatkul }}</td>
                                <td class="py-2 px-4 border-b">{{ $matkul->semesterId }}</td>
                                <td class="py-2 px-4 border-b">{{ $matkul->totalSks }}</td>
                                <td class="py-2 px-4 border-b">{{ $matkul->sifat }}</td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Tidak ada rekomendasi mata kuliah untuk semester ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
       </div>
    @endif
</div>
<div class="mt-2 bg-white rounded-lg shadow-lg p-10 w-full">
    <!-- Cek apakah ada data mata kuliah dengan nilai di bawah C -->
    @if ($nilaiDiBawahC->isEmpty())
        <p class="text-red-500">Tidak ada mata kuliah dengan nilai di bawah C.</p>
    @else
    <div class="mx-2 py-2 bg-red-300 rounded-lg">
        <h1 class="text-xl text-center font-bold mb-5">Daftar Mata Kuliah yang mengulang</h1>
            <table class="min-w-full bg-red-400 border border-gray-300">
                <thead class="text-left">
                    <tr>
                        <th class="py-2 px-4 border-b">Kode Mata Kuliah</th>
                        <th class="py-2 px-4 border-b">Nama Mata Kuliah</th>
                        <th class="py-2 px-4 border-b">SKS</th>
                        <th class="py-2 px-4 border-b">Nilai Akhir</th>
                        <th class="py-2 px-4 border-b">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilaiDiBawahC as $item)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $item->matkul->kodeMatkul }}</td>
                            <td class="py-2 px-4 border-b">{{ $item->matkul->namaMatkul }}</td>
                            <td class="py-2 px-4 border-b">{{ $item->matkul->totalSks }}</td>
                            <td class="py-2 px-4 border-b">{{ $item->nilai_akhir }}</td>
                            <td class="py-2 px-4 border-b">{{ $item->nilai }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    @endif
</div>






@endsection
