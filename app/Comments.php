<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //on to many relation
    public function products()
    {
    	return  $this->belongsTo('App\Product');
    }
}
