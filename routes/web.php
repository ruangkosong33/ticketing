<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ticketing\CategoryController;
use App\Http\Controllers\Ticketing\EntranceController;
use App\Http\Controllers\Ticketing\PriorityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('logout', function()
{
    Auth::logout();
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Entrance
    Route::get('/entrance/datas', [EntranceController::class, 'datas'])->name('entrance.datas');
    Route::get('/entrance/detail/{entrance}', [EntranceController::class, 'detail'])->name('entrance.detail');
    Route::resource('/entrance', EntranceController::class);

    //Category
    Route::get('/category/datas', [CategoryController::class, 'datas'])->name('category.datas');
    Route::resource('category', CategoryController::class);

    //Priority
    Route::get('/priority/datas', [PriorityController::class, 'datas'])->name('priority.datas');
    Route::resource('priority', PriorityController::class);

});