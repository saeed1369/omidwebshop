<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filtervalue;

class Filter extends Model
{
    public function filtervalues()
    {
        return $this->hasMany('App\Filtervalue');
    }
}
