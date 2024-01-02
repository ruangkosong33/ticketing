<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Landing\FrontController;
use App\Http\Controllers\DataCenter\VprController;
use App\Http\Controllers\DataCenter\WhmController;
use App\Http\Controllers\Metro\IntranetController;
use App\Http\Controllers\Ticketing\CategoryController;
use App\Http\Controllers\Ticketing\EntranceController;
use App\Http\Controllers\Ticketing\PriorityController;
use App\Http\Controllers\DataCenter\HardwareController;
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



//LANDING
Route::get('/beranda', [FrontController::class, 'beranda'])->name('index.beranda');
//LOGIN
Route::get('/', function () {
    return view('layouts.guest.f-main');
});

//LOGOUT
Route::get('logout', function () {
    Auth::logout();

    return redirect()->route('login');
});

//AUTH
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
        Route::post('/comment/{entrance}', [HomeController::class, 'comment'])->name('entrance.comment');

        Route::middleware(['role:admin'])->group(function () {

            //VPR
            Route::get('/vpr/datas', [VprController::class, 'datas'])->name('vpr.datas');
            Route::get('/vpr/detail/{vpr}', [VprController::class, 'detail'])->name('vpr.detail');
            Route::resource('vpr', VprController::class);
            
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

            //Hardware
            Route::get('/hardware/datas', [HardwareController::class, 'datas'])->name('hardware.datas');
            Route::get('/hardware/detail/{hardware}', [HardwareController::class, 'detail'])->name('hardware.detail');
            Route::resource('hardware', HardwareController::class);

            //INTRANET
            Route::get('/intranet/datas', [IntranetController::class, 'datas'])->name('intranet.datas');
            Route::get('/intranet/detail/{intranet}', [IntranetController::class, 'detail'])->name('intranet.detail');
            Route::resource('intranet', IntranetController::class);

            //WHM
            Route::get('/whm/datas', [WhmController::class, 'datas'])->name('whm.datas');
            Route::get('/whm/detail/{whm}', [WhmController::class, 'detail'])->name('whm.detail');
            Route::resource('whm', WhmController::class);

            //USERS
            Route::resource('users', UserController::class);

            //NOTIFICATIONS
            Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        });
    });
});
