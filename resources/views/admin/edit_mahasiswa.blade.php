@extends('admin.layout.header')

@section('container')
<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Edit Mahasiswa</h2>
    <form action="/admin/mahasiswa/{{ $mahasiswa->id }}" method="POST" class="px-4 py-3 mb-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        @method('PUT')
    
        <div class="mb-4">
            <label for="name" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" id="name" value="{{ $mahasiswa->name }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>
    
        <div class="mb-4">
            <label for="email" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ $mahasiswa->user->email }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>
    
        <div class="mb-4">
            <label for="password" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Password</label>
            <input type="password" name="password" id="password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>
    
        <div class="mb-4">
            <label for="nim" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">NIM</label>
            <input type="text" name="nim" id="nim" value="{{ $mahasiswa->nim }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="semesterId">Semester</label>
            <select name="semesterId" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}" {{ $semester->id == $mahasiswa->semester_id ? 'selected' : '' }}>{{ $semester->id }}</option>
                @endforeach
            </select>
        </div>
        
    
        <div class="mb-4">
            <label for="dosen_id" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Dosen</label>
            <select name="dosen_id" id="dosen_id" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
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