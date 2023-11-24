<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Ticketing\CategoryController;
use App\Http\Controllers\Ticketing\EntranceController;
use App\Http\Controllers\Ticketing\PriorityController;
use App\Http\Controllers\DataCenter\SoftwareController;

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

Route::get('logout', function () {
    Auth::logout();

    return redirect('/login');
});

Auth::routes(['verify' => true]);

Route::get('/verified-user/{id}', [HomeController::class, 'verifiedUser'])->name('entrance.verified');

Route::middleware(['auth', 'isverified'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('profile', [HomeController::class, 'update_profile'])->name('profile.update');

    Route::middleware(['ensure'])->group(function () {
        //Entrance
        Route::get('/entrance/datas', [EntranceController::class, 'datas'])->name('entrance.datas');
        Route::get('/entrance/detail/{entrance}', [EntranceController::class, 'detail'])->name('entrance.detail');
        Route::resource('/entrance', EntranceController::class);

        Route::middleware(['role:admin'])->group(function () {

            //Category
            Route::get('/category/datas', [CategoryController::class, 'datas'])->name('category.datas');
            Route::resource('category', CategoryController::class);

            //Priority
            Route::get('/priority/datas', [PriorityController::class, 'datas'])->name('priority.datas');
            Route::resource('priority', PriorityController::class);

            //SOFTWARE
            Route::get('/software/datas', [SoftwareController::class, 'datas'])->name('software.datas');
            Route::get('/software/detail/{software}', [SoftwareController::class, 'detail'])->name('software.detail');
            Route::resource('software', SoftwareController::class);

            Route::post('/comment/{entrance}', [HomeController::class, 'comment'])->name('entrance.comment');

            Route::resource('users', UserController::class);
            Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        });
    });

});
