<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LawyerController;

/*
|---------------------------------------------------------------------------
| Authentication Routes
|---------------------------------------------------------------------------
| Routes for user authentication such as login, register, and logout.
*/

Route::controller(FormController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    Route::post('/register', 'create')->name('register');
<<<<<<< HEAD
    Route::get('/logout', 'logout')->name('logout');
=======
    Route::post('/logout', 'logout')->name('logout');
>>>>>>> a4a77b3af6d2c5d30105a896be75a68bf9de411b
});

/*
|---------------------------------------------------------------------------
| Public Routes
|---------------------------------------------------------------------------
| Routes accessible to all users without authentication.
*/

// Home page route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Additional public pages
Route::get('/get-started', function () {
    return view('get-started');
})->name('getStarted');

<<<<<<< HEAD
Route::get('/home', function () {
    return view('home');
})->name('homePage');
=======
>>>>>>> a4a77b3af6d2c5d30105a896be75a68bf9de411b

Route::get('/learn-more', function () {
    return view('learn-more');
})->name('learnMore');

// Lawyer page route
Route::get('/lawyerPage', [LawyerController::class, 'index'])->name('lawyer');

// Chatbot routes
Route::get('/chatbot', [GeminiController::class, 'index'])->name('chatbot.index');
Route::post('/chatbot/chat', [GeminiController::class, 'chat'])->name('chatbot.chat');

/*
|---------------------------------------------------------------------------
| Profile Management Routes
|---------------------------------------------------------------------------
| Routes to handle user profile management (edit, update, destroy).
*/

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');

/*
|---------------------------------------------------------------------------
| Admin Routes
|---------------------------------------------------------------------------
| Routes for admin functionalities such as managing lawyers.
*/

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.index');
    Route::post('/admin/lawyers', 'store')->name('admin.lawyers.store');
    Route::put('/admin/lawyers/{lawyer}', 'update')->name('admin.lawyers.update');
    Route::delete('/admin/lawyers/{lawyer}', 'destroy')->name('admin.lawyers.destroy');
});
