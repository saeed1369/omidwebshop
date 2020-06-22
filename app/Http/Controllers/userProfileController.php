<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class userProfileController extends Controller
{
    public function changeAvatar(Request $request)
    {
        if($request->saveAvatar)
        {
            $file = $request->file('userAvatarImage')->store('users');
              Auth::user()->avatar = $file;
            Auth::user()->save();

        }
      return redirect()->back();

    }

    public function changePassword(Request $request)
    {
        $validatePass = $request->validate([
            'password' => 'required|string|confirmed'
        ]);
        Auth::user()->password = Hash::make($request->password);
        Auth::user()->save();
        Auth::logout();
        return redirect()->route('login');
    }
    public function changeOherAttributes(Request $request)
    {
        $validateAttributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'age' =>'numeric',
            'shoghl' => 'string|nullable',
            'tahsilat' => 'string|nullable',
            'mahalZendegi' =>  'string|nullable',
            'mahalTavalod' =>  'string|nullable',
            'mobile' => 'numeric|nullable',
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->age = $request->age;
        $user->shoghl = $request->shoghl;
        $user->tahsilat = $request->tahsilat;
        $user->gener = $request->gener;
       // $user->mahalZendegi = $request->mahalZendegi;
       // $user->mahalTavalod = $request->mahalTavalod;
        $user->mobile = $request->mobile;
        $user->kodemelli = $request->kodemelli;
        $user->save();
        return redirect()->back();
    }
    public function changeAddress(Request $request)
    {
        $request->validate([
            'ostan' =>  'required |string ',
            'city'  =>  'required |string ',
            'neshaniposti' =>  'required',
            'kodeposti' => 'required ',
        ]);
       $user  =  Auth::user();
       $user->ostan = $request->ostan;
       $user->city = $request->city;
       $user->neshaniposti = $request->neshaniposti;
       $user->pelak = $request->pelak;
       $user->vahed = $request->vahed;
       $user->kodeposti = $request->kodeposti;
       $result = $user->save();
       if($result)
           $message = "آدرس ذخیره شد.";
       else
           $message = 'خطا در ذخیره ادرس';
       return redirect()->back()->with('message' , $message);
    }
    public function address()
    {
        return view('profile.useraddress');
    }
}
