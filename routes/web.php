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

Route::get('/', [\App\Http\Controllers\ContactsController::class, 'index']);
Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->middleware(['auth', 'admin'])->name('user.list');
Route::post('users/search', [\App\Http\Controllers\UserController::class, 'search'])->middleware(['auth', 'admin'])->name('search.user');
Route::get('/users/{user}/open_tickets', [\App\Http\Controllers\UserController::class, 'showOpenTickets'])->middleware(['auth', 'auth.user'])->name('user.open.tickets');
Route::get('/users/{user}/closed_tickets', [\App\Http\Controllers\UserController::class, 'showClosedTickets'])->middleware(['auth', 'auth.user'])->name('user.closed.tickets');
Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->middleware(['auth', 'auth.user'])->name('user.details');
Route::get('/users/{user}/contacts', [\App\Http\Controllers\UserController::class, 'showContacts'])->middleware(['auth', 'auth.user'])->name('user.contacts');
Route::post('users/{user}/contacts/search', [\App\Http\Controllers\UserController::class, 'searchContacts'])->middleware(['auth', 'auth.user'])->name('search.user.contacts');
Route::get('/users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->middleware(['auth', 'auth.user'])->name('user.edit');
Route::put('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->middleware(['auth', 'auth.user']);
Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->middleware(['auth', 'admin']);
Route::get('/users/{user}/edit/password', [\App\Http\Controllers\UserController::class, 'editPassword'])->middleware(['auth', 'auth.user'])->name('user.edit.password');
Route::put('/users/{user}/edit', [\App\Http\Controllers\UserController::class, 'updatePassword'])->middleware(['auth', 'auth.user']);

Route::get('/contacts', [\App\Http\Controllers\ContactsController::class, 'index'])->middleware(['auth'])->name('contact.list');
Route::post('/contacts', [\App\Http\Controllers\ContactsController::class, 'store'])->middleware(['auth']);
Route::get('/contacts/create', [\App\Http\Controllers\ContactsController::class, 'create'])->middleware(['auth'])->name('contact.create');
Route::get('/contacts/{contacts}/open_tickets', [\App\Http\Controllers\ContactsController::class, 'showOpenTickets'])->middleware(['auth', 'auth.user'])->name('contact.open.tickets');
Route::get('/contacts/{contacts}/closed_tickets', [\App\Http\Controllers\ContactsController::class, 'showClosedTickets'])->middleware(['auth', 'auth.user'])->name('contact.closed.tickets');
Route::get('/contacts/{contacts}', [\App\Http\Controllers\ContactsController::class, 'show'])->middleware(['auth', 'auth.user'])->name('contact.details');
Route::get('/contacts/{contacts}/edit', [\App\Http\Controllers\ContactsController::class, 'edit'])->middleware(['auth', 'auth.user'])->name('contact.edit');
Route::put('/contacts/{contacts}', [\App\Http\Controllers\ContactsController::class, 'update'])->middleware(['auth', 'auth.user']);
Route::delete('/contacts/{contacts}', [\App\Http\Controllers\ContactsController::class, 'destroy'])->middleware(['auth', 'auth.user']);

Route::post('contacts/search', [\App\Http\Controllers\ContactsController::class, 'search'])->middleware(['auth'])->name('search.contacts');
Route::get('contacts/search', function () { return abort(404); });
Route::get('users/search', function () { return abort(404); });
Route::get('users/{user}/contacts/search', function () { return abort(404); });

Route::get('/open_tickets', [\App\Http\Controllers\TicketController::class, 'indexOpen'])->middleware(['auth'])->name('ticket.open.list');
Route::get('/closed_tickets', [\App\Http\Controllers\TicketController::class, 'indexClosed'])->middleware(['auth'])->name('ticket.closed.list');
Route::get('/tickets/create', [\App\Http\Controllers\TicketController::class, 'create'])->middleware(['auth'])->name('ticket.create');
Route::post('/open_tickets', [\App\Http\Controllers\TicketController::class, 'store'])->middleware(['auth']);
Route::get('/tickets/type', [\App\Http\Controllers\TicketTypeController::class, 'create'])->middleware(['auth', 'admin'])->name('ticket.type');
Route::post('/tickets/type', [\App\Http\Controllers\TicketTypeController::class, 'store'])->middleware(['auth', 'admin']);
Route::get('/tickets/{ticket}', [\App\Http\Controllers\TicketController::class, 'show'])->middleware(['auth', 'auth.user'])->name('ticket.details');
Route::get('/tickets/{ticket}/edit', [\App\Http\Controllers\TicketController::class, 'edit'])->middleware(['auth', 'auth.user'])->name('ticket.edit');
Route::put('/tickets/{ticket}', [\App\Http\Controllers\TicketController::class, 'update'])->middleware(['auth', 'auth.user']);
Route::delete('/tickets/{ticket}', [\App\Http\Controllers\TicketController::class, 'destroy'])->middleware(['auth', 'auth.user']);


require __DIR__.'/auth.php';
