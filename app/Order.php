<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
	//protected $dateFormat = 'U';
    //protected $cast = ['is_admin' =>'boolean', 'created_at' => 'datetime:Y-m-d'];

   protected  $fillable = ['name','maghsad'];

   // create relation one to one with class phone
   public function phone()
   {
   	return $this->hasOne('App\Phone');
   }

   // accessor
   public function getNameAttribute($value)
   {
   	return ucfirst($value);
   }

   //mutatore
   public function setNameAttribute($value)
   {
   		$this->attributes['name'] = strtolower($value);
   }
}
