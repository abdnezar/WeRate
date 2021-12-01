<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use SoftDeletes,HasFactory;

    public function stores()
    {
        return $this->hasOne('App\Models\Store','genres_id','id');
    }
}
