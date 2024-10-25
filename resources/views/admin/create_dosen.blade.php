@extends('admin.layout.header')

@section('container')
<div class="container mx-auto mt-4">

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Create Dosen</h2>
    <form action="/admin/dosen" method="POST" class="px-4 py-3 mb-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="name">
                Nama Dosen
            </label>
            <input type="text" name="name" id="name" required
            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="" />
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="email">
                Email Dosen
            </label>
            <input type="email" name="email" id="email" required
            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="" />
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="password">
                Password Dosen
            </label>
            <input type="password" name="password" id="password" required
            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="" />
        </div>
        <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        type="submit">Buat Akun</button>
    </form>
</div>
@endsection
