<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MyMail;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
		public function sendMail($orderId)
		{
			$order = Order::findOrFail($orderId);
			Mail::to("sghanbari1990@gmail.com")->send(new MyMail($order));
		}

		// for use of cache
		public function getcache()
		{
			return cache::get('key');

			
		}
}
