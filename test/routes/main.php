<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MyPlaceController;
use App\Http\Controllers\Posts\CommentController;
use Illuminate\Support\Facades\Route;


/*Route::get('/', function () {
    return "Hello Laravel. I will be the best Laravel Dev and will be Trainee at IO and will buy a trading course and will work on my startups. Goal is to be billionaire";
});

Route::get('view', 'App\Http\Controllers\MyPlaceController@index');
*/

Route::redirect('/', 'blog')->name('home');
Route::redirect('/home/', 'blog');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});

Route::get('logout', [LogoutController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('blog', [BlogController::class, 'index'])->name('blog');
Route::get('blog/filter', [BlogController::class, 'filter'])->name('blog.filter');

Route::get('blog/{post}', [BlogController::class, 'show'])->name('blog.show');
Route::post('blog/{post}/like', [BlogController::class, 'like'])->name('blog.like');


Route::resource('posts/{post}/comments', CommentController::class)->only([
    'index', 'show'
]);


