@extends("dosen.layout.header")

@section('container')
    <h1 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200"> Data Transkrip Nilai </h1> 
    
    <h3 class=" text-sm text- font-semibold text-gray-700 dark:text-gray-200">
        <b>{{ $mahasiswa->nim }}</b> - <b>{{ $mahasiswa->name }}</b></h3>
    <hr>
    @if($transkrip->isEmpty()) 
        <h1 class="mt-4 text-center text-red-700"><b>Tidak ada data transkrip</b></h1> 
    @else
    <table class="w-full table-auto whitespace-wrap text-xs">
        <thead>
            <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-4 py-3" scope="col">Mata Kuliah</th>
                <th class="px-4 py-3" scope="col">Semester</th>
                <th class="px-4 py-3" scope="col">Nilai</th>
                <th class="px-4 py-3" scope="col">SKS</th>
                <th class="px-4 py-3" scope="col">Bobot</th>
                <th class="px-4 py-3" scope="col">Nilai Akhir</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">         
                @foreach ($transkrip as $item)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{ $item->matkul->namaMatkul }}</td>
                        <td class="px-4 py-3">{{ $item->matkul->semesterId }}</td>
                        <td class="px-4 py-3">{{ $item->nilai }}</td>
                        <td class="px-4 py-3">{{ $item->matkul->totalSks }}</td>
                        <td class="px-4 py-3">{{ $item->bobot }}</td>
                        <td class="px-4 py-3">{{ $item->nilai_akhir }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection