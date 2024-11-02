@extends('dosen.layout.header')

@section('container')
<div class="container mx-auto py-8">
    <h1 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">
        Daftar Fuzzy Range
    </h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('fuzzyRange.create') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Tambah Fuzzy Range</a>
    </div>

    <div class="w-full overflow-x-auto shadow-md">
        <table class="w-full table-auto whitespace-wrap text-sm">
            <thead>
            <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Variabel</th>
                <th class="px-4 py-2">Kategori</th>
                <th class="px-4 py-2">Nilai Minimum</th>
                <th class="px-4 py-2">Nilai Maksimum</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($fuzzyRanges as $fuzzyRange)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-2">{{ $fuzzyRange->id }}</td>
                    <td class="px-4 py-2">{{ $fuzzyRange->variabel }}</td>
                    <td class="px-4 py-2">{{ $fuzzyRange->category }}</td>
                    <td class="px-4 py-2">{{ $fuzzyRange->min_value }}</td>
                    <td class="px-4 py-2">{{ $fuzzyRange->max_value }}</td>
                    <td class="px-4 py-2">
                        <div class="flex items-center text-sm">
                            <a href="{{ route('fuzzyRange.edit', $fuzzyRange->id) }}" class="bg-yellow-500 px-2 py-1 rounded">
                                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </button>
                            </a>
                            {{-- <form action="{{ route('fuzzyRange.destroy', $fuzzyRange->id) }}" method="POST" class="inline"  onclick="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"aria-label="Delete">
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
                            </form> --}}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
