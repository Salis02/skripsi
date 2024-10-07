@extends('admin.layout.header')

@section('container')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Create Dosen</h2>
    <form action="/admin/dosen" method="POST" class="max-w-md p-4 bg-white rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nama Dosen
            </label>
            <input type="text" name="name" id="name" required
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Masukkan nama dosen" />
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email Dosen
            </label>
            <input type="email" name="email" id="email" required
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Masukkan email dosen" />
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password Dosen
            </label>
            <input type="password" name="password" id="password" required
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Masukkan password dosen" />
        </div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        type="submit">Buat Akun</button>
    </form>
@endsection
