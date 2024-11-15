@extends('dosen.layout.header')

@section('container')
<div class="container p-4">
    <h1 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">Kelola Rekomendasi Mata Kuliah</h1>

    <a href="{{ route('rekomendasi_matkul.create') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Tambah Rekomendasi</a>

    <div class="mt-4 w-full overflow-x-auto shadow-md">
        <table class="w-full table-auto whitespace-wrap text-sm">
            <thead>
                <tr class="mt-2 text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nama Mahasiswa</th>
                    <th class="px-4 py-2">Peminatan</th>
                    <th class="px-4 py-2">Hasil Defuzifikasi</th>
                    <th class="px-4 py-2">Peminatan</th>
                    <th class="px-4 py-2">Semester</th>
                    <th class="px-4 py-2">Mata Kuliah</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @php
                    $i=1;
                @endphp
                @foreach($rekomendasiMatkuls as $rekomendasi)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class=" px-4 py-2">{{ $i++ }}</td>
                        <td class=" px-4 py-2">{{ $rekomendasi->inputfuzzy->mahasiswa->name }}</td>
                        <td class=" px-4 py-2">{{ $rekomendasi->type }}</td>
                        <td class=" px-4 py-2">{{ $rekomendasi->inputfuzzy->hasil_defuzzifikasi }}</td>
                        <td class=" px-4 py-2">{{ $rekomendasi->matkul->semesterId }}</td>
                        <td class=" px-4 py-2">{{ $rekomendasi->matkul->namaMatkul }}</td>
                        <td class=" px-4 py-2">
                            <div class="flex items-center text-sm">
                                <a href="{{ route('rekomendasi_matkul.edit', $rekomendasi->id) }}" class="bg-yellow-500 text-black px-4 py-2 rounded">
                                        <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </button>
                                </a>
                                <button onclick="if(confirm('Yakin ingin menghapus?')) { document.getElementById('delete-{{ $rekomendasi->id }}').submit(); }" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                
                                <form id="delete-{{ $rekomendasi->id }}" action="{{ route('rekomendasi_matkul.destroy', $rekomendasi->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 w-full overflow-x-auto shadow-md">
        <table class="w-full table-auto whitespace-wrap text-sm">
            <thead>
                <tr class="mt-2 text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-2">Nama Mahasiswa</th>
                    <th class="px-4 py-2">IPK</th>
                    <th class="px-4 py-2">Peminatan</th>
                    <th class="px-4 py-2">Hasil Defuzzifikasi</th>
                    <th class="px-4 py-2">Mata Kuliah yang Direkomendasikan</th>
                </tr>
            </thead> 
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($mahasiswas as $mahasiswa)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-2">{{ $mahasiswa->user->name }}</td>
                        
                        @php
                            // Ambil inputFuzzy terbaru berdasarkan created_at
                            $inputFuzzy = $mahasiswa->inputFuzzy->sortByDesc('created_at')->first();
                        @endphp
        
                        @if($inputFuzzy)
                            <td class="px-4 py-2">{{ $inputFuzzy->ipk_sebelumnya ?? 'Tidak ada data' }}</td>
                            <td class="px-4 py-2">{{ $inputFuzzy->peminatan ?? 'Tidak ada data' }}</td>
                            <td class="px-4 py-2">{{ $inputFuzzy->hasil_defuzzifikasi ?? 'Tidak ada data' }}</td>
        
                            <td class="px-4 py-2">
                                @if(!$inputFuzzy->rekomendasiMatkul > 0)
                                    <ul>
                                        @foreach($inputFuzzy->rekomendasiMatkul as $rekomendasi)
                                            <li>{{ $rekomendasi->matkul->nama ?? 'Mata kuliah tidak ditemukan' }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>Tidak ada mata kuliah yang direkomendasikan.</p>
                                @endif
                            </td>
                            
                        @else
                            <td colspan="4">Data input fuzzy tidak ditemukan</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
