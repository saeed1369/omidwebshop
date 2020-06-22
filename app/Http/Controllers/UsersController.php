<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\MyMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    //
    public function show(Request $request)
    {
    	 $value = $request->session()->get('key');
    }
	    public function sendMail()
	{
		$user = user::find(1);
	}
}
