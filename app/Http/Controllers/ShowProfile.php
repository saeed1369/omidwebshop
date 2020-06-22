<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowProfile extends Controller
{
	public function __construct()
	{
		//$this->middleware('auth');
		//perform middleware only on function index
		$this->middleware('log')->only('index');

		//register middleware using a Closure.
		$this->middleware(function ($request,$next){
				//......
			return $next($request);
		}); 
	}
    public function  __invoke($id)
    {
    	return "profile id is :" .$id;
    }
    public function path(Request $request,$id)
    {
    	//return $request->path();
    	// if( $request->is('admin/*'))
    	// 	return "yes";
    //	return $request->url();
    	//$id2 = $request->all();
    	$id2 = $request->input();
    	var_dump($id2);
    	//if ($request->has('name'))
    	//if ($request->filled('name'))
    	//$request->flash();
    	//$request->flashOnly(['username', 'email']);
    	//$request->flashExcept('password');
    	//return redirect('form')->withInput();

         //return redirect('form')->withInput(
              // $request->except('password')

    	//$username = $request->old('username');
    	//$value = $request->cookie('name');

    	//return response('Hello World')->cookie(
                      //'name', 'value', $minutes);


    	//$cookie = cookie('name', 'value', $minutes);
        //return response('Hello World')->cookie($cookie);

        //file
        //$file = $request->file('photo');
        // if ($request->file('photo')->isValid())


        // save uploadedfile
        //$path = $request->photo->store('images');


    }
}
