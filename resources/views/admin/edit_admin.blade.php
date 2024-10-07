<!-- resources/views/admin/edit-admin.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Admin</title>
</head>
<body>
    <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" >Edit Admin</h1>
    <form action="{{ route('admin.editAdmin', $admin->id) }}" method="POST" class="max-w-md p-4 bg-white rounded-lg shadow-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nama Admin
            </label>
            <input type="text" name="name" id="name" value="{{ $admin->name }}" required
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Masukkan nama admin" />
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email Admin
            </label>
            <input type="email" name="email" id="email" value="{{ $admin->email }}" required
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Masukkan email admin" />
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password Admin
            </label>
            <input type="password" name="password" id="password"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Masukkan password admin" />
        </div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        type="submit">Perbarui</button>
    </form>
</body>
</html>
