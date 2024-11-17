@extends('mahasiswa.layouts.header')

@section('container')
<div class="bg-white rounded-lg shadow-lg p-10 w-full">
    <h1 class="text-2xl font-bold mb-4">Rekomendasi Mata Kuliah</h1>
    <table class="min-w-full bg-white border border-gray-300">
        <thead class="text-left">
            <tr>
                <th class="py-2 px-4 border-b">No.</th>
                <th class="py-2 px-4 border-b">Kode Mata Kuliah</th>
                <th class="py-2 px-4 border-b">Nama Mata Kuliah</th>
                <th class="py-2 px-4 border-b">Total SKS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rekomendasiMatkul as $index => $rekomendasi)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border-b">{{ $rekomendasi->matkul->kodeMatkul ?? 'Tidak ada kode' }}</td>
                    <td class="py-2 px-4 border-b">{{ $rekomendasi->matkul->namaMatkul ?? 'Tidak ada nama' }}</td>
                    <td class="py-2 px-4 border-b">{{ $rekomendasi->matkul->totalSks ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Tidak ada rekomendasi mata kuliah untuk InputFuzzy ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        <a href="{{ route('riwayat') }}" class="text-blue-500 hover:underline">&larr; Kembali ke Riwayat</a>
    </div>
</div>
@endsection
