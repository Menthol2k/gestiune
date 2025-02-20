<?php

use App\Http\Controllers\Commissionings\Download;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Commissionings\Index;
use App\Http\Controllers\Commissionings\Create;
use App\Http\Controllers\Commissionings\Store;

Route::middleware(['auth'])->group(function () {
    Route::prefix('commissionings')
        ->as('commissionings.')
        ->namespace('')
        ->group(function () {
            Route::get('', Index::class)->name('index');
            Route::get('create', Create::class)->name('create');
            Route::post('store', Store::class)->name('store');
            Route::get('{commission}/download', Download::class)->name('index');
        });
});
