<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Redirect;

class Store extends Controller
{
    public function __invoke()
    {
        request()->validate([
            'cui' => ['required', 'max:50'],
            'name' => ['required', 'max:255'],
            'contact_person' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'max:20'],
            'reg_com' => ['required', 'max:100'],
            'office_address' => ['required', 'max:500'],
            'capital_social' => ['nullable', 'numeric', 'min:0'],
            'euid' => ['nullable', 'max:100'],
            'bank' => ['nullable', 'max:255'],
            'bank_account' => ['nullable', 'max:50'],
            'iban' => ['nullable', 'string'],
            'loading' => ['boolean'],
        ], [
            'required' => 'Acest câmp este obligatoriu.',
            'email.email' => 'Te rog introdu un email valid.',
            'numeric' => 'Acest câmp trebuie să fie un număr.',
            'max' => 'Acest câmp nu poate avea mai mult de :max caractere.',
        ]);

        Client::create(request()->all());

        return Redirect::to("/clients")->with(['success' => ['message' => 'Clientul a fost salvat cu succes.']]);
    }
}
