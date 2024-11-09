@extends('admin.layout.header')

@section('container')
<div class="bg-white mt-4 px-2 rounded-lg dark:bg-gray-700">
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container mx-auto mt-4">
            <h2 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">Daftar Transkrip</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex justify-start">
                    <a href="{{ route('transkrip.create') }}" class="inline-block">
                        <button class="w-50 mb-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Tambah Transkrip
                        </button>
                    </a>
                </div>
            
                <form action="{{ route('transkrip.index') }}" method="GET" class="flex justify-end">
                    <input type="text" id="search-input" name="search" placeholder="Cari Mahasiswa" class="block w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input shadow-md">
                    <button type="submit" class="h-full w-50 mb-2 ml-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple flex items-center">
                        <svg class="h-4 w-4 text-red-500 mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"/>
                            <circle cx="10" cy="10" r="7" />
                            <line x1="21" y1="21" x2="15" y2="15" />
                        </svg>
                        Cari
                    </button>
                </form>
            </div>

            <form action="{{ route('transkrip.index') }}" method="GET" class="flex justify-end">
                <select name="mahasiswa_id" class="block w-full text-sm dark:border-gray-600 dark:bg-gray-700 form-select shadow-md" onchange="this.form.submit()">
                    <option value="">Pilih Mahasiswa</option>
                    @foreach($mahasiswas as $mahasiswa)
                        <option value="{{ $mahasiswa->id }}" {{ request('mahasiswa_id') == $mahasiswa->id ? 'selected' : '' }}>
                            {{ $mahasiswa->name }}
                        </option>
                    @endforeach
                </select>
            </form>

            @if(session('success'))
                <div class="mt-2 px-2 py-2 text-sm font-medium leading-5 text-black transition-colors duration-150 bg-green-100 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-purple">
                    {{ session('success') }}
                </div>
            @endif

            <div class="w-full mt-2 overflow-hidden rounded-lg shadow-md">
                <div class="w-full overflow-x-auto ">
                    @if($transkrip->isEmpty())
                        <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                            Mahasiswa ini tidak memiliki data transkrip.
                        </div>
                    @else
                            <table class="w-full whitespace-wrap text-sm">
                                <thead>
                                    <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">No.</th>
                                        <th class="px-4 py-3">Nama Mahasiswa</th>
                                        <th class="px-4 py-3">Kode/Nama Mata Kuliah</th>
                                        <th class="px-4 py-3">Semester</th>
                                        <th class="px-4 py-3">SKS</th>
                                        <th class="px-4 py-3">Nilai Akhir</th>
                                        <th class="px-4 py-3">Bobot</th>
                                        <th class="px-4 py-3">Nilai</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="transkrip-table-body" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @php
                                        $i = ($transkrip->currentPage() - 1) * $transkrip->perPage() + 1;
                                    @endphp
                                    @foreach($transkrip as $item)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">{{ $i++ }}</td>
                                            <td class="px-4 py-3">{{ $item->mahasiswa->name }}</td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                    <p class="font-semibold">{{ $item->matkul->kodeMatkul }}</p>
                                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                                        {{ $item->matkul->namaMatkul }}
                                                    </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">{{ $item->matkul->semester->semester }}</td>
                                            <td class="px-4 py-3">{{ $item->matkul->totalSks }}</td>
                                            <td class="px-4 py-3">{{ $item->nilai_akhir }}</td>
                                            <td class="px-4 py-3">{{ $item->bobot }}</td>
                                            <td class="px-4 py-3">{{ $item->nilai }}</td>
                                            <td class="px-4 py-3">
                                                <div class="flex justify-center text-sm">
                                                    {{-- <a href="{{ route('transkrip.edit', $item->id) }}" class="text-blue-500">Edit</a> --}}
                                                    <a class="btn btn-outline-warning" href="{{ route('transkrip.edit', $item->id) }}">
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
                                                    <form action="{{ route('transkrip.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transkrip ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="btn btn-outline-danger" type="submit">
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
                    @endif        
                </div>
                
            </div>
            <div class="px-4 py-3">
                {{ $transkrip->appends(request()->query())->links() }}
            </div>            


        </div>

    </main>
</div>
@endsection
            <script>
                document.getElementById('search-input').addEventListener('input', function() {
                    let filter = this.value.toLowerCase();
                    let rows = document.querySelectorAll('#transkrip-table-body tr');

                    rows.forEach(function(row) {
                        let name = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                        if (name.includes(filter)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            </script>
