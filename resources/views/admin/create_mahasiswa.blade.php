<form action="/admin/mahasiswa" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <label for="nim">NIM:</label>
    <input type="text" name="nim" id="nim" value="{{ old('nim') }}" required>

    <label for="date">Tanggal Lahir:</label>
    <input type="date" name="date" id="date" value="{{ old('date') }}" required>

    <label for="gender">Jenis Kelamin:</label>
    <select name="gender" id="gender" required>
        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
    </select>

    <label for="dosen_id">Dosen:</label>
    <select name="dosen_id" id="dosen_id" required>
        @foreach ($dosens as $dosen)
            <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>{{ $dosen->name }}</option>
        @endforeach
    </select>

    <button type="submit">Create</button>
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
