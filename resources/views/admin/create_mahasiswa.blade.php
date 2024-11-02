@extends('admin.layout.header')

@section('container')
<div class="container mx-auto mt-4">

    @if ($errors->any())
        <div class="text-xs text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Create Mahasiswa</h2>
    <form action="/admin/mahasiswa" method="POST" class="px-4 py-3 mb-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Email:</label>
            <input type="email" name="email" id="email"  value="{{ old('email') }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" >

        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Password:</label>
            <input type="password" name="password" id="password" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>
        <div class="mb-4">
            <label for="nim" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">NIM:</label>
            <input type="text" name="nim" id="nim" value="{{ old('nim') }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>
    
        <div class="mb-4">
            <label for="semester_id" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Semester:</label>
            <select name="semester_id" id="semester_id" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id ? 'selected' : '' }}>{{ $semester->semester }}</option>
                @endforeach
            </select>
            
        </div>
    
        <div class="mb-4">
            <label for="date" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Tanggal Lahir:</label>
            <input type="date" name="date" id="date" value="{{ old('date') }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
        </div>
        <div class="mb-4">
            <label for="gender" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Jenis Kelamin:</label>
            <select name="gender" id="gender" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="dosen_id" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Dosen:</label>
            <select name="dosen_id" id="dosen_id" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>{{ $dosen->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Create</button>
    </form>
</div>



@endsection