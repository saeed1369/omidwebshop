<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
     public $api = 'test';
     private  $mobile = "09170536465";
     private  $amount = 0;
     private  $factorNumber = "FactorNumber (optional)";
     private  $description = "Description (optional)";
     protected  $redirect ='http://shop-laravel.com/processAfterPay';
    public function __construct(array $attributes = [])
    {
       // parent::__construct($attributes);
        require_once('pay.ir/functions.php');
    }

    public  function user()
    {
        return $this->belongsTo('App\User');
    }
    public function pay($mablagh)
    {

        $this->amount = $mablagh;
        $result = send($this->api,$this->amount,$this->redirect,$this->mobile);
        $result = json_decode($result);
        if($result->status == 1) {
            $go = "https://pay.ir/pg/$result->token";
            header("Location: $go");
            exit();
        } else {

         //  return redirect()->route('login');

         //  echo $result->errorMessage;
         //   return redirect('/');
         //   echo $result->errorMessage;
          // redirect('sabadKharid');
         //  exit();
            return $result;
        }
    }
    public function afterPayProcess()
    {
        if(isset($_GET['status']) && $_GET['status'] == 1)
        {

            include_once("pay.ir/functions.php");

            $api = $this->api;
            $token = $_GET['token'];
            $result = json_decode(verify($api,$token));
            if(isset($result->status))
            {
                if ($result->status == 1)
                    return $result;

                else
                    return $result;
            }


        }
        else if($_GET['status'] == 0)
        $result= "errorr";
        return $result;
    }
}
