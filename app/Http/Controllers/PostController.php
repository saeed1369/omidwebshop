<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create()
    {
    	return view('post.create');
    }
    public function store(Request $request)
    {
    		$validateddata = $request->validate([
    			"title" => "required|uniqe|max:255",
    			"body"  => "required",
    			// we can use of array too
    			"name" =>['reaquired','uniqe','min:40'],
    			"email" =>"bail",//by bail rull stop runnin validation
    			// if validation fail automatically redirect to previous location and flash errors by session 
    			"publish" =>"nullable",
    		]);
    }
    public function save(StorageBlogPost $request)
    {
    //befor run estatement validation do in storage blog post claass
    }
    // customize error message for fileds
    public function message()
    {
    	return ["title.required"=>"title is required",
    			"email.min" =>"the minimum size is 20",
    		   ];
    }
    protected function prepareForValidation()
    {
    	// prepara data before validation rule
    }

    // if do not use validator request we can make validator manually
    //create validator manually
    public function store2(Request $request)
    {
    	$objvalidator = Validator::make($request->all(),[
    			"title" => 'required',
    			"email" =>"uniqe",
    	]);

    	if($objvalidator->fails())
    	{
    		return redirect('post/ccreate')->withErrors($objvalidator)->withInput();
    		// if we have multiple form in one page we can retrive error message for specefic form
    		return redirect('register')->withErrors($objvalidator,'login');

    		//retrive error maeesage
    		$err = $objvalidator->errors();
    		echo $err->first('email');
    		//get all message for a filed
    		foreach ($err->get('email') as $message) {
    		 	# code...
    		 } ;


    		 //Retrieving All Error Messages For All Fields
    		 foreach ($$err->all() as $key) {
    		 	# code...
    		 }
    		 //Determining If Messages Exist For A Field
    		 //if($err->has('email'))


    	}
    	// Custom Error Messages
    	$message = ['email' =>'email lazem ast'];
    	$val = Validator::make($input,$rule,$messages);

    	// use of custom rule at app/http/rule
    	$val = $request->validate([
    			"name" => "required| new UpperCase"
    	]);
    }
}
