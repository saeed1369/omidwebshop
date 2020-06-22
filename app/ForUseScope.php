<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\AgeScope;

class ForUseScope extends Model
{
    // this class user to show use of scope
    public function boot()
    {
    	parent::boot();
    	static::addGlobalScope(new AgeScope);

    	// If you would like to remove a global scope for a given query, you may use the withoutGlobalScope method.
    	//ForUseScope::withoutGlobalScope(AgeScope::class)->get()

    }
}
