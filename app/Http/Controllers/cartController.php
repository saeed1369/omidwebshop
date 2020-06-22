<?php

namespace App\Http\Controllers;

use App\Productimage;
use Illuminate\Http\Request;
use App\Product;


class  cartController extends Controller
{
    public function AddToCart($productId,$number = 1)
    {
        session_start();
        $product = Product::find($productId);
        $imageproduct = Productimage::where('product_id',$productId)->first();
        $image1 = $imageproduct->image;
        $has = session()->has('cartItem');
        if(!$has)
        {
            session(['cartItem' => array($productId =>
                                          array('name' => $product->name ,'id' =>$product->id ,'price' =>$product->price ,
                                              'number' =>$number ,'takhfif' =>$product->takhfif,'image' =>$image1 ,
                                              'catagory1' =>$product->catagory1,'catagory2' =>$product->catagory2,'catagory3' =>$product->catagory3,
                                          )
                                      )
                   ] );

        }
        else
        {
            $data = session("cartItem" );

            if(array_key_exists($productId,$data))
            {
                $data[$productId]['number'] += $number;
                session(['cartItem' => $data]);

            }
            else
            {
               $newItem = array('name' => $product->name ,'id' =>$product->id ,'price' =>$product->price ,
                                 'number' =>$number ,'takhfif' =>$product->takhfif ,'image' =>$image1,
                                  'catagory1' =>$product->catagory1,'catagory2' =>$product->catagory2,'catagory3' =>$product->catagory3,
                               );
               $data [$productId] = $newItem;
                session(  ['cartItem' => $data]);


            }
        }
        //calculate number of carts for show in sabadkharid header
        $this->calculateNumCart();
       return redirect('/sabadKharid');
      //  session()->flush();
       // echo session('numCart');
    }
    private function  calculateNumCart()
    {
        $numCart = 0;
        foreach (session('cartItem') as $cart)
        {
            $numCart += $cart['number'];
        }
        session(['numCart'=>$numCart]);
    }
    public function incrementProduct($id,$number)
    {
        $product = Product::find($id);

        $data = session("cartItem" );
        if( ($product->available )  >= $number)
           $data[$id]['number'] = $number;
        session(['cartItem' => $data]);
        $this->calculateNumCart();
        return redirect('/sabadKharid');

    }
    public function deleteItemFromCart($productId)
    {
        $data = session("cartItem" );
        unset($data[$productId]);
        session(['cartItem' => $data]);
        $data = session("cartItem" );
        echo count($data);
        $this->calculateNumCart();
        return redirect('/sabadKharid');
    }
}

