@extends('admin.layout.header')

@section('container')
    <h1
      class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200"
    >
      Dashboard
    </h1>

    @if(session('success'))
        <div class="px-4 py-2 text-sm font-medium leading-5 text-black transition-colors duration-150 bg-green-100 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-purple">
            {{ session('success') }}
        </div>
    @endif

    
    <form action="{{ route('admin.dashboard') }}" method="GET" class="mx-2 my-2">
        @csrf
        <div
        class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
        >
            <div class="absolute inset-y-0 flex items-center pl-2">
            <svg
                class="w-4 h-4"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
            >
                <path
                fill-rule="evenodd"
                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                clip-rule="evenodd"
                ></path>
            </svg>
            </div>
            <input
            class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
            type="text" name="search" placeholder="Cari Dosen atau Mahasiswa" value="{{ request()->get('search') }}"
            aria-label="Search"
            />
        </div>
        <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" type="submit">Cari</button>
    </form>

    <h2 class="mb-2 text-xl font-semibold text-gray-700 dark:text-gray-200">Data Admin</h2>
    <div class="flex justify-start">

        <a href="/admin/admin/create">
            <button
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Tambah Admin
          </button>
        </a>
    </div>
   
        <div class="w-full mt-2 overflow-hidden rounded-lg shadow-md">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-wrap ">
                    <thead>
                        <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3" scope="col">No.</th>
                            <th class="px-4 py-3" scope="col">Nama</th>
                            <th class="px-4 py-3" scope="col">Username/Email</th>
                            {{-- <th class="px-4 py-3" scope="col">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                    >
                        @php
                            $i = 1; // Inisialisasi variabel di luar loop
                        @endphp
                        @foreach ($admins as $admin )
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">{{ $i++ }}</td>
                                <td class="px-4 py-3">{{ $admin->name }}</td>
                                <td class="px-4 py-3">{{ $admin->email }}</td>
                                {{-- <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a class="btn btn-outline-warning" href="{{ route('admin.editAdmin', $admin) }}">
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
                                      </div>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
        <br>
        <h2 class="mb-2 text-xl font-semibold text-gray-700 dark:text-gray-200">Data Dosen</h2>
        <div class="flex justify-start">
            <a class="btn btn-outline-info mb-2" href="/admin/dosen/create">
                <button
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
                Tambah Dosen
              </button>
            </a>
        </div>
        
        <div class="w-full overflow-x-auto shadow-md">
            <table class="w-full table-auto whitespace-wrap">
                <thead>
                    <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3" scope="col">No.</th>
                        <th class="px-4 py-3" scope="col">Nama</th>
                        <th class="px-4 py-3" scope="col">Username/Email</th>
                        <th class="px-4 py-3" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @php
                        $i = 1; // Inisialisasi variabel di luar loop
                    @endphp
                    @foreach ($dosens as $dosen)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">{{ $i++ }}</td>
                            <td class="px-4 py-3">{{ $dosen->name }}</td>
                            <td class="px-4 py-3">{{ $dosen->user->email ?? 'N/A' }}</td> <!-- Menampilkan email dari relasi user -->
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <a class="btn btn-outline-warning" href="/admin/dosen/{{ $dosen->id }}/edit">
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
                                    <form action="/admin/dosen/{{ $dosen->id }}" method="POST" style="display:inline;" x-data="{ showConfirm: false }" @submit.prevent="if(showConfirm) $el.submit()">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-outline-danger" type="submit" @click="showConfirm = confirm('Are you sure you want to delete this Dosen?')">
                                            <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
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
        <br>
        <h2 class="mb-2 text-xl font-semibold text-gray-700 dark:text-gray-200">Data Mahasiswa</h2>
        <div class="flex justify-start">
            <a class="btn btn-outline-info mb-2" href="/admin/mahasiswa/create">
                <button
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
                Tambah Mahasiswa
              </button>
            </a>
        </div>
        <div class="w-full overflow-x-auto shadow-md">
            <table class="w-full table-auto whitespace-wrap text-xs">
                <thead>
                    <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3" scope="col">No.</th>
                        <th class="px-4 py-3" scope="col">Nama/NIM</th>
                        <th class="px-4 py-3" scope="col">Email</th>
                        <th class="px-4 py-3" scope="col">Semester</th>
                        <th class="px-4 py-3" scope="col">Tanggal Lahir</th>
                        <th class="px-4 py-3" scope="col">Jenis Kelamin</th>
                        <th class="px-4 py-3" scope="col">Dosen Pembimbing</th>
                        <th class="px-4 py-3" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @php
                        $i = 1; // Inisialisasi variabel di luar loop
                    @endphp
                    @foreach ($mahasiswas as $mahasiswa)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">{{ $i++ }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">{{ $mahasiswa->name }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $mahasiswa->nim }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">{{ $mahasiswa->user->email }}</td>
                            <td class="px-4 py-3">{{ $mahasiswa->semester->semester }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('d-m-Y') }}</td>
                            <td class="px-4 py-3">{{ $mahasiswa->jenis_kelamin }}</td>
                            <td class="px-4 py-3">{{ $mahasiswa->dosen->name }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <a class="btn btn-outline-warning" href="/admin/mahasiswa/{{ $mahasiswa->id }}/edit">
                                        <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </button>
                                    </a>
                                    <form action="/admin/mahasiswa/{{ $mahasiswa->id }}" method="POST" style="display:inline;" x-data="{ showConfirm: false }" @submit.prevent="if(showConfirm) $el.submit()">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-outline-danger" type="submit" @click="showConfirm = confirm('Are you sure you want to delete this Mahasiswa?')">
                                            <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
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
        
        
    
@endsection
