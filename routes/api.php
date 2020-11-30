<?php

use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\CategoryController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Menu
Route::get('/menu',[MenuController::class,'index'])->name('menu.index');
Route::get('/menu/{id}',[MenuController::class,'detail'])->name('menu.detail');
Route::get('/menu/category/{id}',[MenuController::class,'menuByCategory'])->name('menu.by.category');
Route::post('/menu/create',[MenuController::class,'create'])->name('menu.create');

//Category
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::get('/category/{id}',[CategoryController::class,'detail'])->name('category.detail');
Route::post('/category/create',[CategoryController::class,'create'])->name('category.create');
Route::post('/category/delete',[CategoryController::class,'delete'])->name('category.delete');
Route::post('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
