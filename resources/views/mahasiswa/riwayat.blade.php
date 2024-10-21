@extends('mahasiswa.layouts.header')

@section('container')
<div class="container mx-auto bg-gray mt-4">
    <a href="{{ route('menu') }}" class="my-2 bg-teal-500 text-white px-4 py-2 rounded hover:bg-red-700">
        Rekomendasi KRS?
    </a>
    
    <h1 class="text-2xl font-bold my-4">Riwayat Rekomendasi</h1>

    @if (session('success'))
        <div class="bg-green-200 text-black p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    
    @if ($riwayatRekomendasi->isEmpty())
        <div class="bg-red-100 py-3 rounded-lg flex flex-col justify-center items-center">
            <svg class="h-48 w-48 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>             
            <p class="text-center">Tidak ada riwayat rekomendasi.</p>
            <a href="{{ route('menu') }}" class="mt-4 bg-green-500 text-white px-4 py-1 rounded hover:bg-red-700">Rekomendasi KRS?</a>
        </div>
    @else
    @php
        $i = 1;
    @endphp
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="text-left">
                <tr>
                    <th class="py-2 px-4 border-b">No. </th>
                    <th class="py-2 px-4 border-b">Semester</th>
                    <th class="py-2 px-4 border-b">IPK Sebelumnya</th>
                    <th class="py-2 px-4 border-b">Matkul Mengulang</th>
                    <th class="py-2 px-4 border-b">Peminatan</th>
                    <th class="py-2 px-4 border-b">Hasil Defuzzifikasi</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayatRekomendasi as $riwayat)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $i++ }}</td>
                        <td class="py-2 px-4 border-b">{{ $riwayat->semester_id }}</td>
                        <td class="py-2 px-4 border-b">{{ $riwayat->ipk_sebelumnya }}</td>
                        <td class="py-2 px-4 border-b">{{ $riwayat->matkul_mengulang }}</td>
                        <td class="py-2 px-4 border-b">{{ $riwayat->peminatan }}</td>
                        <td class="py-2 px-4 border-b">{{ $riwayat->hasil_defuzzifikasi }}</td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('riwayat.hapus', $riwayat->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 flex text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat ini?')">
                                    <svg class="h-6 w-6 text-white"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                      </svg>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
</div>
@endsection
