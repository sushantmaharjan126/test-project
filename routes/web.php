<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ForgetPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;


use App\Http\Controllers\User\UserRegisterController;
use App\Http\Controllers\User\UserLoginController;


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    
    Route::get('/password/reset', [ForgetPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('/password/email', [ForgetPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');

    Route::get('password/reset/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
	Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile/{admin}', [AdminController::class, 'edit'])->name('admin.profile');

    Route::resource('admins', AdminController::class)->only(['index', 'create', 'store']);
    Route::get('admin/edit/{admin}', [AdminController::class, 'edit'])->name('admins.edit');
    Route::post('admin/edit/{admin}', [AdminController::class, 'update'])->name('admins.update');
    Route::get('admin/delete/{id}', [AdminController::class, 'destroy'])->name('admins.delete');

    Route::resource('movies', MovieController::class)->only(['index', 'create', 'store']);
    Route::get('movies/edit/{movie}', [MovieController::class, 'edit'])->name('movies.edit');
    Route::post('movies/edit/{movie}', [MovieController::class, 'update'])->name('movies.update');
    Route::get('movies/delete/{id}', [MovieController::class, 'destroy'])->name('movies.delete');

    Route::resource('users', UserController::class)->only(['index']);
    Route::get('users/show/{user}', [UserController::class, 'edit'])->name('users.show');
    Route::get('users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');

});

Route::prefix('user')->group(function(){
    Route::post('register', [UserRegisterController::class, 'register'])->name('user.register.submit');
    
    Route::post('login', [UserLoginController::class, 'login'])->name('user.login.submit');
    Route::get('logout', [UserLoginController::class, 'logout'])->name('user.logout');
});


Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'register'])->name('register');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/my-fav-movies', [HomeController::class, 'favMovies'])->name('favMovies');
Route::get('/movie/{movie}', [HomeController::class, 'movie'])->name('movie');
Route::get('/like-movie/{movie}', [HomeController::class, 'likeMovie'])->name('likeMovie');
Route::get('/favorite-movie/{movie}', [HomeController::class, 'favoriteMovie'])->name('favoriteMovie');
