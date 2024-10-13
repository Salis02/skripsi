@extends('mahasiswa.layouts.header')

@section('container')
        <div class="container">
          <div class="mt-8 bg-white rounded-lg shadow-md p-6">
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
              <div class="mt-4">
                <div class="flex items-center">
                  <span class="text-gray-600 mr-4">Nama</span>
                  <span class="text-gray-800">:</span>
                  <span class="text-gray-800 ml-4">{{ $mahasiswa->name }}</span>
                </div>
                <div class="flex items-center mt-2">
                    <span class="text-gray-600 mr-4">NIM</span>
                    <span class="text-gray-800">:</span>
                    <span class="text-gray-800 ml-4">{{ $mahasiswa->nim }}</span>
                </div>
                <div class="flex items-center mt-2">
                    <span class="text-gray-600 mr-4">Tempat/Tanggal Lahir</span>
                    <span class="text-gray-800">:</span>
                    <span class="text-gray-800 ml-4">{{ $mahasiswa->tanggal_lahir }}</span>
                </div>
                <div class="flex items-center mt-2">
                    <span class="text-gray-600 mr-4">Jenis Kelamin</span>
                    <span class="text-gray-800">:</span>
                    <span class="text-gray-800 ml-4">{{ $mahasiswa->jenis_kelamin }}</span>
                </div>
                <div class="flex items-center mt-2">
                    <span class="text-gray-600 mr-4">Email</span>
                    <span class="text-gray-800">:</ span>
                        <span class="text-gray-800 ml-4">{{ $mahasiswa->user->email }}</span>
                </div>
                <div class="flex items-center mt-2">
                        <span class="text-gray-600 mr-4">Dosen Pembimbing Akademik</span>
                        <span class="text-gray-800">:</span>
                        <span class="text-gray-800 ml-4">{{ $mahasiswa->dosen->name }}</span>
                </div>
                <div class="flex items-center mt-2">
                        <span class="text-gray-600 mr-4">Indeks Prestasi</span>
                        <span class="text-gray-800">:</span>
                        <span class="text-gray-800 ml-4">{{ number_format($indeksPrestasi, 2) }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
