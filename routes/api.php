<?php

use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ReportController;
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
Route::post('/menu/delete/{id}',[MenuController::class,'delete'])->name('menu.delete');
Route::post('/menu/update/{id}',[MenuController::class,'update'])->name('menu.update');


//Category
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::get('/category/{id}',[CategoryController::class,'detail'])->name('category.detail');
Route::post('/category/create',[CategoryController::class,'create'])->name('category.create');
Route::post('/category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
Route::post('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');


//Order
Route::get('/order',[OrderController::class,'index'])->name('order.index');
Route::get('/order/detail/{id}',[OrderController::class,'detail'])->name('order.detail');
Route::get('/order/waiting',[OrderController::class,'orderWaiting'])->name('order.waiting');
Route::get('/order/finished',[OrderController::class,'orderFinished'])->name('order.finished');
Route::post('/order/create',[OrderController::class,'order'])->name('order.create');
Route::post('/order/menu/finish/{id}',[OrderController::class,'finishMenu'])->name('order.finish.menu');
Route::post('/order/delete/{id}',[OrderController::class,'deleteOrder'])->name('order.delete');
Route::post('/order/delete/menu/{id}',[OrderController::class,'deleteMenuOrder'])->name('order.menu.delete');

//Report
Route::get('/report/employee',[ReportController::class,'reportEmployee'])->name('report.employee');
Route::get('/report/employee/detail/{id}',[ReportController::class,'reportEmployeeById'])->name('report.employee.id');
Route::get('/report/employee/detail/{id}/date',[ReportController::class,'reportEmployeebyIdBetweenDate'])->name('report.employee.id.date.between');
Route::get('/report/employee/date',[ReportController::class,'reportEmployeeBetweenDate'])->name('report.employee.date.between');
Route::get('/report/income',[ReportController::class,'reportIncome'])->name('report.income');
Route::get('/report/income/detail/{id}',[ReportController::class,'reportIncomeByIdOrder'])->name('report.income.id');
Route::get('/report/income/date',[ReportController::class,'reportIncomeBetweenDate'])->name('report.income.date.between');
Route::get('/report/income/date/detail',[ReportController::class,'reportIncomeDate'])->name('report.income.date');
