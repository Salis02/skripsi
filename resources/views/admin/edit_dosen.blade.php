@extends('admin.layout.header')

@section('container')
<div class="container mx-auto mt-4">
    <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Edit Dosen
    </h2>
    <form action="/admin/dosen/{{ $dosen->id }}" method="POST" class="px-4 py-3 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Name</label>
            <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="name" id="name" value="{{ $dosen->name }}" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Email</label>
            <input type="email" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="email" id="email" value="{{ $dosen->user->email }}" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Password</label>
            <input type="password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="password" id="password">
        </div>
        
        <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Update</button>
    </form>
</div>
@endsection