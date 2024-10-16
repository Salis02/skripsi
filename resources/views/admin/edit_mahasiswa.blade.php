@extends('admin.layout.header')

@section('container')
<h1>Edit Mahasiswa</h1>
    {{-- <form action="/admin/mahasiswa/{{ $mahasiswa->id }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $mahasiswa->name }}" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $mahasiswa->user->email }}" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <label for="nim">NIM:</label>
        <input type="text" name="nim" id="nim" value="{{ $mahasiswa->nim }}" required>
        <label for="dosen_id">Dosen:</label>
        <select name="dosen_id" id="dosen_id" required>
            @foreach ($dosens as $dosen)
                <option value="{{ $dosen->id }}" {{ $mahasiswa->dosen_id == $dosen->id ? 'selected' : '' }}>
                    {{ $dosen->name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Update</button>
    </form> --}}

    <form action="/admin/mahasiswa/{{ $mahasiswa->id }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
    
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
            <input type="text" name="name" id="name" value="{{ $mahasiswa->name }}" required class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>
    
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
            <input type="email" name="email" id="email" value="{{ $mahasiswa->user->email }}" required class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>
    
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
            <input type="password" name="password" id="password" class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>
    
        <div class="mb-4">
            <label for="nim" class="block text-gray-700 font-bold mb-2">NIM:</label>
            <input type="text" name="nim" id="nim" value="{{ $mahasiswa->nim }}" required class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="semesterId">Semester:</label>
            <select name="semesterId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}" {{ $semester->id == $mahasiswa->semester_id ? 'selected' : '' }}>{{ $semester->id }}</option>
                @endforeach
            </select>
        </div>
        
    
        <div class="mb-4">
            <label for="dosen_id" class="block text-gray-700 font-bold mb-2">Dosen:</label>
            <select name="dosen_id" id="dosen_id" required class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id }}" {{ $mahasiswa->dosen_id == $dosen->id ? 'selected' : '' }}>
                        {{ $dosen->name }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
    </form>
@endsection