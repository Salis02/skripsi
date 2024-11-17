@extends('dosen.layout.header')

@section('container')
<div class="container">
    <h1 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">Aturan Inferensi Fuzzy</h1>
    {{-- <a href="{{ route('inference_rule.create') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Tambah Aturan</a> --}}

    @if(session('success'))
        <div class="mt-4 px-2 py-2 text-sm font-medium leading-5 text-black dark:text-gray-400 dark:bg-gray-800 transition-colors duration-150 bg-green-100 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-purple">
            {{ session('success') }}
        </div>
    @endif
    <div class="mt-4 w-full overflow-x-auto shadow-md">
        <table class="w-full table-auto whitespace-wrap text-md">
            <thead>
                <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-2">No.</th>
                    <th class="px-4 py-2">IPK Category</th>
                    <th class="px-4 py-2">Mata Kuliah Category</th>
                    <th class="px-4 py-2">SKS Category</th>
                    <th class="px-4 py-2">Min SKS</th>
                    <th class="px-4 py-2">Max SKS</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @php
                    $i=1;
                @endphp
                @foreach($rules as $rule)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-2">{{ $i++ }}</td>
                        <td class="px-4 py-2">{{ $rule->ipk_category }}</td>
                        <td class="px-4 py-2">{{ $rule->matkul_category }}</td>
                        <td class="px-4 py-2">{{ $rule->sks_category }}</td>
                        <td class="px-4 py-2">{{ $rule->min_sks }}</td>
                        <td class="px-4 py-2">{{ $rule->max_sks }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
