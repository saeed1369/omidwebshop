<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use Illuminate\Support\Facades\Auth;

class saleController extends Controller
{
    public function getUserPurchase()
    {
        $userId = Auth::id();
        $purchases = Sale::where('user_id',$userId)->get();
        return view('profile.purchasesUser')->with(['purchases' => $purchases]);
    }
}
