@extends('admin.layout.header')

@section('container')

@if ($errors->any())
<div class="bg-red-400 text-black">
    <p>Ada beberapa masalah dengan input Anda</p>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Create Matkul</h2>
<form action="{{ route('matkul.store') }}" method="POST" class="px-4 py-3 mb-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="kodeMatkul">Kode Mata Kuliah:</label>
        <input type="text" name="kodeMatkul" value="{{ old('kodeMatkul') }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="namaMatkul">Nama Mata Kuliah:</label>
        <input type="text" name="namaMatkul" value="{{ old('namaMatkul') }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="teori">Teori (SKS):</label>
        <input type="number" min="0" name="teori" id="teori" value="{{ old('teori') }}" oninput="calculateTotalSKS()" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="praktek">Praktek (SKS):</label>
        <input type="number" min="0" name="praktek" id="praktek" value="{{ old('praktek') }}" oninput="calculateTotalSKS()" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="praktekLapangan">Praktek Lapangan (SKS):</label>
        <input type="number" min="0" name="praktekLapangan" id="praktekLapangan" value="{{ old('praktekLapangan') }}" oninput="calculateTotalSKS()" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="totalSks">Total SKS:</label>
        <input type="number" name="totalSks" id="totalSks" value="{{ old('totalSks') }}" readonly contenteditable="false" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="semesterId">Semester:</label>
        <select name="semesterId" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
            <option value="">--Pilih Semester--</option>
            @foreach($semesters as $semester)
                <option value="{{ $semester->id }}">{{ $semester->semester }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="typeId">Type Mata Kuliah:</label>
        <select name="typeId" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
            <option value="">--Pilih Tipe Matkul--</option>
            @foreach($types as $type)
                <option value="{{ $type->id }}">
                    {{ $type->sifat }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Simpan</button>
</form>

<script>
    function calculateTotalSKS() {
        var teori = parseInt(document.getElementById('teori').value) || 0;
        var praktek = parseInt(document.getElementById('praktek').value) || 0;
        var praktekLapangan = parseInt(document.getElementById('praktekLapangan').value) || 0;
        var totalSks = teori + praktek + praktekLapangan;
        document.getElementById('totalSks').value = totalSks;
    }
</script>


@endsection
