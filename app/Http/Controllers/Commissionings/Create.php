<?php

namespace App\Http\Controllers\Commissionings;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Inertia\Inertia;

class Create extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Commissionings/Create', [
            'clients' => Client::get(['id', 'name'])
        ]);
    }
}