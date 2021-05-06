<?php

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

Route::get('/', [\App\Http\Controllers\ContactsController::class, 'index'])->middleware(['auth']);
Route::get('/contacts', [\App\Http\Controllers\ContactsController::class, 'index'])->middleware(['auth'])->name('contacts.list');
Route::get('/contacts/create', [\App\Http\Controllers\ContactsController::class, 'create'])->middleware(['auth'])->name('contacts.create');
Route::post('/contacts', [\App\Http\Controllers\ContactsController::class, 'store'])->middleware(['auth']);
Route::get('/contacts/{contacts}', [\App\Http\Controllers\ContactsController::class, 'show'])->middleware(['auth', 'auth.user']);
Route::get('/contacts/{contacts}/edit', [\App\Http\Controllers\ContactsController::class, 'edit'])->middleware(['auth', 'auth.user']);
Route::put('/contacts/{contacts}', [\App\Http\Controllers\ContactsController::class, 'update'])->middleware(['auth', 'auth.user']);
Route::delete('/contacts/{contacts}', [\App\Http\Controllers\ContactsController::class, 'destroy'])->middleware(['auth', 'auth.user']);
Route::post('/search/', [\App\Http\Controllers\ContactsController::class, 'search'])->name('search');
Route::get('/search/', function () { return abort(404); });
Route::get('/myaccount/', [\App\Http\Controllers\UserController::class, 'index'])->middleware(['auth'])->name('my.account');
Route::get('/myaccount/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->middleware(['auth', 'auth.user']);
Route::put('/myaccount/{user}', [\App\Http\Controllers\UserController::class, 'update'])->middleware(['auth', 'auth.user']);
Route::get('/myaccount/{user}/edit/password', [\App\Http\Controllers\UserController::class, 'editPassword'])->middleware(['auth', 'auth.user']);
Route::put('/myaccount/{user}/edit', [\App\Http\Controllers\UserController::class, 'updatePassword'])->middleware(['auth', 'auth.user']);

require __DIR__.'/auth.php';
