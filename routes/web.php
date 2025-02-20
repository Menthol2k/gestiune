<?php

use Inertia\Inertia;
use App\Classes\iTrackAnaf;
use App\Http\Controllers\Impersonate;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['web', 'auth', 'can:view dashboard']);
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['web', 'auth', 'can:view dashboard'])->name('dashboard');

Route::post('/impersonate/{id}', [Impersonate::class, 'impersonate'])->middleware('auth');
Route::post('/exitimpersonate', [Impersonate::class, 'exitImpersonate'])->middleware('auth');

Route::get('itrack/{cui}', function ($cui) {
    return response()->json(iTrackAnaf::fetch($cui));
})->middleware('auth')->name('itrack');

//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified',
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return Inertia::render('Dashboard');
//    })->name('dashboard');
//});

require __DIR__.'/app/permissions.php';
require __DIR__.'/app/users.php';
require __DIR__.'/app/roles.php';
require __DIR__ .'/app/clients.php';
require __DIR__ .'/app/commissionings.php';
