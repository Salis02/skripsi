@extends('admin.layout.header')

@section('container')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container mx-auto mt-4">
            <h2 class="text-2xl font-bold">Daftar Transkrip</h2>
            <div class="flex justify-start">
                <a href="{{ route('transkrip.create') }}" class="inline-block">
                    <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Tambah Transkrip
                    </button>
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-500 text-white p-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <input type="text" id="search-input" placeholder="Cari Mahasiswa" class="shadow appearance-none border rounded w-full mt-4 mb-4 mx-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">
                            <a href="{{ route('transkrip.index', ['sort' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                Nama Mata Kuliah
                                @if($sortOrder == 'asc')
                                    &#9650; <!-- Icon ascending -->
                                @else
                                    &#9660; <!-- Icon descending -->
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3">Kode Mata Kuliah</th>
                        <th class="px-4 py-3">SKS</th>
                        <th class="px-4 py-3">
                            <a href="{{ route('transkrip.index', ['sort' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                Nama Mahasiswa
                                @if($sortOrder == 'asc')
                                    &#9650; <!-- Icon ascending -->
                                @else
                                    &#9660; <!-- Icon descending -->
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3">Nilai Akhir</th>
                        <th class="px-4 py-3">Bobot</th>
                        <th class="px-4 py-3">Nilai</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody id="transkrip-table-body" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @php
                        $i=1;
                    @endphp
                    @foreach($transkrip as $item)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">{{ $i++ }}</td>
                            <td class="px-4 py-3">{{ $item->matkul->namaMatkul }}</td>
                            <td class="px-4 py-3">{{ $item->matkul->kodeMatkul }}</td>
                            <td class="px-4 py-3">{{ $item->matkul->totalSks }}</td>
                            <td class="px-4 py-3">{{ $item->mahasiswa->name }}</td>
                            <td class="px-4 py-3">{{ $item->nilai_akhir }}</td>
                            <td class="px-4 py-3">{{ $item->bobot }}</td>
                            <td class="px-4 py-3">{{ $item->nilai }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
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
                                    <form action="{{ route('transkrip.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?');">
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

        </div>

    </main>
@endsection
