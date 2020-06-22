<?php

namespace App\Http\Controllers;

use App\Product;
use App\Sale;
use App\Payment;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pardakhtController extends Controller
{

    public function pardakht(Request $request)
    {
        $request->validate([
            'ostan' => 'required',
            'city' => 'required',
            'neshaniposti' => 'required',
            'kodeposti' => 'required',
            'namegirandeh' => 'required',
            'kodemelli' => 'required',
            'mobile' => 'required',
        ]);

      if($request)
      {

          //save address in session
          $address = "استان: " .$request->ostan ." شهرستان : ". $request->city ."نشانی : " .$request->neshaniposti . " پلاک : ".$request->pelak . " واحد : " .$request->vahed  . "   کد پستی : " . $request->kodeposti ;
          $namegirandeh = $request->namegirandeh;
          $mbile =  $request->mobile;
          $kodemelli = $request->kodemelli;
          session_start();
          $_SESSION['address'] = $address;
          $_SESSION['namegirandeh'] = $namegirandeh;
          $_SESSION['mbile'] = $mbile;
          $_SESSION['kodemelli'] = $kodemelli;
          $_SESSION['pay'] = $request->pay;

          // cahnge mablagh to rial
          $mablagh = $request->pay * 10;
          $objPay = new Payment();
          $res =  $objPay->pay($mablagh);

          //return "pardakht anjam shod";
          // echo  $res->errorMessage;

          return view('sabadKharid')->withErrors($res->errorMessage);
      }
      else
      {
          echo "dobareeeeeeeeeeeeeeeeeeh";
         return redirect()->back();
      }
    }
    public function continuepardakht(Request $request)
    {
        $request->flash();
        return view('continuePardakht');
    }
    public function processAfterPay()
    {
        session_start();
        $objPay = new Payment();
        $res =  $objPay->afterPayProcess();
        if(isset($res->transId))
        {
            $pid = Sale::where('transId',$res->transId)->get();
            if($pid->count() == 0)
            {
                $this->addFactorToDatabase($res);
                $address = $_SESSION['address'];
                $mobile = $_SESSION['mbile'];
                $namegirandeh = $_SESSION['namegirandeh'];
                $pay = $_SESSION['pay'];
                $number = session('numCart');
                session()->forget('cartItem');
                session()->forget('numCart');
                session()->forget('mobile');
                session()->forget('kodemelli');
                session()->forget('address');
                session()->forget('namegirandeh');
                return redirect('/finalpardakht')->with([
                    "pardakht" => "<h6>سفارس شما با موفقیت در سیستم ثبت شد و هم اکنون <span class=\"bg-success \">در حال پردازش </span> است . جزییات سفارش را می توانید در پروفایل کاربری خود مشاهده نمایید.</h6>",
                    'result' => $res,
                    'mobile' => $mobile,
                    'namegirandeh' => $namegirandeh ,
                    'number' => $number ,
                    'address' => $address,
                    'mablagh' => $pay ,
                    ]);
            }
            else

            return redirect('/sabadKharid')->with('pardakht','این تراکنش قبلا انجام شده است');
        }
        else
        {
            return redirect('/sabadKharid')->with('pardakht','خطا در پرداخت عملیات');
        }
    }

    public  function addFactorToDatabase($result)
    {
       if(Auth::check())
       {

           $userid = Auth::id();

           foreach (session('cartItem') as $item)
           {
               $sale = new Sale();
               $sale->name = $item['name'];
               $sale->price = $item['price'];
               $sale->number = $item['number'];
               $sale->takhfif = $item['takhfif'];
               $sale->catagory1 = $item['catagory1'];
               $sale->catagory2 = $item['catagory2'];
               $sale->catagory3 = $item['catagory3'];
               $sale->transId = $result->transId;
               $sale->user_id = $userid;
               $sale->product_id = $item['id'];
               $sale->address = $_SESSION['address'];
               $sale->mobile = $_SESSION['mbile'];
               $sale->kodemelli = $_SESSION['kodemelli'];
               $sale->namegirandeh = $_SESSION['namegirandeh'];
               $sale->status ='در حال پردازش';
               $sale->save();


               //manupulate number of available products
               $product = Product::find($sale->product_id);
                $product->available = $product->available - $sale->number;
               $product->save();


           }

           $pay = new Payment();
           $pay->mablagh = ( $result->amount)/10;
           $pay->transId = $result->transId;
           $pay->cardNumber = $result->cardNumber;
           $pay->user_id = $userid;
           $pay->save();
       }

    }
    public function finalpardakht()
    {
        return view('finalpardakht');
    }
}
