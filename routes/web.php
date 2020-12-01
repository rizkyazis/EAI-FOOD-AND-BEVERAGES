<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MenuController;

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

Route::get('/menu',[MenuController::class,'index'])->name('menu.welcome');
Route::get('/detail/{id}/',[MenuController::class,'detail'])->name('menu.detail');
