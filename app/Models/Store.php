<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes,HasFactory;

    public function genres()
    {
        return $this->belongsTo('App\Models\Genre','genres_id','id');
    }

    public function rates()
    {
        return $this->hasMany('App\Models\Rate', 'stores_id', 'id');
    }
}
