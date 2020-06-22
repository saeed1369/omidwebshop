<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
 

 /**
  * 
  */
 class AgeScope implements  Scope
 {
 	
 	function __construct(argument)
 	{
 		# code...
 	}
 	public function apply(Builder $builder,Model $model)
 	{
 		$builder->where('age', '>', 200);
 	}
 }

?>