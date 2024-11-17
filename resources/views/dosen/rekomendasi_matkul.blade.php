@extends('dosen.layout.header')

@section('container')
<div class="container p-4">
    <h1 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">Rekomendasi Mata Kuliah</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
    
        <!-- Form Pilihan Mahasiswa -->
        <form method="GET" action="{{ route('rekomendasi_matkul.index') }}" class="mb-4">
            <div class="flex items-center gap-4">
                <hr>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="mahasiswa_id" class="block font-medium mb-2 text-black dark:text-gray-400">Pilih Mahasiswa</label>
                        <select id="mahasiswa_id" name="mahasiswa_id" class="block w-full text-sm text-black dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 form-select shadow-md">
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach ($mahasiswas as $mahasiswa)
                                <option value="{{ $mahasiswa->id }}" {{ $selectedMahasiswa == $mahasiswa->id ? 'selected' : '' }}>
                                    {{ $mahasiswa->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="w-50 mt-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Tampilkan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    
        <!-- Tabel Rekomendasi Mata Kuliah -->
        @if($rekomendasiMatkuls)
            @if ($rekomendasiMatkuls->isNotEmpty())
            <div class="mt-4 w-full overflow-x-auto shadow-md">
                <table class="w-full table-auto whitespace-wrap text-sm">
                    <thead>
                        <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Nama Mahasiswa</th>
                            <th class="px-4 py-2">Peminatan</th>
                            <th class="px-4 py-2">Hasil Defuzifikasi</th>
                            <th class="px-4 py-2">Semester</th>
                            <th class="px-4 py-2">Mata Kuliah</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($rekomendasiMatkuls as $index => $rekomendasi)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">{{ $rekomendasi->inputFuzzy->mahasiswa->name }}</td>
                                <td class="px-4 py-2">{{ $rekomendasi->type }}</td>
                                <td class="px-4 py-2">{{ $rekomendasi->inputFuzzy->hasil_defuzzifikasi }}</td>
                                <td class="px-4 py-2">{{ $rekomendasi->matkul->semesterId }}</td>
                                <td class="px-4 py-2">{{ $rekomendasi->matkul->namaMatkul }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex justify-center text-sm">
                                        <a href="{{ route('rekomendasi_matkul.edit', $rekomendasi->id) }}" class="text-gray-700 dark:text-gray-400">
                                            <button
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit"
                                            >
                                                <svg
                                                class="w-5 h-5"
                                                aria-hidden="true"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                                >
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                                ></path>
                                                </svg>
                                            </button>
                                        </a>
                                        <form id="delete-{{ $rekomendasi->id }}" action="{{ route('rekomendasi_matkul.destroy', $rekomendasi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rekomendasi matkul ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <a type="submit" class="btn btn-danger">
                                                <button
                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Delete"
                                                >
                                                    <svg
                                                    class="w-5 h-5"
                                                    aria-hidden="true"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                    >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                    </svg>
                                                </button>
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="mt-2 text-center bg-red-100 dark:bg-gray-800 rounded-lg shadow flex flex-col items-center justify-center">
                <svg class="w-12 h-12 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>
                <p class="text-gray-500 mt-2">Rekomendasi matkul mahasiswa tidak ada.</p>
              </div>
        @endif
        @else
            <div class="mt-2 p=2 text-center bg-red-100 dark:bg-gray-800 rounded-lg shadow flex flex-col items-center justify-center">
                <svg class="w-12 h-12 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M7.05 4.05A7 7 0 0 1 19 9c0 2.407-1.197 3.874-2.186 5.084l-.04.048C15.77 15.362 15 16.34 15 18a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1c0-1.612-.77-2.613-1.78-3.875l-.045-.056C6.193 12.842 5 11.352 5 9a7 7 0 0 1 2.05-4.95ZM9 21a1 1 0 0 1 1-1h4a1 1 0 1 1 0 2h-4a1 1 0 0 1-1-1Zm1.586-13.414A2 2 0 0 1 12 7a1 1 0 1 0 0-2 4 4 0 0 0-4 4 1 1 0 0 0 2 0 2 2 0 0 1 .586-1.414Z" clip-rule="evenodd"/>
                  </svg>
                  
                <p class="text-gray-500 mt-2">Pilih mahasiswa dahulu untuk melihat rekomendasi mata kuliah.</p>
            </div>
        @endif
    </div>
</div>
@endsection
