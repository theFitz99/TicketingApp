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

Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index']);
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->middleware(['auth', 'admin', 'verified'])->name('user.list');
Route::get('users/search', [\App\Http\Controllers\UserController::class, 'search'])->middleware(['auth', 'admin', 'verified'])->name('search.user');
Route::get('/users/{user}/open_tickets', [\App\Http\Controllers\UserController::class, 'showOpenTickets'])->middleware(['auth', 'auth.user', 'verified'])->name('user.open.tickets');
Route::get('users/{user}/open_tickets/search', [\App\Http\Controllers\UserController::class, 'searchOpenTickets'])->middleware(['auth', 'verified'])->name('search.user.open.tickets');
Route::get('/users/{user}/closed_tickets', [\App\Http\Controllers\UserController::class, 'showClosedTickets'])->middleware(['auth', 'auth.user', 'verified'])->name('user.closed.tickets');
Route::get('users/{user}/closed_tickets/search', [\App\Http\Controllers\UserController::class, 'searchClosedTickets'])->middleware(['auth', 'verified'])->name('search.user.closed.tickets');
Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->middleware(['auth', 'auth.user', 'verified'])->name('user.details');
Route::get('/users/{user}/contacts', [\App\Http\Controllers\UserController::class, 'showContacts'])->middleware(['auth', 'auth.user', 'verified'])->name('user.contacts');
Route::get('users/{user}/contacts/search', [\App\Http\Controllers\UserController::class, 'searchContacts'])->middleware(['auth', 'auth.user', 'verified'])->name('search.user.contacts');
Route::get('/users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->middleware(['auth', 'auth.user', 'verified'])->name('user.edit');
Route::put('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->middleware(['auth', 'auth.user', 'verified']);
Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->middleware(['auth', 'admin'. 'verified']);
Route::get('/users/{user}/edit/password', [\App\Http\Controllers\UserController::class, 'editPassword'])->middleware(['auth', 'auth.user', 'verified'])->name('user.edit.password');
Route::put('/users/{user}/edit', [\App\Http\Controllers\UserController::class, 'updatePassword'])->middleware(['auth', 'auth.user', 'verified']);

Route::get('/contacts', [\App\Http\Controllers\ContactsController::class, 'index'])->middleware(['auth', 'verified'])->name('contact.list');
Route::post('/contacts', [\App\Http\Controllers\ContactsController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('/contacts/create', [\App\Http\Controllers\ContactsController::class, 'create'])->middleware(['auth', 'verified'])->name('contact.create');
Route::get('contacts/search', [\App\Http\Controllers\ContactsController::class, 'search'])->middleware(['auth', 'verified'])->name('search.contacts');
Route::get('/contacts/{contacts}/open_tickets', [\App\Http\Controllers\ContactsController::class, 'showOpenTickets'])->middleware(['auth', 'auth.user', 'verified'])->name('contact.open.tickets');
Route::get('contacts/{contacts}/open_tickets/search', [\App\Http\Controllers\ContactsController::class, 'searchOpenTickets'])->middleware(['auth', 'auth.user', 'verified'])->name('search.contacts.open.tickets');
Route::get('contacts/{contacts}/closed_tickets/search', [\App\Http\Controllers\ContactsController::class, 'searchClosedTickets'])->middleware(['auth', 'auth.user', 'verified'])->name('search.contacts.closed.tickets');
Route::get('/contacts/{contacts}/closed_tickets', [\App\Http\Controllers\ContactsController::class, 'showClosedTickets'])->middleware(['auth', 'auth.user', 'verified'])->name('contact.closed.tickets');
Route::get('/contacts/{contacts}', [\App\Http\Controllers\ContactsController::class, 'show'])->middleware(['auth', 'auth.user', 'verified'])->name('contact.details');
Route::get('/contacts/{contacts}/edit', [\App\Http\Controllers\ContactsController::class, 'edit'])->middleware(['auth', 'auth.user', 'verified'])->name('contact.edit');
Route::put('/contacts/{contacts}', [\App\Http\Controllers\ContactsController::class, 'update'])->middleware(['auth', 'auth.user', 'verified']);
Route::delete('/contacts/{contacts}', [\App\Http\Controllers\ContactsController::class, 'destroy'])->middleware(['auth', 'auth.user', 'verified']);

Route::get('/open_tickets', [\App\Http\Controllers\TicketController::class, 'indexOpen'])->middleware(['auth', 'verified'])->name('ticket.open.list');
Route::get('open_tickets/search', [\App\Http\Controllers\TicketController::class, 'searchOpen'])->middleware(['auth', 'verified'])->name('search.open.tickets');
Route::get('/closed_tickets', [\App\Http\Controllers\TicketController::class, 'indexClosed'])->middleware(['auth', 'verified'])->name('ticket.closed.list');
Route::get('closed_tickets/search', [\App\Http\Controllers\TicketController::class, 'searchClosed'])->middleware(['auth', 'verified'])->name('search.closed.tickets');
Route::get('/tickets/create', [\App\Http\Controllers\TicketController::class, 'create'])->middleware(['auth', 'verified'])->name('ticket.create');
Route::post('/open_tickets', [\App\Http\Controllers\TicketController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('/tickets/type', [\App\Http\Controllers\TicketTypeController::class, 'create'])->middleware(['auth', 'admin', 'verified'])->name('ticket.type');
Route::post('/tickets/type', [\App\Http\Controllers\TicketTypeController::class, 'store'])->middleware(['auth', 'admin', 'verified']);
Route::get('/tickets/{ticket}', [\App\Http\Controllers\TicketController::class, 'show'])->middleware(['auth', 'auth.user', 'verified'])->name('ticket.details');
Route::get('/tickets/{ticket}/edit', [\App\Http\Controllers\TicketController::class, 'edit'])->middleware(['auth', 'auth.user', 'verified'])->name('ticket.edit');
Route::put('/tickets/{ticket}', [\App\Http\Controllers\TicketController::class, 'update'])->middleware(['auth', 'auth.user', 'verified']);
Route::delete('/tickets/{ticket}', [\App\Http\Controllers\TicketController::class, 'destroy'])->middleware(['auth', 'auth.user', 'verified']);


require __DIR__.'/auth.php';
