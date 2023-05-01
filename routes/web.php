<?php

use App\Http\Controllers\{
    AuthController,
    MainController,
    DetailsController,
    SearchController,
};

use Illuminate\Support\Facades\Route;

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


Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');




Route::get('/search', [SearchController::class, 'search'])->name('search');




Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');




Route::get('/details/book/{book}', [DetailsController::class, 'book']);
Route::get('/details/author/{author}', [DetailsController::class, 'author']);
Route::get('/details/publisher/{publisher}', [DetailsController::class, 'publisher']);
Route::get('/details/genre/{genre}', [DetailsController::class, 'genre']);




Route::get('/bag', [DetailsController::class, 'sla'])->name('my-bag');


// Route::fallback(route('index'));
