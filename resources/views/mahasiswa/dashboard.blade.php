@extends('mahasiswa.layouts.header')

@section('container')
    <div class="bg-white rounded-lg shadow-lg p-10 w-full">
        <div class="grid grid-cols-3 gap-6 w-full">
            <a href="{{ route('menu') }}" class="block p-6 bg-teal-500 rounded-lg hover:bg-gray-700 transition">
                <div class="text-center col-span-1 w-full p-4">
                    <svg class="w-12 h-12 mx-auto mb-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span class="text-xl font-bold text-white">Menu Rekomendasi</span>
                    <p class="mt-2 text-md text-white font-thin">Fitur Rekomendasi KRS untuk referensi pengambilan jumlah SKS dan mata kuliah di semester depan</p>
                </div>
            </a>
            <a href="{{ route('data') }}" class="block p-6 bg-teal-500 rounded-lg hover:bg-gray-700 transition">
                <div class="text-center col-span-1 w-full p-4">
                    <svg class="w-12 h-12 mx-auto mb-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="text-xl font-bold text-white">Data Saya</span>
                    <p class="mt-2 text-md text-white font-thin">Lihat data mahasiswa dan transkrip nilai mata kuliah</p>
                </div>
            </a>
            <a href="{{ route('riwayat') }}" class="block p-6 bg-teal-500 rounded-lg hover:bg-gray-700 transition">
                <div class="text-center col-span-1 w-full p-4">
                    <svg class="w-12 h-12 mx-auto mb-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14a7 7 0 00-7 7h4a3 3 0 00-3-3H9a3 3 0 00-3 3h4a7 7 0 007-7zM12 6a5 5 0 00-5 5h4a3 3 0 00-3-3H9a3 3 0 00-3 3h4a5 5 0 005-5z" />
                    </svg>
                    <span class="text-xl font-bold text-white">Riwayat Rekomendasi</span>
                    <p class="mt-2 text-md text-white font-thin">Rincian hasil menu rekomendasi sebelumnya berupa data variabel-variabel fuzzy</p>
                </div>
            </a>
        </div>
    </div>
    <footer class="text-center text-white mt-8">2024, Universitas Alma Ata</footer>
@endsection
