<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  App\Productimage;
use App\Mostpopular;
use test\Mockery\ReturnTypeObjectTypeHint;

class Product extends Model
{
    public $additional_attributes = ['fullname'];
        public function comments()
        {
            return $this->hasMany('App\Comment');
        }
    public function productfilters()
    {
        return $this->hasMany('App\Productfilter');
    }
    public function productimages()
    {
        return $this->hasMany('App\Productimage');
    }
    public function mostpopular()
    {
        Return $this->hasOne('App\Mostpopular');
    }
// define a cccessor for show in relationshp for mostpopular bread
   public function getFullnameAttribute()
   {
       return "{$this->id}-{$this->name}-{$this->price}-{$this->catagory1}";
   }


}
