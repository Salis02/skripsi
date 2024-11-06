@extends('admin.layout.header')

@section('container')
<div class="bg-white mt-4 px-2 rounded-lg dark:bg-gray-700">
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container mx-auto mt-4">
            <h2 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">Transkrip Mahasiswa: {{ $mahasiswa->name }}</h2>
            <div class="flex justify-start mb-4">
                <a href="{{ route('transkrip.create') }}" class="inline-block">
                    <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Tambah Transkrip
                    </button>
                </a>
                <a href="{{ route('transkrip.mahasiswa') }}" class="ml-2 inline-block">
                    <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-lg active:bg-gray-600 hover:bg-gray-700 focus:outline-none focus:shadow-outline-gray">
                        Kembali ke Daftar Mahasiswa
                    </button>
                </a>
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
                                <th class="px-4 py-3">Kode Matkul</th>
                                <th class="px-4 py-3">Nama Mata Kuliah</th>
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
                                $i = ($transkrips->currentPage() - 1) * $transkrips->perPage() + 1;
                            @endphp
                            @foreach($transkrips as $transkrip)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">{{ $i++ }}</td>
                                    <td class="px-4 py-3">{{ $transkrip->matkul->kodeMatkul }}</td>
                                    <td class="px-4 py-3">{{ $transkrip->matkul->namaMatkul }}</td>
                                    <td class="px-4 py-3">{{ $transkrip->semester->namaSemester }}</td>
                                    <td class="px-4 py-3">{{ $transkrip->matkul->totalSks }}</td>
                                    <td class="px-4 py-3">{{ $transkrip->nilai_akhir }}</td>
                                    <td class="px-4 py-3">{{ $transkrip->bobot }}</td>
                                    <td class="px-4 py-3">{{ $transkrip->nilai }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-center text-sm">
                                            <a class="btn btn-outline-warning" href="{{ route('transkrip.edit', $transkrip->id) }}">
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
                                            <form action="{{ route('transkrip.destroy', $transkrip->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transkrip ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                    aria-label="Delete"
                                                    type="submit"
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
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="px-4 py-3">
                {{ $transkrips->links() }}
            </div>            

        </div>

    </main>
</div>
@endsection

<script>
    document.getElementById('search-input')?.addEventListener('input', function() {
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
