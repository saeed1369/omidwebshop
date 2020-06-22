<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Mostpopular extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
