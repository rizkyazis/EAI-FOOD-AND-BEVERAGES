<?php

use App\Http\Controllers\AdminController;
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
Route::get('/form', function () {
    return view('form');
});

Route::get('/menu',[MenuController::class,'index'])->name('menu.welcome');
Route::get('/detail/{id}',[MenuController::class,'detail'])->name('menu.detail.user');
//Route::get('',[CategoryController::class,'']);
Route::get('/details/category', function () {
    return view('details.category');
});
Route::prefix('/admin')->group(function (){
    Route::get('/menu/add',[AdminController::class,'createMenuIndex'])->name('admin.menu.add.index');
    Route::post('/menu/add',[AdminController::class,'createMenu'])->name('admin.menu.add');
    Route::get('/menu',[AdminController::class,'menuIndex'])->name('admin.menu.index');
    Route::get('/menu/edit/{id}',[AdminController::class,'editMenuIndex'])->name('admin.menu.edit.index');
    Route::post('/menu/edit/{id}',[AdminController::class,'editMenu'])->name('admin.menu.edit');
    Route::post('/menu/delete/{id}',[AdminController::class,'deleteMenu'])->name('admin.menu.delete');

    Route::get('/order',[AdminController::class,'orderIndex'])->name('admin.order.index');
    Route::get('/order/add',[AdminController::class,'createOrderIndex'])->name('admin.order.add.index');
    Route::post('/order/add',[AdminController::class,'createOrder'])->name('admin.order.add');
    Route::get('/order/detail/{id}',[AdminController::class,'detailOrder'])->name('admin.detail.order');
    Route::post('/order/update/menu/{id}',[AdminController::class,'updateMenuOrder'])->name('admin.update.menu.order');
    Route::post('/order/delete/menu/{id}',[AdminController::class,'deleteMenuOrder'])->name('admin.delete.menu.order');
    Route::post('/order/delete/{id}',[AdminController::class,'deleteOrder'])->name('admin.delete.order');

    Route::get('/category',[AdminController::class,'categoryIndex'])->name('admin.category.index');
});

