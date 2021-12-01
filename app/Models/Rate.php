<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    use SoftDeletes, HasFactory;

    public function stores()
    {
        return $this->belongsTo('App\Models\Store', 'stores_id', 'id');
    }
}
