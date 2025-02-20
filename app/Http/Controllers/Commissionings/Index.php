<?php

namespace App\Http\Controllers\Commissionings;

use Inertia\Inertia;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Commission;

class Index extends Controller
{
    public function __invoke()
    {
        request()->validate([
            'perPage' => [Rule::in([10, 15, 25])],
            'direction' => ['in:asc,desc'],
            'field' => ['in:number,year,items_count,status,completed']
        ]);

        $perPage = request('perPage') ? request('perPage') : 15;

        $query = Commission::with('items:id,name', 'client:id,name', 'createdBy:id,name')->withCount('items');

        if (request('search')) {
            $terms = explode(' ', request('search'));
            foreach ($terms as $value) {
                $query->where(function ($search) use ($value) {
                    $search->where('number', 'LIKE', '%' . $value . '%');
                    $search->orWhere('year', 'LIKE', '%' . $value . '%');
                    $search->orWhereHas('client', function ($client) use ($value) {
                        $client->where('name', 'LIKE', '%' . $value . '%');
                    });
                    $search->orWhereHas('createdBy', function ($client) use ($value) {
                        $client->where('name', 'LIKE', '%' . $value . '%');
                    });
                });
            }
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        } else {
            $query->orderByDesc('id');
        }

        return Inertia::render('Commissionings/Index', [
            'commissions' => $query->paginate($perPage)->withQueryString(),
            'perPage' => intVal($perPage),
            'filters' => request()->all(['search', 'field', 'direction'])
        ]);
    }
}
