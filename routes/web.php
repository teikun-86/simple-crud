<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'role:administrator'],
    'as' => 'admin.'
], function() {
    Route::get('/', [AdminController::class, 'index'])
        ->name('index');
    Route::post('/siswa-create', [AdminController::class, 'siswaStore'])
        ->name('siswa-create')
        ->middleware('permission:siswa-create');
    Route::post('/siswa-update/{siswa:id}', [AdminController::class, 'siswaUpdate'])
        ->name('siswa-update')
        ->middleware('permission:siswa-update');
    Route::get('/datatable-siswa', [SiswaController::class, 'datatables']);
    Route::get('/datatable-jurusan', [AdminController::class, 'jurusanDataTable']);
    Route::post('/jurusan-create', [AdminController::class, 'jurusanStore'])
        ->name('jurusan-create')
        ->middleware('permission:jurusan-create');
    Route::post('/jurusan-update/{jurusan:id}', [AdminController::class, 'jurusanUpdate'])
        ->name('jurusan-update')
        ->middleware('permission:jurusan-update');
    Route::delete('/siswa-delete', [AdminController::class, 'siswaDelete'])
        ->name('siswa-delete')
        ->middleware('permission:siswa-delete');
    Route::delete('/jurusan-delete', [AdminController::class, 'jurusanDelete'])
        ->name('jurusan-delete')
        ->middleware('permission:jurusan-delete');
});

Route::get('/register', [SiswaController::class, 'index'])
    ->name('siswa-register');
Route::post('/register', [SiswaController::class, 'register']);

Auth::routes([
    'register' => false,
    'reset' => false
]);
