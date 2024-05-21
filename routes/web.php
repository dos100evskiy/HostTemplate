<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

//Route::get('/', [MainController::class,'home'])->name('home');

Route::get('/', function () {
    //return auth()->user()->email;
    return view('home');
})->middleware(['auth'])->name('home');

Route::get('/order', [MainController::class,'order'])
                                                    ->middleware(['auth'])
                                                    ->name('order');

Route::get('/members', [MainController::class,'members'])
                                                        ->middleware(['auth'])
                                                        ->name('members');

Route::post('/order/check', [MainController::class,'order_check']);

Route::get('/member/check', [MainController::class,'member_check'])
                                                                ->name('member_check');

Route::get('/userNotFound', function () {
    return view('userNotFound');
})->name('userNotFound');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';

