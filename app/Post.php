<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // one to many relation
    public function comment()
    {
    	return $this->hasMany('App\Comments');
    }
}
