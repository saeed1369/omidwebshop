<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filter;

class Filtervalue extends Model
{
    public  function  filter()
    {
        return $this->belongsTo('App\Filter');
    }
}
