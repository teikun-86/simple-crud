@props([
    'siswa' => null,
    'idprefix' => 'create-siswa-'
])

<div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="{{$idprefix}}name">Nama</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="name" id="{{$idprefix}}name" class="form-control form-control-sm" value="{{$siswa ? $siswa->name : ''}}" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="{{$idprefix}}nisn">NISN</label>
        </div>
        <div class="col-md-8">
            <input type="number" name="nisn" id="{{$idprefix}}nisn" class="form-control form-control-sm" value="{{$siswa ? $siswa->nisn : ''}}" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="{{$idprefix}}jurusan_id">Jurusan</label>
        </div>
        <div class="col-md-8">
            <select name="jurusan_id" id="{{$idprefix}}jurusan_id" class="form-control" required>
                @foreach(\App\Models\Jurusan::get() as $jurusan)
                    <option {{$siswa && $siswa->jurusan_id === $jurusan->id ? 'selected' : ''}} value="{{$jurusan->id}}">{{$jurusan->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="{{$idprefix}}birth_place">Tempat Lahir</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="birth_place" id="{{$idprefix}}birth_place" class="form-control form-control-sm" value="{{$siswa ? $siswa->birth_place : ''}}" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="{{$idprefix}}birth_date">Tanggal Lahir</label>
        </div>
        <div class="col-md-8">
            <input type="date" name="birth_date" id="{{$idprefix}}birth_date" class="form-control form-control-sm" value="{{$siswa ? $siswa->birth_date : ''}}" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="{{$idprefix}}birth_date">Gender</label>
        </div>
        <div class="col-md-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="{{$idprefix}}gender-male" value="male">
                <label class="form-check-label" for="{{$idprefix}}gender-male">Laki-laki</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="{{$idprefix}}gender-female" value="female">
                <label class="form-check-label" for="{{$idprefix}}gender-female">Perempuan</label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="{{$idprefix}}address">Alamat</label>
        </div>
        <div class="col-md-8">
            <textarea name="address" id="{{$idprefix}}address" rows="5" class="form-control form-control-sm" required>{{$siswa ? $siswa->address : ''}}</textarea>
        </div>
    </div>
</div>