@extends('mahasiswa.layouts.header')

@section('container')

<h1>Hasil Defuzzifikasi</h1>
<p>Jumlah SKS yang direkomendasikan: {{ $recommended_sks }}</p>

<a href="{{ route('menu') }}">Kembali ke Menu</a>
@endsection
