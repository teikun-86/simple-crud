<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'jurusan_id',
        'nisn',
        'birth_place',
        'birth_date',
        'address',
        'gender',
    ];

    public const VALIDATION_RULES = [
        'name' => 'required|string',
        'jurusan_id' => 'required',
        'nisn' => 'required|unique:siswas',
        'birth_place' => 'required|string',
        'address' => 'required|string',
        'gender' => 'required',
        'birth_date' => 'required|date'
    ];

    public const VALIDATION_RULES_UPDATE = [
        'name' => 'required|string',
        'jurusan_id' => 'required',
        'nisn' => 'required',
        'birth_place' => 'required|string',
        'address' => 'required|string',
        'gender' => 'required',
        'birth_date' => 'required|date'
    ];

    public const VALIDATION_ATTRIBUTES = [
        'name' => 'nama',
        'jurusan_id' => 'jurusan',
        'nisn' => 'nisn',
        'birth_place' => 'tempat lahir',
        'address' => 'alamat',
        'gender' => 'gender',
        'birth_date' => 'tanggal lahir'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    protected $casts = [
        'birth_date' => 'datetime'
    ];
}
