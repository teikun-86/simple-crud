@extends('layouts.app')
@section('header')
    <div class="w-full bg-white py-4 shadow-sm">
        <div class="container">
            <div class="d-md-flex d-block justify-content-between align-items-center">
                <h4>Administrator Page</h4>
                <div class="d-flex justify-content-end align-items-center">
                    <button class="btn btn-outline-dark mr-2" onclick="createJurusanModal('createJurusanAdmin')">Add Jurusan</button>
                    <button class="btn btn-outline-dark" onclick="createSiswaModal('createSiswaAdmin')">Add Siswa</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <nav class="nav nav-pills flex-column flex-sm-row mb-2">
            <a class="flex-sm-fill text-sm-center nav-link active" id="siswa-tab" data-toggle="tab" href="#siswa" role="tab" aria-controls="siswa" aria-selected="true">Siswa</a>
            <a class="flex-sm-fill text-sm-center nav-link" id="jurusan-tab" data-toggle="tab" href="#jurusan" role="tab" aria-controls="jurusan" aria-selected="false">Jurusan</a>
        </nav>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="siswa" role="tabpanel" aria-labelledby="siswa-tab">
                <div class="table-responsive">
                    <table id="siswaList" class="table table-hover table-stripped">
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>NAMA</th>
                                <th>JURUSAN</th>
                                <th>TTL</th>
                                <th>GENDER</th>
                                <th>ADDRESS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            
            <div class="tab-pane fade" id="jurusan" role="tabpanel" aria-labelledby="jurusan-tab">
                <div class="table-responsive">
                    <table id="jurusanList" class="table table-hover table-stripped">
                        <thead>
                            <tr>
                                <th>NAMA</th>
                                <th>JUMLAH SISWA</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $('#siswaList').DataTable({
            serverSide: true,
            ajax: '/admin/datatable-siswa',
            processing: true,
            columns: [
                {name: 'nisn', data: 'nisn'},
                {name: 'name', data: 'name'},
                {name: 'jurusan', data: 'jurusan', searchable: false},
                {name: 'ttl', data: 'ttl', searchable: false},
                {name: 'gender', data: 'gender'},
                {name: 'address', data: 'address'},
                {name: 'action', data: 'action', orderable: false, searchable: false},
            ],
        })
        $('#jurusanList').DataTable({
            serverSide: true,
            processing: true,
            ajax: '/admin/datatable-jurusan',
            columns: [
                {name: 'name', data: 'name'},
                {name: 'count', data: 'count', searchable: false, orderable: false},
                {name: 'action', data: 'action', orderable: false, searchable: false},
            ],
        })
    </script>
@endsection


