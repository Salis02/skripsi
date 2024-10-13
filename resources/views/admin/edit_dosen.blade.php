<!-- resources/views/admin/edit-dosen.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Dosen</title>
</head>
<body>
    <h1>Edit Dosen</h1>
    <form action="/admin/dosen/{{ $dosen->id }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $dosen->name }}" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $dosen->user->email }}" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <button type="submit">Update</button>
    </form>
</body>
</html>
