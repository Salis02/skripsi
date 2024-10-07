<!-- resources/views/admin/edit-mahasiswa.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
</head>
<body>
    <h1>Edit Mahasiswa</h1>
    <form action="/admin/mahasiswa/{{ $mahasiswa->id }}" method="POST">
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
    </form>
</body>
</html>
