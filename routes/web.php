<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PointerController;
use App\Http\Controllers\EmailController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/addnewuser', function () { return view('add'); });
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
    Route::post('/arrival', [PointerController::class, 'arrival'])->name('arrival');
    Route::post('/depart', [PointerController::class, 'depart'])->name('depart');
    Route::get('/users/present/{id}', [PointerController::class, 'showPointerInfo'])->name('users.present');
    Route::post('/stop', [UserController::class, 'disableAccount'])->name('stop.account');
    Route::post('/play', [UserController::class, 'enableAccount'])->name('play.account');
});

Route::post('/', [EmailController::class, 'sendEmail'])->name('send.email');

//Bloquer la route register
Route::redirect('/register', '/');

require __DIR__.'/auth.php';
