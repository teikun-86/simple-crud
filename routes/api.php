<?php

use App\Http\Controllers\SiswaController;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/jurusans', function() {
    $arr = [];
    foreach(Jurusan::get() as $jrs) {
        $arr[] = [
            'id' => $jrs->id,
            'name' => $jrs->name,
        ];
    }
    return response()->json([
        'success' => true,
        'jurusans' => $arr
    ]);
});

