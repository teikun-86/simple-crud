@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body text-center">
            <h5>Daftar sekolah?</h5>
            <p>Daftar disini aja! Klik tombol dibawah untuk mendaftar.</p>
            <a href="{{route('siswa-register')}}" class="btn btn-outline-primary">Daftar</a>
        </div>
    </div>
</div>
@endsection
