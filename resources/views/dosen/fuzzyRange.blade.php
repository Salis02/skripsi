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

    <div class="w-full overflow-x-auto shadow-md">
        <table class="w-full table-auto whitespace-wrap text-md">
            <thead>
            <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Variabel</th>
                <th class="px-4 py-2">Kategori</th>
                <th class="px-4 py-2">Nilai Minimum</th>
                <th class="px-4 py-2">Nilai Maksimum</th>
            </tr>
            </thead>
            @php
                $i=1;
            @endphp
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($fuzzyRanges as $fuzzyRange)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-2">{{ $i++ }}</td>
                    <td class="px-4 py-2">{{ $fuzzyRange->variabel }}</td>
                    <td class="px-4 py-2">{{ $fuzzyRange->category }}</td>
                    <td class="px-4 py-2">{{ $fuzzyRange->min_value }}</td>
                    <td class="px-4 py-2">{{ $fuzzyRange->max_value }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
