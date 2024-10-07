@extends('dosen.layout.header')

@section('container')
<div class="container">
    <h1>Tambah Fuzzy Range Baru</h1>

    <form action="{{ route('fuzzyRange.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="variabel">Variabel</label>
            <input type="text" name="variabel" id="variabel" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category">Kategori</label>
            <input type="text" name="category" id="category" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="min_value">Nilai Minimum</label>
            <input type="number" name="min_value" id="min_value" class="form-control" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="max_value">Nilai Maksimum</label>
            <input type="number" name="max_value" id="max_value" class="form-control" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
