<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BlogController;


Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('about');

//User
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'profile_submit'])->name('profile_submit');
});
Route::get('/registration', [UserController::class, 'registration'])->name('registration');
Route::post('/registration', [UserController::class, 'registration_submit'])->name('registration_submit');
Route::get('/registration-verify/{token}/{email}', [UserController::class, 'registration_verify'])->name('registration_verify');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login_submit'])->name('login_submit');
Route::get('/forget-password', [UserController::class, 'forget_password'])->name('forget_password');
Route::post('/forget-password', [UserController::class, 'forget_password_submit'])->name('forget_password_submit');
Route::get('/reset-password/{token}/{email}', [UserController::class, 'reset_password'])->name('reset_password');
Route::post('/reset-password/{token}/{email}', [UserController::class, 'reset_password_submit'])->name('reset_password_submit');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


//Admin

Route::middleware('admin')->prefix('admin')->group(function(){

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin_profile');
    Route::post('/profile', [AdminController::class, 'profile_submit'])->name('admin_profile_submit');

    /* ---- ARTISTS CRUD ---- */
    Route::resource('artists', \App\Http\Controllers\Admin\ArtistController::class)
        ->names('admin.artists');

    Route::post('artists/{artist}/toggle-status',
        [\App\Http\Controllers\Admin\ArtistController::class, 'toggleStatus']
    )->name('admin.artists.toggleStatus');

    /* ---- PAINTINGS CRUD ---- */
    Route::resource('paintings', \App\Http\Controllers\Admin\PaintingController::class)
        ->names('admin.paintings');  // << FIXED

    Route::post('paintings/{painting}/toggle-status',
        [\App\Http\Controllers\Admin\PaintingController::class, 'toggleStatus']
    )->name('admin.paintings.toggleStatus');


    Route::resource('admin-users', AdminUserController::class)->names('admin.admin-users');
    Route::get('admin-users/{admin_user}/toggle-status', [AdminUserController::class, 'toggleStatus'])
         ->name('admin.admin-users.toggle-status');



 Route::resource('categories', CategoryController::class)->names('admin.categories');


 /* ---- GALLERIES CRUD ---- */
    Route::resource('galleries', \App\Http\Controllers\Admin\GalleryController::class)
        ->names('admin.galleries');

    Route::post('galleries/{gallery}/toggle-status', 
        [\App\Http\Controllers\Admin\GalleryController::class, 'toggleStatus']
    )->name('admin.galleries.toggleStatus');


    Route::resource('blogs', BlogController::class)->names('admin.blogs');
Route::post('blogs/toggle/{blog}', [BlogController::class, 'toggleStatus'])->name('admin.blogs.toggle');




/* ---- EVENTS CRUD ---- */
Route::resource('events', \App\Http\Controllers\Admin\EventController::class)
    ->names('admin.events');

Route::post('events/{event}/toggle-status',
    [\App\Http\Controllers\Admin\EventController::class, 'toggleStatus']
)->name('admin.events.toggleStatus');


});





Route::prefix('admin')->group(function(){
    Route::get('/', function(){return redirect()->route('admin_login');});
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password/{token}/{email}', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
});








Route::get('blogs', function () {
    return view('admin.blogs.index');
})->name('admin.blogs.index');

Route::get('analytics', [\App\Http\Controllers\Admin\AdminController::class, 'analytics'])
    ->name('admin.analytics');
