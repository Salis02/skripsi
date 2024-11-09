@extends('admin.layout.header')

@section('container')
<div class="container mx-auto mt-4">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Edit Matkul</h2>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('matkul.update', $matkul->id) }}" method="POST" class="px-4 py-3 mb-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        @method('PUT')


        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="Kode_matkul">Kode Matkul:</label>
            <input type="text" name="kodeMatkul" id="Kode_matkul" value="{{ $matkul->kodeMatkul }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="Nama_matkul">Nama Matkul:</label>
            <input type="text" name="namaMatkul" id="Nama_matkul" value="{{ $matkul->namaMatkul }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="teori">Teori (SKS):</label>
            <input type="number" name="teori" id="teori" value="{{ $matkul->teori }}" oninput="calculateTotalSKS()" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="praktek">Praktek (SKS):</label>
            <input type="number" name="praktek" id="praktek" value="{{ $matkul->praktek }}" oninput="calculateTotalSKS()" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="praktekLapangan">Praktek Lapangan (SKS):</label>
            <input type="number" name="praktekLapangan" id="praktekLapangan" value="{{ $matkul->praktekLapangan }}" oninput="calculateTotalSKS()" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="totalSks">Total SKS:</label>
            <input type="number" name="totalSks" id="totalSks" value="{{ $matkul->totalSks }}" readonly contenteditable="false" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="semesterId">Semester:</label>
            <select name="semesterId" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}" {{ $semester->id == $matkul->semesterId ? 'selected' : '' }}>{{ $semester->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="typeId">Type:</label>
            <select name="typeId" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ $type->id == $type->sifat ? 'selected' : '' }}>{{ $type->sifat }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Update</button>
    </form>
</div>

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
