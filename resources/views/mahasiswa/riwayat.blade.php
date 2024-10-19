@extends('mahasiswa.layouts.header')

@section('container')
<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-4">Riwayat Rekomendasi</h1>
    
    @if ($riwayatRekomendasi->isEmpty())
        <div class="bg-red-100 py-3 rounded-lg flex flex-col justify-center items-center">
            <svg class="h-64 w-64 text-red-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M8 13.5v-4a1.5 1.5 0 0 1 3 0v2.5m0 -2.5v-6a1.5 1.5 0 0 1 3 0v8.5m0 -2.5a1.5 1.5 0 0 1 3 0v2.5m0 -1.5a1.5 1.5 0 0 1 3 0v5.5a6 6 0 0 1 -6 6h-2a7 6 0 0 1 -5 -3l-2.7 -5.25a1.4 1.4 0 0 1 2.75 -2l.9 1.75" /></svg>
            <p class="text-center">Tidak ada riwayat rekomendasi.</p>
        </div>
    @else
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Semester</th>
                    <th class="py-2 px-4 border-b">IPK Sebelumnya</th>
                    <th class="py-2 px-4 border-b">Matkul Mengulang</th>
                    <th class="py-2 px-4 border-b">Peminatan</th>
                    <th class="py-2 px-4 border-b">Hasil Defuzzifikasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayatRekomendasi as $riwayat)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $riwayat->semester_id }}</td>
                        <td class="py-2 px-4 border-b">{{ $riwayat->ipk_sebelumnya }}</td>
                        <td class="py-2 px-4 border-b">{{ $riwayat->matkul_mengulang }}</td>
                        <td class="py-2 px-4 border-b">{{ $riwayat->peminatan }}</td>
                        <td class="py-2 px-4 border-b">{{ $riwayat->hasil_defuzzifikasi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
