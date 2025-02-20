<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionItems extends Model
{
    protected $guarded = ['id'];

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }
}
