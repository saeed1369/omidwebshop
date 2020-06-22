<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class mailController extends Controller
{
    public function __cunstruct()
    {

    }
    public function sendMail()
    {
    	Mail::to("sghanbari1990@gmail.com")->send(new OrderMail());

    	//render email without sending
    	//return (new OrderMail())->render();
    	if(Mail::failures())
    		return response()->Fail("sory emai not sent please try again");
    	else
    		return 'email sent successfully';
    }
}
