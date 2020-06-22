<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Filter;
use App\Filtervalue;
use App\Product;
use App\Productfilter;
use App\Sale;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\Category;

class productController extends Controller
{
    //
    public function getAllProduct(Request $request ,$cat1,$cat2=null,$cat3=null)
    {

        $cat = array(['cat1' =>$cat1 , 'cat2' => $cat2  , 'cat3' => $cat3]);

        if($cat2 != null && $cat3 == null) {

                $products = Product::where('catagory1',$cat1)->where('catagory2',$cat2)->latest()->get();
        }
        elseif ($cat2 != null && $cat3 != null)
        {
                $products = Product::where('catagory1',$cat1)->where('catagory2',$cat2)->where('catagory3',$cat3)->latest()->get();
        }

        else
        {
            $products = Product::where('catagory1',$cat1)->latest()->get();
        }

        $productsPrime = $products;

        //------------------------------- if one of filters is set -----------------------------------------
        if($request->query())
        {
            //var_dump($request->query());
            //echo "<br>";
            $selectedProducts = $products->pluck('id');
            $productkeys = array();
            foreach ($selectedProducts as $fp)
            {
                array_push($productkeys,$fp);
            }
            $selectedfilter = Productfilter::whereIn('product_id',$productkeys)->get();


            foreach ($request->query() as $key => $value)
            {
               if($key == 'priceRange')
                   continue;
                $selectedfilter = $selectedfilter->where('slug',"=",$key)->whereIn('filterValue',$value);
                $filteredProducts = $selectedfilter->pluck('product_id');
                $selectedfilter =  Productfilter::whereIn('product_id',$filteredProducts)->get();


            }
           // echo $filterdProducts->toSql()."<br>";

            $filterkeys = array();
            foreach ($selectedfilter as $sf)
            {
                array_push($filterkeys,$sf->product_id);
            }
            if(isset($request->priceRange))
            {

                $products = $products->whereIn('id',$filterkeys)->whereBetween('price',[1,$request->priceRange]);

            }
            else
            {
                $products = $products->whereIn('id',$filterkeys) ;
            }


            //exit('exit');
            // return redirect()->back()->withInput();

        }

       // $products = $products->get();

        //------------------- retrive filter that show in side column of product ---------------------------

        $filter = array();
        foreach ($productsPrime as $productfilter)
        {
            array_push($filter,$productfilter->id);

        }

        $availablefilter = Productfilter::whereIn('product_id',$filter)->get();
        $availablefilter = $availablefilter->unique('filterName');

        $filter = array();
        foreach ($availablefilter as $ff)
        {
               array_push($filter,$ff->filterName);
        }

        $availablefilter = Filter::whereIn('name',$filter)->get();

        $filter = array();
        foreach ($availablefilter as $ff)
        {
            array_push($filter,$ff->id);
        }
        $availablefilterfiltervalue = Filtervalue::whereIn('filter_id',$filter)->get();

        //-------------------------------------- end of section retrive filter---------------------------

        // --------------- get image of products ----------------


        return view('products')->with(['products' =>$products  , 'catagory' => $cat ,'avalablefilter' =>$availablefilter , 'avaliblefiltervalue' => $availablefilterfiltervalue,'requestold'=> $request ] );


    }



    // get detail of one product
    public  function  getProduct($id)
    {
        $product = Product::find($id);
        $sameproductcatagory = $product->catagory1;
        $sameproducts = Product::where('catagory1',$sameproductcatagory)->where('id',"<>",$product->id)->take(10)->get();
        $productfilters = Productfilter::where('product_id',$id)->get();
        return view('detailProduct')->with(['product' =>$product ,'productfilters' => $productfilters ,
            'sameproducts' => $sameproducts]);

    }


    // perform global serarch in search box in header of site
    public function  searchProduct(Request $request)
    {
       $search = $request->valueSearch;
      $products = Product::where('name',"like","%$search%")->orWhere('catagory1',"like" ,"%$search%")->orWhere('catagory2',"like", "%$search%")->orWhere('catagory3',"like" ,"%$search%")->get();
       // $products = Product::where('name',"like","%$search%")->get();
      // return view('products')->with(['products' =>$products , 'brands' => $brands]);
        return view('search',['products' => $products]);

    }

    // -----------------------------------------------------------------------------------
    public function  getRangeAndBrandSearchProduct($range,$brand)
    {
        /* $range = (int)$range;
        if($brand == 'همه برندها')
        {
            $products = Product::whereBetween('price',[0,$range])->get();
        }
        else
        {
            $products = Product::where('brand',$brand)->whereBetween('price',[0,$range])->get();
        }
        $brands = Brand::all();
        return view('products')->with(['products' =>$products,'selectedBrand'=>$brand ,'OldValueOfrange'=> $range , 'brands' => $brands] );
     */
        $data = session('cat');
        echo $data[0];
    }

    //------------------------------------------------------------------------------------
    public function getBrandProduct($brand)
    {
        if($brand == 'همه برندها')
         $products = Product::all();
        else
            $products = Product::where('brand',$brand)->get();
       // echo $brand;
        return view('products')->with(['products' =>$products,'selectedBrand'=>$brand]);

    }
    //-------------------------------------------------------------------------------------------
    public function createProduct()
    {
       $catagories = Category::all();
        $filters = Filter::all();
        $filterValues = Filtervalue::all();
        return view('createProduct')->with(['catagory' =>$catagories , 'filters' => $filters , 'filterValue' => $filterValues]);
       // return Voyager::view('createProduct');
    }

    //-----------------------------------------------------------------------------------------------------------
    public function saveProduct(Request $request)
    {

        $validated = $request->validate([
            'name'            =>       'required |string ',
            'price'           =>       'numeric',
            'takhfif'         =>       'numeric',
            'company'         =>       'string',
            'aboutProduct'    =>       'string',
            'tarkibat'        =>       'string',
            'nahvehEstefadeh' =>       'string',
            'age'             =>      'numeric',
            'available'       =>      'numeric' ,
        ]);
    $newproduct = new Product();
    $newproduct->name = $request->name;

    // -------------- resize image an upload with upload classs
    $img = $request->image;
        $foo = new upload($img);
        if ($foo->uploaded) {


            // resized to 200px wide
            $foo->file_new_name_body = 'image_resized'.time();
            $path =  'products/'.$foo->file_new_name_body.'.png';
            $foo->image_resize = true;
            $foo->image_convert = 'png';
            $foo->image_y = 200;
            $foo->image_ratio_x = true;
            $foo->process('storage/products');
            if ($foo->processed) {

                $foo->clean();
            } else {
                return redirect()->back()->withErrors(['file_error' => $foo->error]);

            }
        }
//---------------------

    $newproduct->image = $path;
    $newproduct->price = $request->price;
    $newproduct->takhfif = $request->takhfif;
    $cat1 = $request->catagory1;
    $cat1 = Category::find($cat1);
    $newproduct->catagory1 = $cat1->name;

    $cat2 = $request->catagory2;
    $cat2 = Category::find($cat2);
    $newproduct->catagory2 = $cat2->name ? $cat2->name : '';


    $cat3 = $request->catagory3;
    $cat3 = Category::find($cat3);
    $newproduct->catagory3 = $cat3->name ?? '';

    $newproduct->company = $request->company;

    $newproduct->aboutProduct = $request->aboutProduct;

    $newproduct->nahvehEstefadeh = $request->nahvehEstefadeh;
        $newproduct->featuers = $request->featuers;
    $newproduct->available = $request->available;
    $res = $newproduct->save();
    $filterindatabase = Filter::all();
    foreach ($request->filter as $r)
    {
       $objfilter = new Productfilter();
        $obj = $filterindatabase->firstWhere('id',$r);
       $objfilter->filterName = $obj->name;
       $objfilter->slug = $obj->slug;
       $objfilter->filterValue = $request->{$r};
       $newproduct->productfilters()->save($objfilter);
    }
    return redirect('admin/products');
    }

    public function uploadEditProductImage(Request $request)
    {
        $img = $request->image;
        $foo = new upload($img);
        if ($foo->uploaded) {


            // resized to 200px wide
            $foo->file_new_name_body = 'image_resized'.time();
            $path =  'products/'.$foo->file_new_name_body.'.png';
            $foo->image_resize = true;
            $foo->image_convert = 'png';
            $foo->image_y = 200;
            $foo->image_ratio_x = true;
            $foo->process('storage/products');
            if ($foo->processed) {

                $foo->clean();
            } else {
                $path = "";
            }
            return response()->json(compact( 'path'));
        }
    }

    // ایجاد ویو برای مرحله بعد اضافه کردن محصول و صفحه درباره محصول
    public function productsContinue(Request $request)
    {
       return view('createProductContinue');
    }
    public function saveaboutproduct(Request $request)
    {
        $id = session('productidforaboutproduct');
        session()->forget('productidforaboutproduct');
        Product::where('id',$id)->update(["aboutProduct" => $request->aboutProduct]);
        return   redirect()->route("voyager.products.index")->with([
            'message'    =>'محصول ' .  __('voyager::generic.successfully_added_new') ,
            'alert-type' => 'success',
        ]);
    }
    public function updateaboutproducts(Request $request)
    {

    }
    public function takmilkharid($id)
    {
        $productfortakmil =  Sale::find($id);
        $productfortakmil->status = 'تکمیل سفارش';
        $productfortakmil->save();
        return   redirect()->route("voyager.sales.index")->with([
            'message'    =>'وضعیت محصول به تکمیل سفارش تغییر پیدا کرد.'  ,
            'alert-type' => 'success',
        ]);
    }
}
