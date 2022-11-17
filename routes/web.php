<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
Route::middleware(['auth','verified'])->group(function () {
    Route::post('/createreview',[\App\Http\Controllers\MainController::class,'storeReview'])->name('store_review');
    Route::get('/add_review',[\App\Http\Controllers\MainController::class,'addreview'])->name('add_review');

    Route::get('profile/{id}',[\App\Http\Controllers\profileController::class,'profile'])->name('profile');
    Route::get('reviews/user/{id}',[\App\Http\Controllers\profileController::class,'profile_reviews'])->name('profile_reviews');
});
Route::get('/logout',[\App\Http\Controllers\userController::class,'destroy'])->name('logout')->middleware('auth');
Route::get('/',[\App\Http\Controllers\MainController::class,'welcome'])->name('welcome');
Route::get('/citys',[\App\Http\Controllers\MainController::class,'show'])->name('index');
Route::get('/reviews',[\App\Http\Controllers\MainController::class,'reviews'])->name('all_reviews');
Route::get('/reviews/{id}',[\App\Http\Controllers\MainController::class,'reviews_city'])->name('reviews_name');

Route::middleware(['guest'])->group(function(){
    Route::get('/register',[\App\Http\Controllers\userController::class,'registration'])->name('register');
    Route::post('/register',[\App\Http\Controllers\userController::class,'createUser'])->name('create_user');
    Route::get('/login',[\App\Http\Controllers\userController::class,'login'])->name('login');
    Route::post('/login',[\App\Http\Controllers\userController::class,'signIn'])->name('signIn');
});

Route::get('/reload-captcha',[\App\Http\Controllers\userController::class,'reloadCaptcha']);


Route::post('/savesession',[\App\Http\Controllers\MainController::class,'session'])->name('sessions');

Route::middleware(['verify','auth','can:update,review'])->group(function(){
    Route::get('/edit_review/{id}',[\App\Http\Controllers\MainController::class,'edit'])->name('edit_review');
    Route::post('/edit_review/{id}',[\App\Http\Controllers\MainController::class,'update'])->name('update');
    Route::delete('/delete/{id}',[\App\Http\Controllers\MainController::class,'destroy'])->name('delete');
});



Route::get('/email/verify', function () {
    return view('verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

    $request->fulfill();

    return redirect('/');
})->middleware(['auth'])->name('verification.verify');
