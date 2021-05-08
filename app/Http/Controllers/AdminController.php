<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use DataTables;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function siswaStore(Request $request)
    {
        $this->validate($request, Siswa::VALIDATION_RULES,[], Siswa::VALIDATION_ATTRIBUTES);

        SiswaController::save($request);
        
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menyimpan siswa baru.'
        ]);
    }

    public function siswaUpdate(Request $request, Siswa $siswa)
    {
        $this->validate($request, Siswa::VALIDATION_RULES_UPDATE,[], Siswa::VALIDATION_ATTRIBUTES);

        SiswaController::save($request, $siswa);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengupdate data siswa.'
        ]);
    }

    public function siswaDelete(Request $request)
    {
        if(count($request->ids) > 0) {
            Siswa::destroy($request->ids);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data siswa'
            ]);
        }
    }

    public function jurusanStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ], [], [
            'name' => 'nama jurusan'
        ]);

        $this->jurusanSave($request);
        
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menyimpan jurusan baru'
        ]);
    }

    public function jurusanUpdate(Request $request, Jurusan $jurusan)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ], [], [
            'name' => 'nama jurusan'
        ]);

        $this->jurusanSave($request, $jurusan);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengupdate jurusan'
        ]);
    }

    public function jurusanDelete(Request $request)
    {
        if(count($request->ids) > 0) {
            Jurusan::destroy($request->ids);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus '. count($request->ids) .' jurusan'
            ]);
        }
    }

    public function jurusanDataTable(Request $request)
    {
        if($request->ajax()) {
            $jurusan = Jurusan::query();
            return DataTables::eloquent($jurusan)
                ->rawColumns(['action', 'count'])
                ->editColumn('name', function ($jrs) {
                    return $jrs->name;
                })
                ->editColumn('count', function ($jrs) {
                    return $jrs->siswas->count();
                })
                ->editColumn('action', function($jrs) {
                    return '<div class="flex">
                                <div class="btn-group" role="group">
                                    <button type="button" onclick="modalEditJurusan(\'' . $jrs->id . '\', \'' . htmlentities(json_encode($jrs), ENT_QUOTES, 'utf-8') . '\')"
                                        class="btn btn-outline-primary">Edit</button>
                                    <button type="button" onclick="modalDeleteJurusan(\'' . $jrs->id . '\')" class="btn btn-outline-danger">Delete</button>
                                </div>
                            </div>';
                })
                ->toJson();
        }
    }

    /**
     * Save record to 'jurusans' table
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Jurusan|null $jurusan
     * @return void
     */
    public function jurusanSave(Request $request, $jurusan = null)
    {
        if (!$jurusan) {
            Jurusan::create($request->only('name'));
            return;
        }
        $jurusan->update($request->only('name'));
    }
}
