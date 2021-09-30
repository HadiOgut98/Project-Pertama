<?php

use App\Http\Controllers\AnggotaController;
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
    return view('welcome');
});

Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota');

Route::get('/tambah_data', [AnggotaController::class, 'tambah_data'])->name('tambah_data');
Route::post('/insert_data', [AnggotaController::class, 'insert_data'])->name('insert_data');

Route::get('/tampil_data/{id}', [AnggotaController::class, 'tampil_data'])->name('tampil_data');
Route::post('/update_data/{id}', [AnggotaController::class, 'update_data'])->name('update_data');
Route::get('/delete/{id}', [AnggotaController::class, 'delete'])->name('delete');

// Export PDF
Route::get('/export_pdf', [AnggotaController::class, 'export_pdf'])->name('export_pdf');