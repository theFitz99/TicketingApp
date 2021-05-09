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
Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->middleware(['auth', 'admin'])->name('user.list');
Route::post('users/search', [\App\Http\Controllers\UserController::class, 'search'])->middleware(['auth', 'admin'])->name('search.user');
Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->middleware(['auth', 'auth.user'])->name('user.details');
Route::get('/users/{user}/contacts', [\App\Http\Controllers\UserController::class, 'showContacts'])->middleware(['auth', 'auth.user']);
Route::post('users/{user}/contacts/search', [\App\Http\Controllers\UserController::class, 'searchContacts'])->middleware(['auth', 'auth.user'])->name('search.user.contacts');
Route::get('/users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->middleware(['auth', 'auth.user']);
Route::put('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->middleware(['auth', 'auth.user']);
Route::get('/users/{user}/edit/password', [\App\Http\Controllers\UserController::class, 'editPassword'])->middleware(['auth', 'auth.user']);
Route::put('/users/{user}/edit', [\App\Http\Controllers\UserController::class, 'updatePassword'])->middleware(['auth', 'auth.user']);
Route::get('/contacts', [\App\Http\Controllers\ContactsController::class, 'index'])->middleware(['auth'])->name('contacts.list');
Route::post('/contacts', [\App\Http\Controllers\ContactsController::class, 'store'])->middleware(['auth']);
Route::get('/contacts/create', [\App\Http\Controllers\ContactsController::class, 'create'])->middleware(['auth'])->name('contacts.create');
Route::get('/contacts/{contacts}', [\App\Http\Controllers\ContactsController::class, 'show'])->middleware(['auth', 'auth.user'])->name('contact.details');
Route::get('/contacts/{contacts}/edit', [\App\Http\Controllers\ContactsController::class, 'edit'])->middleware(['auth', 'auth.user']);
Route::put('/contacts/{contacts}', [\App\Http\Controllers\ContactsController::class, 'update'])->middleware(['auth', 'auth.user']);
Route::delete('/contacts/{contacts}', [\App\Http\Controllers\ContactsController::class, 'destroy'])->middleware(['auth', 'auth.user']);
Route::post('contacts/search', [\App\Http\Controllers\ContactsController::class, 'search'])->middleware(['auth'])->name('search.contacts');
Route::get('contacts/search', function () { return abort(404); });
Route::get('users/search', function () { return abort(404); });
Route::get('users/{user}/contacts/search', function () { return abort(404); });

require __DIR__.'/auth.php';
