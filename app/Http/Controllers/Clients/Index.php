<?php

namespace App\Http\Controllers\Clients;

use Inertia\Inertia;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Client;

class Index extends Controller
{
    public function __invoke()
    {
        request()->validate([
            'perPage' => [Rule::in([10, 15, 25])],
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,cui,contact_person,email,phone']
        ]);

        $perPage = request('perPage') ? request('perPage') : 15;

        $query = Client::query();

        if (request('search')) {
            $terms = explode(' ', request('search'));
            foreach ($terms as $value) {
                $query->where(function ($search) use ($value) {
                    $search->where('name', 'LIKE', '%' . $value . '%');
                    $search->orWhere('cui', 'LIKE', '%' . $value . '%');
                    $search->orWhere('contact_person', 'LIKE', '%' . $value . '%');
                    $search->orWhere('email', 'LIKE', '%' . $value . '%');
                    $search->orWhere('phone', 'LIKE', '%' . $value . '%');
                    $search->orWhere('reg_com', 'LIKE', '%' . $value . '%');
                    $search->orWhere('office_address', 'LIKE', '%' . $value . '%');
                    $search->orWhere('euid', 'LIKE', '%' . $value . '%');
                    $search->orWhere('bank', 'LIKE', '%' . $value . '%');
                    $search->orWhere('iban', 'LIKE', '%' . $value . '%');
                });
            }
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        } else {
            $query->orderByDesc('id');
        }

        return Inertia::render('Clients/Index', [
            'clients' => $query->paginate($perPage)->withQueryString(),
            'filters' => request()->all(['search', 'direction', 'field']),
            'perPage' => intVal($perPage)
        ]);
    }
}
