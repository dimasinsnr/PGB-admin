<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\UnitlatihanController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DatakesehatanController;

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
    return view('auth.login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

// Route::middleware('auth')->group(function() {
//     Route::resource('basic', BasicController::class);
// });

Route::prefix('user')->middleware('auth')->group(function () {
    $actions = ['storeData', 'deleteData', 'showData'];
    Route::get('/', [BasicController::class, 'index'])->name('user.index'); // Tambahkan rute 'unit_latihan.index'
    Route::get('initTable', [BasicController::class, 'initTable']); // Tambahkan rute 'unit_latihan.index'
    foreach ($actions as $action) {
        Route::post($action, [BasicController::class, $action]);
    }
});

Route::prefix('unit_latihan')->middleware('auth')->group(function () {
    $actions = ['storeData', 'deleteData'];
    Route::get('/', [UnitlatihanController::class, 'index'])->name('unit_latihan.index'); // Tambahkan rute 'unit_latihan.index'
    Route::get('initTable', [UnitlatihanController::class, 'initTable']); // Tambahkan rute 'unit_latihan.index'
    foreach ($actions as $action) {
        Route::post($action, [UnitlatihanController::class, $action]);
    }
});

Route::prefix('anggota')->middleware('auth')->group(function () {
    $actions = ['storeData', 'deleteData', 'comboUnitLatihan', 'showData'];
    Route::get('/', [AnggotaController::class, 'index'])->name('anggota.index'); // Tambahkan rute 'unit_latihan.index'
    Route::get('initTable', [AnggotaController::class, 'initTable']); // Tambahkan rute 'unit_latihan.index'
    foreach ($actions as $action) {
        Route::post($action, [AnggotaController::class, $action]);
    }
});

Route::prefix('datakesehatan')->middleware('auth')->group(function () {
    $actions = ['storeData', 'deleteData', 'comboUnitLatihan', 'comboAnggota', 'showData'];
    Route::get('/', [DatakesehatanController::class, 'index'])->name('datakesehatan.index'); // Tambahkan rute 'unit_latihan.index'
    Route::get('initTable', [DatakesehatanController::class, 'initTable']); // Tambahkan rute 'unit_latihan.index'
    foreach ($actions as $action) {
        Route::post($action, [DatakesehatanController::class, $action]);
    }
});
