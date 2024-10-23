@extends('dosen.layout.header')

@section('container')
    <h1 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">
        Data Mahasiswa Bimbingan
    </h1>
    {{-- <p>{{ $dosenId->name }}</p> --}}
    <div class="w-full overflow-x-auto shadow-md">
        <table class="w-full table-auto whitespace-wrap text-xs">
            <thead>
                <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3" scope="col">No.</th>
                    <th class="px-4 py-3" scope="col">Nama/NIM Mahasiswa</th>
                    <th class="px-4 py-3" scope="col">Email</th>
                    <th class="px-4 py-3" scope="col">Semester</th>
                    <th class="px-4 py-3" scope="col">Tanggal Lahir</th>
                    <th class="px-4 py-3" scope="col">Jenis Kelamin</th>
                    <th class="px-4 py-3" scope="col">Opsi</th>
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
                        <td class="px-4 py-3">
                            <a href="{{ route('dosen.transkrip', $mahasiswa->id) }}">
                                <button class="text-1rem font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Lihat Transkrip
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
