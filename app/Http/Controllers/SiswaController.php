<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use DataTables;

class SiswaController extends Controller
{   
    public function index()
    {
        return view('register', [
            'jurusans' => Jurusan::get()
        ]);
    }
    
    public function register(Request $request)
    {
        $this->validate($request, Siswa::VALIDATION_RULES, [], Siswa::VALIDATION_ATTRIBUTES);
        $this->save($request);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendaftar. Silahkan tunggu informasi dari kami untuk langkah selanjutnya.'
        ]);
    }

    public function datatables(Request $request)
    {
        if($request->ajax()) {
            $siswas = Siswa::query();
            return DataTables::eloquent($siswas)
                ->rawColumns(['action', 'ttl', 'jurusan'])
                ->editColumn('nisn', function($siswa) {
                    return "$siswa->nisn";
                })
                ->editColumn('name', function($siswa) {
                    return $siswa->name;
                })
                ->editColumn('jurusan', function($siswa) {
                    return $siswa->jurusan->name;
                })
                ->editColumn('ttl', function($siswa) {
                    return "$siswa->birth_place, ".$siswa->birth_date->format('d F Y');
                })
                ->editColumn('gender', function($siswa) {
                    return $siswa->gender === 'male' ? 'Laki-laki' : 'Perempuan';
                })
                ->editColumn('address', function($siswa) {
                    return $siswa->address;
                })
                ->editColumn('action', function($siswa) {
                    $siswa->dob = $siswa->birth_date->format('Y-m-d');
                    return '<div class="flex">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" onclick="modalEditSiswa(\''.$siswa->id.'\', \''.htmlentities(json_encode($siswa), ENT_QUOTES, 'utf-8').'\')"
                                        class="btn btn-outline-primary">Edit</button>
                                    <button type="button" onclick="modalDeleteSiswa(\''.$siswa->id.'\')" class="btn btn-outline-danger">Delete</button>
                                </div>
                            </div>';
                })
                ->toJson();
        }
    }
    
    /**
     * Save Record to 'siswas' table
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Siswa|null $siswa
     */
    public static function save(Request $request, $siswa = null)
    {
        if(!$siswa) {
            Siswa::create($request->only([
                'name',
                'jurusan_id',
                'nisn',
                'birth_place',
                'birth_date',
                'address',
                'gender'
            ]));
            return;
        }
        $siswa->update($request->only([
            'name',
            'jurusan_id',
            'nisn',
            'birth_place',
            'birth_date',
            'address',
            'gender'
        ]));
    }
}
