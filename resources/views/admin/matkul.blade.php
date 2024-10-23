@extends('admin.layout.header')

@section('container') 
<div class="bg-white mt-4 px-2 rounded-lg dark:bg-gray-700">

    <h2
          class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200"
        >
          Kelola Matkul
        </h2>
        <div class="flex justify-start">
            <a href="{{ route('matkul.create') }}" class="inline-block">
                <button
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
                Tambah Mata Kuliah
              </button>
            </a>
        </div>
        
        @if(session('success'))
            <div class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-black transition-colors duration-150 bg-green-100 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-purple">
                {{ session('success') }}
            </div>
        @endif
    
        <form action="{{ route('matkul.index') }}" method="GET" class="mt-4 flex justify-end">
            @csrf
        
            <!-- Input untuk pencarian berdasarkan kode atau nama matkul -->
            <input type="text" name="search" placeholder="Cari berdasarkan kode atau nama matkul" class="block w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input shadow-md" value="{{ request()->get('search') }}">
        
            <!-- Dropdown untuk memilih semester -->
            <select name="semesterId" class="ml-4 mr-2 block w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input shadow-md">
                <option value="">-- Pilih Semester --</option>
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}" {{ request()->get('semesterId') == $semester->id ? 'selected' : '' }}>
                        Semester {{ $semester->semester }}
                    </option>
                @endforeach
            </select>
        
            <!-- Tombol submit -->
            <button type="submit" class="flex px-4 py-2 bg-blue-500 text-white rounded-lg">
                <svg class="h-5 w-5 text-gray-900"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="11" cy="11" r="8" />  <line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
                Cari
            </button>
        </form>

    <div class="w-full mt-2 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto ">
            <table class="w-full md:table-auto whitespace-wrap text-sm">
                <thead>
                    <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3 w-1/12">No.</th>
                        <th class="px-4 py-3 w-2/12">Kode/Nama Matkul</th>
                        <th class="px-4 py-3 w-1/12">Total SKS</th>
                        <th class="px-4 py-3 w-2/12">Type</th>
                        <th class="px-4 py-3 w-2/12">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
    
                    @php
                        $i = 1;
                    @endphp
    
                    <!-- Looping melalui setiap kelompok berdasarkan semester -->
                    @foreach ($groupedMatkuls as $semester => $matkuls)
                        <!-- Header untuk setiap semester -->
                        <tr>
                            <td colspan="7" class="text-lg font-semibold bg-gray-100 dark:bg-gray-700 dark:text-gray-400 text-center">
                                Semester {{ $semester }}
                            </td>
                        </tr>
    
                        <!-- Looping mata kuliah dalam setiap semester -->
                        @foreach ($matkuls as $matkul)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">{{ $i++ }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div>
                                          <p class="font-semibold">{{ $matkul->kodeMatkul }}</p>
                                          <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $matkul->namaMatkul }}
                                          </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">{{ $matkul->totalSks }}</td>
                                <td class="px-4 py-3">{{ $matkul->typeMatkul ? $matkul->typeMatkul->sifat : 'N/A' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <a class="btn btn-outline-warning" href="{{ route('matkul.edit', $matkul->id) }}">
                                            <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                </svg>
                                            </button>
                                          </a>
    
                                          <form action="{{ route('matkul.destroy', $matkul->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?');">
                                            @csrf
                                            @method('DELETE')
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
                                        </form>
                                        
                                        
                                    </div>
                                </td>
                            </tr>
                        @endforeach
    
                    @endforeach
                </tbody>
            </table>
    
        </div>
        @if ($totalSks !== null)
        <table class="w-full md:table-fixed whitespace-no-wrap text-sm">
            <thead>
                <tr class="text-xl font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Jumlah SKS</th>
                    <th class="px-4 py-3">{{ $totalSks }} SKS</th>
                </tr>
            </thead>
        </table>        
        @endif
    </div>
</div>

@endsection
