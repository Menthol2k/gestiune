<?php

namespace App\Http\Controllers\Clients;

use Inertia\Inertia;
use App\Models\Client;
use App\Http\Controllers\Controller;

class Edit extends Controller
{
    public function __invoke(Client $client)
    {
        return Inertia::render('Clients/Edit', [
            'client' => $client
        ]);
    }
}
