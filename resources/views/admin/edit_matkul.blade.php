@extends('admin.layout.header')

@section('container')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Form Edit Matkul</h2>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('matkul.update', $matkul->id) }}" method="POST" class="max-w-md p-4 bg-white rounded-lg shadow-md">
        @csrf
        @method('PUT')


        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="Kode_matkul">Kode Matkul:</label>
            <input type="text" name="kodeMatkul" id="Kode_matkul" value="{{ $matkul->kodeMatkul }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="Nama_matkul">Nama Matkul:</label>
            <input type="text" name="namaMatkul" id="Nama_matkul" value="{{ $matkul->namaMatkul }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="teori">Teori (SKS):</label>
            <input type="number" name="teori" id="teori" value="{{ $matkul->teori }}" oninput="calculateTotalSKS()" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="praktek">Praktek (SKS):</label>
            <input type="number" name="praktek" id="praktek" value="{{ $matkul->praktek }}" oninput="calculateTotalSKS()" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="praktekLapangan">Praktek Lapangan (SKS):</label>
            <input type="number" name="praktekLapangan" id="praktekLapangan" value="{{ $matkul->praktekLapangan }}" oninput="calculateTotalSKS()" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="totalSks">Total SKS:</label>
            <input type="number" name="totalSks" id="totalSks" value="{{ $matkul->totalSks }}" readonly contenteditable="false" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="semesterId">Semester:</label>
            <select name="semesterId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}" {{ $semester->id == $matkul->semesterId ? 'selected' : '' }}>{{ $semester->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="typeId">Type:</label>
            <select name="typeId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->sifat }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
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
