<?php

namespace App\Http\Controllers\Commissionings;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Commission;
use App\Models\CommissionItems;
use Illuminate\Support\Facades\Redirect;

class Store extends Controller
{
    public function __invoke()
    {

        $last_number = Commission::latest()->first();

        request()->validate([
            'client_id' => ['required'],
            'created_by' => ['required'],
            'items.*.name' => ['required']
        ], [
            'required' => 'Campul este obligatoriu'
        ]);

        $commission = Commission::create([
            'client_id' => request('client_id'),
            'created_by' => request('created_by'),
            'completed' => now()->format('Y-m-d'),
            'template' => 1,
            'number' => $last_number ? (intval($last_number->number) + 1) : 1,
            'year' => now()->format('Y'),
            'status' => 1,
        ]);

        $items = request('items');

        foreach($items as $item){
            CommissionItems::create([
                'commission_id' => $commission->id,
                'name' => $item['name']
            ]);
        }

        return Redirect::to('/commissionings')->with(['success' => ['message' => 'Procesul verbal a fost adaugat cu succes!']]);
    }
}
