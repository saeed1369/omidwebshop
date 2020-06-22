<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  App\Product;

class Productimage extends Model
{
    public $timestamps = false ;
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
