@extends('admin.layout.header')

@section('container')

<h2 class="text-lg font-bold mt-4 mb-4">Create Mahasiswa</h2>
<form action="/admin/mahasiswa" method="POST" class="w-full mx-auto p-4 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
    @csrf
    <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
        <input type="password" name="password" id="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="nim" class="block text-gray-700 text-sm font-bold mb-2">NIM:</label>
        <input type="text" name="nim" id="nim" value="{{ old('nim') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-4">
        <label for="semester_id" class="block text-gray-700 text-sm font-bold mb-2">Semester:</label>
        <select name="semester_id" id="semester_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @foreach ($semesters as $semester)
                <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id ? 'selected' : '' }}>{{ $semester->semester }}</option>
            @endforeach
        </select>
        
    </div>

    <div class="mb-4">
        <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir:</label>
        <input type="date" name="date" id="date" value="{{ old('date') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin:</label>
        <select name="gender" id="gender" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>
    <div class="mb-4">
        <label for="dosen_id" class="block text-gray-700 text-sm font-bold mb-2">Dosen:</label>
        <select name="dosen_id" id="dosen_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @foreach ($dosens as $dosen)
                <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>{{ $dosen->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Create</button>
</form>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection