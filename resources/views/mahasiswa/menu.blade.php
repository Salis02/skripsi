@extends('mahasiswa.layouts.header')

@section('container')
<h1 class="text-2xl text-center font-bold mb-5">Silahkan isi data berikut</h1>
<div class="bg-white rounded-lg shadow-lg p-10 w-full">
    <div class="w-full container mx-2 my-2 bg-blue-300 rounded-md">
        @if (isset($message))
            <p>{{ $message }}</p>
        @else
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
                        <label for="matkul_mengulang" class="block text-sm font-medium text-gray-700">Jumlah Mata Kuliah Mengulang:</label>
                        <input type="number" min="0" id="matkul_mengulang" value="{{ old('matkul_mengulang') }}" name="matkul_mengulang" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="form-group">
                        <label for="ipk" class="block text-sm font-medium text-gray-700">IPK Semester Sebelumnya:</label>
                        <input type="float" id="ipk" name="ipk_sebelumnya" value="{{ $indeksPrestasi }}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
                    </div>

                    <div class="form-group">
                        <label for="peminatan" class="block text-sm font-medium text-gray-700">Peminatan:</label>
                        <select name="peminatan" id="peminatan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">-- Pilih Peminatan --</option>
                            <option value="Software Developer">Software Developer</option>
                            <option value="Data Scientist">Data Scientist</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="bg-blue-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Hitung</button>
                </div>
            </form>
        @endif
    </div>
    {{-- @if (isset($recommended_sks))
       <div class= "mx-2 my-2 w-full bg-blue-300 rounded-lg px-4 py-2">
            <div class="bg-gradient-to-r from-sky-50 to-blue-50 p-6 rounded-lg shadow-sm">
                <div class="space-y-2">
                  <h2 class="text-gray-700 font-medium text-xl">REKOMENDASI KRS SEMESTER DEPAN</h2>
                  
                  <div class="flex items-center gap-3">
                    <div class="bg-teal-800 text-white px-4 py-2 rounded-lg font-bold text-xl">
                        {{ $recommended_sks }} SKS
                    </div>
                    <span class="text-sm text-green-600 bg-green-100 px-3 py-1 rounded-full">
                      untuk semester depan ({{ $semester_target }})
                    </span>
                  </div>
                </div>
              </div>
            <div class="mt-4">
                <h4 class="text-gray-700 font-medium text-xl">Paket Rekomendasi Mata Kuliah</h4>
                @forelse($rekomendasi_matkul as $matkul)
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
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $matkul->kodeMatkul }}</td>
                                <td class="py-2 px-4 border-b">{{ $matkul->namaMatkul }}</td>
                                <td class="py-2 px-4 border-b">{{ $matkul->semesterId }}</td>
                                <td class="py-2 px-4 border-b">{{ $matkul->totalSks }}</td>
                                <td class="py-2 px-4 border-b">{{ $matkul->sifat }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @empty
                        <div class="bg-gradient-to-r from-sky-50 to-blue-50 text-center text-lg rounded-xl p-3 flex flex-col items-center">
                            <svg class="h-32 w-32 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="11" cy="11" r="8" />  <line x1="21" y1="21" x2="16.65" y2="16.65" />  <line x1="11" y1="8" x2="11" y2="14" />  <line x1="8" y1="11" x2="14" y2="11" /></svg>
                            <div class="mb-2">Tidak ada paket rekomendasi.</div>
                            <a href="{{ route('data') }}" class="text-blue-500 hover:underline">
                                Lihat Transkrip
                            </a>
                        </div>
                @endforelse
            </div>
       </div>
    @endif --}}

    <!-- Menampilkan hasil fuzzy jika sudah dihitung -->
    @if (isset($recommended_sks))
        <div class="mx-2 my-2 w-full bg-blue-300 rounded-lg px-4 py-2">
            <div class="bg-gradient-to-r from-sky-50 to-blue-50 p-6 rounded-lg shadow-sm">
                <div class="space-y-2">
                    <h2 class="text-gray-700 font-medium text-xl">REKOMENDASI KRS SEMESTER DEPAN</h2>

                    <div class="flex items-center gap-3">
                        <div class="bg-teal-800 text-white px-4 py-2 rounded-lg font-bold text-xl">
                            {{ $recommended_sks }} SKS
                        </div>
                        <span class="text-sm text-green-600 bg-green-100 px-3 py-1 rounded-full">
                        untuk semester depan ({{ $semester_target }})
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-4 table-responsive">
                <h4 class="text-gray-700 font-medium text-xl">Paket Rekomendasi Mata Kuliah</h4>
                
                @if($rekomendasi_matkul->isNotEmpty())
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
                            @foreach($rekomendasi_matkul as $matkul)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $matkul->kodeMatkul }}</td>
                                    <td class="py-2 px-4 border-b">{{ $matkul->namaMatkul }}</td>
                                    <td class="py-2 px-4 border-b">{{ $matkul->semesterId }}</td>
                                    <td class="py-2 px-4 border-b">{{ $matkul->totalSks }}</td>
                                    <td class="py-2 px-4 border-b">{{ $matkul->sifat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="bg-gradient-to-r from-sky-50 to-blue-50 text-center text-lg rounded-xl p-3 flex flex-col items-center">
                        <svg class="h-32 w-32 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            <line x1="11" y1="8" x2="11" y2="14" />
                            <line x1="8" y1="11" x2="14" y2="11" />
                        </svg>
                        <div class="mb-2">Tidak ada paket rekomendasi.</div>
                        <a href="{{ route('data') }}" class="text-blue-500 hover:underline">
                            Lihat Transkrip
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endif


</div>
<div class="mt-2 bg-white rounded-lg shadow-lg p-10 w-full">
    <!-- Cek apakah ada data mata kuliah dengan nilai di bawah C -->
    @if ($nilaiGanjil->isEmpty() && $nilaiGenap->isEmpty())
    <div class="p-4 bg-green-200 rounded-lg">
        <svg class="mx-auto h-20 w-20 text-green-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3" /></svg>
        <p class="text-center mt-2 text-green-900">Tidak ada mata kuliah dengan nilai di bawah C.</p>
    </div>
    @else
    <div class="mx-2 py-2 bg-red-300 rounded-lg">
        <h1 class="text-xl text-center font-bold mb-5">Daftar Mata Kuliah yang Wajib Diambil</h1>
        @php
            $i=1;
        @endphp

        <!-- Tabel Semester Ganjil -->
        <h2 class="text-lg font-semibold m-2">Semester Ganjil</h2>
        <table class="min-w-full bg-red-400 border border-gray-300 mb-4">
            <thead class="text-left">
                <tr>
                    <th class="py-2 px-4 border-b">No.</th>
                    <th class="py-2 px-4 border-b">Kode Mata Kuliah</th>
                    <th class="py-2 px-4 border-b">Nama Mata Kuliah</th>
                    <th class="py-2 px-4 border-b">SKS</th>
                    <th class="py-2 px-4 border-b">Semester</th>
                    <th class="py-2 px-4 border-b">Nilai Akhir</th>
                    <th class="py-2 px-4 border-b">Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nilaiGanjil as $item)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $i++ }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->matkul->kodeMatkul }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->matkul->namaMatkul }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->matkul->totalSks }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->matkul->semester->semester }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->nilai_akhir }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->nilai }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tabel Semester Genap -->
        <h2 class="text-lg font-semibold m-2">Semester Genap</h2>
        <table class="min-w-full bg-red-400 border border-gray-300">
            <thead class="text-left">
                <tr>
                    <th class="py-2 px-4 border-b">No.</th>
                    <th class="py-2 px-4 border-b">Kode Mata Kuliah</th>
                    <th class="py-2 px-4 border-b">Nama Mata Kuliah</th>
                    <th class="py-2 px-4 border-b">SKS</th>
                    <th class="py-2 px-4 border-b">Semester</th>
                    <th class="py-2 px-4 border-b">Nilai Akhir</th>
                    <th class="py-2 px-4 border-b">Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nilaiGenap as $item)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $i++ }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->matkul->kodeMatkul }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->matkul->namaMatkul }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->matkul->totalSks }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->matkul->semester->semester }}</td>
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
