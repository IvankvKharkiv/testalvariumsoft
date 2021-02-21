<?php

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
})->name('welcome');



Route::get('/employes', [\App\Http\Controllers\EmployeController::class, 'index'])->name('employes');

Route::get('/employes/{department}', [\App\Http\Controllers\EmployeController::class,'department']);


Route::get('/getxmlfile', [\App\Http\Controllers\XmlController::class,'getImployeXml'])->name('getxmlfile');
Route::post('/setxmlfile/{asnew}', [\App\Http\Controllers\XmlController::class,'setImployeXml'])->name('setxmlfile');
Route::get('/getImployeXmllite', [\App\Http\Controllers\XmlController::class,'getImployeXmllite'])->name('getImployeXmllite');



