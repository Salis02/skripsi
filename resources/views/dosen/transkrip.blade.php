@extends("dosen.layout.header")

@section('container')
    <h1 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200"> Data Transkrip Nilai </h1> 
    
    <h3 class=" text-sm text- font-semibold text-gray-700 dark:text-gray-200">
        <b>{{ $mahasiswa->nim }}</b> - <b>{{ $mahasiswa->name }}</b></h3>
    <hr>
    @if($transkrip->isEmpty()) 
    <div class="bg-red-100 mt-2 rounded-md flex flex-col items-center justify-center">
        <svg class="h-20 w-20 text-red-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z"/>
          <circle cx="10" cy="10" r="7" />
          <line x1="8" y1="8" x2="12" y2="12" />
          <line x1="12" y1="8" x2="8" y2="12" />
          <line x1="21" y1="21" x2="15" y2="15" />
        </svg>
        <h1 class="text-md text-red-700">Tidak ada data transkrip</h1>
      </div>
    @else
    <table class="w-full table-auto whitespace-wrap text-md">
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
        </tbody>
    </table>
    <table class="mt-4 w-full table-auto whitespace-wrap text-md">
        <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <td class="px-4 py-3">Total SKS</td>
            <td class="px-4 py-3">:</td>
            <td class="px-4 py-3">{{ $totalSks }}</td>
        </tr>
        <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <td class="px-4 py-3">Total Nilai SKS</td>
            <td class="px-4 py-3">:</td>
            <td class="px-4 py-3">{{ $totalNilaiSks }}</td>
        </tr>
        <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <td class="px-4 py-3">Jumlah IPK</td>
            <td class="px-4 py-3">:</td>
            <td class="px-4 py-3">{{ number_format($indeksPrestasi, 2) }}</td>
        </tr>
        @endif
    </table>
@endsection