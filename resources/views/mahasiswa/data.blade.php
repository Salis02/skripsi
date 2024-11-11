@extends('mahasiswa.layouts.header')

@section('container')
        <div class="container">
          <div class="mt-2 bg-white rounded-lg shadow-md p-6">
              <h1 class="text-2xl font-bold text-gray-800 mb-4">DATA MAHASISWA</h1>
            <div class="flex">
              <div class="bg-gray-800 rounded-full p-4 mr-6">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
              <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ $mahasiswa->name }}</h2>
                <p class="text-gray-600">{{ $mahasiswa->nim }}</p>
              </div>
            </div>
            <div class="mt-8">
              <h3 class="text-lg font-bold text-gray-800">Informasi Pribadi</h3>
              <table class="mt-2 min-w-full bg-white">
                <tbody>
                  <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->name }}</td>
                  </tr>
                  <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->nim }}</td>
                  </tr>
                  <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->tanggal_lahir }}</td>
                  </tr>
                  <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->jenis_kelamin }}</td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->user->email }}</td>
                  </tr>
                  <tr>
                    <td>Dosen Pembimbing</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->dosen->name }}</td>
                  </tr>
                  <tr>
                    <td>Indeks Prestasi</td>
                    <td>:</td>
                    <td>{{ number_format($indeksPrestasi, 2) }}</td>
                  </tr>
                  <tr>
                    <td>Total SKS</td>
                    <td>:</td>
                    <td>{{ $totalSks }} SKS</td>
                  </tr>
                  <tr>
                    <td>Total Nilai Akhir</td>
                    <td>:</td>
                    <td>{{ $totalNilaiSks }}</td>
                  </tr>
                </tbody>
              </table>
              
            </div>
          </div>
          @php
              // Mengelompokkan transkrip berdasarkan semester
              $transkripBySemester = $transkrip->groupBy(function($item) {
                  return $item->matkul->semester->semester; // Ganti dengan atribut yang sesuai
              });

              // Mengurutkan semester dari yang terkecil ke yang terbesar
              $sortedSemesters = $transkripBySemester->keys()->sort()->values();
          @endphp

          <div class="mt-2 bg-white rounded-lg shadow-md p-6">
            <h1 class="text-center text-xl font-bold">TRANSKRIP NILAI</h1>
            @foreach($sortedSemesters as $semester)
                <h3 class="mt-4 text-lg font-semibold">Semester {{ $semester }}</h3>
                <table class="mt-2 min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="text-left">
                            <th class="py-2 px-4 border-b">Nama Mata Kuliah</th>
                            <th class="py-2 px-4 border-b">SKS</th>
                            <th class="py-2 px-4 border-b">Nilai</th>
                            <th class="py-2 px-4 border-b">Bobot</th>
                            <th class="py-2 px-4 border-b">Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transkripBySemester[$semester] as $item)
                            <tr>
                                <td class="w-1/2 py-2 px-4 border-b">{{ $item->matkul->namaMatkul }}</td>
                                <td class="py-2 px-4 border-b">{{ $item->matkul->totalSks }}</td>
                                <td class="py-2 px-4 border-b">{{ $item->nilai }}</td>
                                <td class="py-2 px-4 border-b">{{ $item->bobot }}</td>
                                <td class="py-2 px-4 border-b">{{ $item->nilai_akhir }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
          </div>
        </div>
        
@endsection
