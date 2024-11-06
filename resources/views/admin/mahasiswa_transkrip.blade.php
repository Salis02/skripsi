@extends('admin.layout.header')

@section('container')
<div class="bg-white mt-4 px-2 rounded-lg dark:bg-gray-700">
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container mx-auto mt-4">
            <h2 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">Daftar Mahasiswa</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex justify-start">
                    <a href="{{ route('transkrip.create') }}" class="inline-block">
                        <button class="w-50 mb-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Tambah Transkrip
                        </button>
                    </a>
                </div>
            
                <form action="{{ route('transkrip.mahasiswa') }}" method="GET" class="flex justify-end">
                    <input type="text" id="search-input" name="search" placeholder="Cari Mahasiswa" value="{{ $search }}" class="block w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input shadow-md">
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
            @if(session('success'))
                <div class="mt-2 px-2 py-2 text-sm font-medium leading-5 text-black transition-colors duration-150 bg-green-100 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-purple">
                    {{ session('success') }}
                </div>
            @endif

            <div class="w-full mt-2 overflow-hidden rounded-lg shadow-md">
                <div class="w-full overflow-x-auto ">
                    <table class="w-full whitespace-wrap text-sm">
                        <thead>
                            <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">No.</th>
                                <th class="px-4 py-3">Nama Mahasiswa</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="mahasiswa-table-body" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @php
                                $i = ($mahasiswas->currentPage() - 1) * $mahasiswas->perPage() + 1;
                            @endphp
                            @foreach($mahasiswas as $mahasiswa)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">{{ $i++ }}</td>
                                    <td class="px-4 py-3">{{ $mahasiswa->name }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-center text-sm">
                                            <a href="{{ route('transkrip.detail', $mahasiswa->id) }}" class="text-blue-500 mr-2">
                                                <button
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                    aria-label="Lihat Transkrip"
                                                >
                                                    <svg
                                                        class="w-5 h-5"
                                                        aria-hidden="true"
                                                        fill="currentColor"
                                                        viewBox="0 0 20 20"
                                                    >
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM10 17a7 7 0 100-14 7 7 0 000 14z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="px-4 py-3">
                {{ $mahasiswas->links() }}
            </div>            

        </div>

    </main>
</div>
@endsection

<script>
    document.getElementById('search-input').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#mahasiswa-table-body tr');

        rows.forEach(function(row) {
            let name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            if (name.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
