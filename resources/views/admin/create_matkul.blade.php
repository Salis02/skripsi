@extends('admin.layout.header')

@section('container')

@if ($errors->any())
<div>
    <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Form Matkul Baru</h2>
<form action="{{ route('matkul.store') }}" method="POST" class="max-w-md p-4 bg-white rounded-lg shadow-md">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="kodeMatkul">Kode Mata Kuliah:</label>
        <input type="text" name="kodeMatkul" value="{{ old('kodeMatkul') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="namaMatkul">Nama Mata Kuliah:</label>
        <input type="text" name="namaMatkul" value="{{ old('namaMatkul') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="teori">Teori (SKS):</label>
        <input type="number" name="teori" id="teori" value="{{ old('teori') }}" oninput="calculateTotalSKS()" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="praktek">Praktek (SKS):</label>
        <input type="number" name="praktek" id="praktek" value="{{ old('praktek') }}" oninput="calculateTotalSKS()" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="praktekLapangan">Praktek Lapangan (SKS):</label>
        <input type="number" name="praktekLapangan" id="praktekLapangan" value="{{ old('praktekLapangan') }}" oninput="calculateTotalSKS()" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="totalSks">Total SKS:</label>
        <input type="number" name="totalSks" id="totalSks" value="{{ old('totalSks') }}" readonly contenteditable="false" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="semesterId">Semester:</label>
        <select name="semesterId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @foreach($semesters as $semester)
                <option value="{{ $semester->id }}">{{ $semester->semester }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="typeId">Type Mata Kuliah:</label>
        <select name="typeId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @foreach($types as $type)
                <option value="{{ $type->id }}">
                    {{ $type->sifat }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Simpan</button>
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
