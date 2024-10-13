@extends('dosen.layout.header')

@section('container')
<div class="container">
    <h1>Edit Fuzzy Range</h1>

    <form action="{{ route('fuzzyRange.update', $fuzzyRange->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="variabel">Variabel</label>
            <input type="text" name="variabel" id="variabel" class="form-control" value="{{ $fuzzyRange->variabel }}" required>
        </div>
        <div class="form-group">
            <label for="category">Kategori</label>
            <input type="text" name="category" id="category" class="form-control" value="{{ $fuzzyRange->category }}" required>
        </div>
        <div class="form-group">
            <label for="min_value">Nilai Minimum</label>
            <input type="number" name="min_value" id="min_value" class="form-control" step="0.01" value="{{ $fuzzyRange->min_value }}" required>
        </div>
        <div class="form-group">
            <label for="max_value">Nilai Maksimum</label>
            <input type="number" name="max_value" id="max_value" class="form-control" step="0.01" value="{{ $fuzzyRange->max_value }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
