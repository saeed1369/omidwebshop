<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable =['phone_number'];

    // one to one relationship
    public function order()
    {
    	return $this->belongsTo('App\Order');
    }
}
