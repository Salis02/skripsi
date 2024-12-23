@extends('admin.layout.header')

@section('container')
<div class="container">
    <h1 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">Aturan Inferensi Fuzzy</h1>
    <a href="{{ route('inference_rule.create') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Tambah Aturan</a>

    @if(session('success'))
        <div class="mt-4 px-2 py-2 text-sm font-medium leading-5 text-black dark:text-gray-400 dark:bg-gray-800 transition-colors duration-150 bg-green-100 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-purple">
            {{ session('success') }}
        </div>
    @endif
    <div class="mt-4 w-full overflow-x-auto shadow-md">
        <table class="w-full table-auto whitespace-wrap text-sm">
            <thead>
                <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-2">No.</th>
                    <th class="px-4 py-2">IPK Category</th>
                    <th class="px-4 py-2">Mata Kuliah Category</th>
                    <th class="px-4 py-2">SKS Category</th>
                    <th class="px-4 py-2">Min SKS</th>
                    <th class="px-4 py-2">Max SKS</th>
                    <th class="px-4 py-2">Actions</th>
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
                        <td class="px-4 py-2">
                            <div class="flex justify-center text-sm">
                                <a href="{{ route('inference_rule.edit', $rule->id) }}" class="btn btn-warning">
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
                                <form action="{{ route('inference_rule.destroy', $rule->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aturan ini?');">
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
</div>
@endsection
