@extends('layouts.app')

@section('header')
    <div class="w-full bg-white py-4 shadow-sm">
        <div class="container">
            <h4>Daftar Siswa Baru</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="container shadow-sm">
        <div class="card border-0">
            <div class="card-body border-0">
                <form onsubmit="event.preventDefault(); ajaxPost('registerForm', '{{route('siswa-register')}}')" action="{{route('siswa-register')}}" method="post" id="registerForm">
                    @csrf
                    <x-form-siswa idprefix="siswa-register-" />
                    <div class="float-right">
                        <a href="{{url('/')}}" class="btn btn-light mr-2">Kembali</a>
                        <button type="reset" class="btn btn-light mr-2">Reset</button>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection