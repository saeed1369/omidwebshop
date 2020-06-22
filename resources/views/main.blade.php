<?php

$mostpopulars = App\Mostpopular::orderBy('Order','Asc')->take(8)->get();
$newests = App\Product::orderBy('Order','desc')->take(8)->get();
$i = 0;

?>

<main class="rtl mt-2">
    @if(count($mostpopulars) > 0)
        <div class="container-fluid border border-primary mostpopulars" id="most-popular">
            <div class="row  " id="new-products">
                <div  class="mospopularproducts col-md-5 productSimiler" >
                    <a href="/detailProduct/{{$mostpopulars[0]->product_id}}"><img class="img-fluid w-100 h-100" src="{{asset('storage/'.$mostpopulars[0]->image)}}">
                        <button class="btn btn-primary btn-sm active" type="button">مشاهده</button>
                    </a>
                </div>
                @endif
                <div class="col-md-2">

                </div>
                @if(count($mostpopulars) > 1)
                    <div  class="mospopularproducts col-md-5 productSimiler " >
                        <a href="/detailProduct/{{$mostpopulars[1]->product_id}}"><img class="img-fluid w-100 h-100" src="{{asset('storage/'.$mostpopulars[1]->image)}}">
                            <button class="btn btn-primary btn-sm active" type="button">مشاهده</button>
                        </a>
                    </div>
                @endif
            </div>
        </div>

    <!--
     <div class="container-fluid" id="most-popular">
        <div class="row  d-flex  bg-white justify-content-center align-items-center flex-nowrap" id="new-products">
            @foreach($mostpopulars as $mp)
        <div  class="mospopularproducts w-50 ">
            <a href="/detailProduct/{{$mp->product_id}}"><img class="img-fluid w-100" src="{{asset('storage/'.$mp->image)}}">
                    <button class="btn btn-primary btn-sm active" type="button">مشاهده</button>
                </a>
            </div>
                @php $i++;if($i ==2) break; @endphp
    @endforeach
        </div>
    </div>

-->


        <!-- end of most pupular products
        <div class="row" id="popular-products">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <a href="#">
                        <img class="img-fluid" src="contents/img/۴.jpg">
                        <button class="btn btn-primary btn-sm active max-sell" type="button">مشاهده</button>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card"><a href="#"><img class="img-fluid" src="contents/img/miselar.jpg">
                        <button class="btn btn-primary btn-sm active max-sell" type="button">مشاهده</button>
                    </a></div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card"><a href="#"><img class="img-fluid" src="contents/img/rimelllaa.jpg">
                        <button class="btn btn-primary btn-sm active max-sell" type="button">مشاهده</button>
                    </a></div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card"><a href="#"><img class="img-fluid" src="contents/img/narm-konande.jpg">
                        <button class="btn btn-primary btn-sm active max-sell" type="button">مشاهده</button>
                    </a></div>
            </div>
        </div>  -->

    <!--
            <h3 class="text-truncate text-right shop-heading" style="padding: 10px;"><i
                    class="typcn typcn-shopping-cart text-danger"></i>&nbsp;فروشگاه&nbsp;<span
                    class="text-danger">خانومی</span></h3>
            <div class="row bazaar product-slider">
                <div class="col-lg-3" style="padding: 0 5px;">
                    <div class="card border rounded-0 card" style="padding: 5px;">
                        <a href="#">
                            <div class="text-truncate text-center d-xl-flex align-content-around border-bottom card-head"
                                 style="font-size: 14px;padding: 2px;"><span
                                    class="text-muted d-lg-flex d-xl-flex align-items-lg-center pre-price"
                                    style="font-weight: normal;">124000</span><span
                                    class="text-danger d-lg-flex align-items-lg-center price"
                                    style="font-size: 17px;">118100 تومان</span>
                                <span
                                    class="text-danger border rounded-circle border-danger d-lg-flex align-items-lg-center percentage"
                                    style="padding: 5px;">4%</span>
                            </div>
                            <div class="text-right card-content"><img class="img-fluid" src="contents/img/57_1_1.jpg">
                                <h5 class="text-right text-dark"><br> رژگونه کاپریس مدل Eclat Gourmand شماره 57<br><br>
                                </h5><span>Ciate Satin Kiss Lipstick No.LS001 Velvteen Satin</span>
                                <div class="btn-wrapper">
                                    <button class="btn btn-danger btn-sm active d-sm-flex"
                                            type="button"><i class="material-icons cart-icon">add_shopping_cart</i><span
                                            class="cart-add">&nbsp;اضافه کردن به کارت</span></button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3" style="padding: 0 5px;">
                    <div class="card border rounded-0 card" style="padding: 5px;">
                        <a href="#">
                            <div class="text-truncate text-center d-xl-flex align-content-around border-bottom card-head"
                                 style="font-size: 14px;padding: 2px;"><span
                                    class="text-muted d-lg-flex d-xl-flex align-items-lg-center pre-price"
                                    style="font-weight: normal;">124000</span><span
                                    class="text-danger d-lg-flex align-items-lg-center price"
                                    style="font-size: 17px;">118100 تومان</span>
                                <span
                                    class="text-danger border rounded-circle border-danger d-lg-flex align-items-lg-center percentage"
                                    style="padding: 5px;">4%</span>
                            </div>
                            <div class="text-right card-content"><img class="img-fluid" src="contents/img/57_1_1.jpg">
                                <h5 class="text-right text-dark"><br> رژگونه کاپریس مدل Eclat Gourmand شماره 57<br><br>
                                </h5><span>Ciate Satin Kiss Lipstick No.LS001 Velvteen Satin</span>
                                <div class="btn-wrapper">
                                    <button class="btn btn-danger btn-sm active d-sm-flex"
                                            type="button"><i class="material-icons cart-icon">add_shopping_cart</i><span
                                            class="cart-add">&nbsp;اضافه کردن به کارت</span></button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3" style="padding: 0 5px;">
                    <div class="card border rounded-0 card" style="padding: 5px;">
                        <a href="#">
                            <div class="text-truncate text-center d-xl-flex align-content-around border-bottom card-head"
                                 style="font-size: 14px;padding: 2px;"><span
                                    class="text-muted d-lg-flex d-xl-flex align-items-lg-center pre-price"
                                    style="font-weight: normal;">124000</span><span
                                    class="text-danger d-lg-flex align-items-lg-center price"
                                    style="font-size: 17px;">118100 تومان</span>
                                <span
                                    class="text-danger border rounded-circle border-danger d-lg-flex align-items-lg-center percentage"
                                    style="padding: 5px;">4%</span>
                            </div>
                            <div class="text-right card-content"><img class="img-fluid" src="contents/img/57_1_1.jpg">
                                <h5 class="text-right text-dark"><br> رژگونه کاپریس مدل Eclat Gourmand شماره 57<br><br>
                                </h5><span>Ciate Satin Kiss Lipstick No.LS001 Velvteen Satin</span>
                                <div class="btn-wrapper">
                                    <button class="btn btn-danger btn-sm active d-sm-flex"
                                            type="button"><i class="material-icons cart-icon">add_shopping_cart</i><span
                                            class="cart-add">&nbsp;اضافه کردن به کارت</span></button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3" style="padding: 0 5px;">
                    <div class="card border rounded-0 card" style="padding: 5px;">
                        <a href="#">
                            <div class="text-truncate text-center d-xl-flex align-content-around border-bottom card-head"
                                 style="font-size: 14px;padding: 2px;"><span
                                    class="text-muted d-lg-flex d-xl-flex align-items-lg-center pre-price"
                                    style="font-weight: normal;">124000</span><span
                                    class="text-danger d-lg-flex align-items-lg-center price"
                                    style="font-size: 17px;">118100 تومان</span>
                                <span
                                    class="text-danger border rounded-circle border-danger d-lg-flex align-items-lg-center percentage"
                                    style="padding: 5px;">4%</span>
                            </div>
                            <div class="text-right card-content"><img class="img-fluid" src="contents/img/57_1_1.jpg">
                                <h5 class="text-right text-dark"><br> رژگونه کاپریس مدل Eclat Gourmand شماره 57<br><br>
                                </h5><span>Ciate Satin Kiss Lipstick No.LS001 Velvteen Satin</span>
                                <div class="btn-wrapper">
                                    <button class="btn btn-danger btn-sm active d-sm-flex"
                                            type="button"><i class="material-icons cart-icon">add_shopping_cart</i><span
                                            class="cart-add">&nbsp;اضافه کردن به کارت</span></button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3" style="padding: 0 5px;">
                    <div class="card border rounded-0 card" style="padding: 5px;">
                        <a href="#">
                            <div class="text-truncate text-center d-xl-flex align-content-around border-bottom card-head"
                                 style="font-size: 14px;padding: 2px;"><span
                                    class="text-muted d-lg-flex d-xl-flex align-items-lg-center pre-price"
                                    style="font-weight: normal;">124000</span><span
                                    class="text-danger d-lg-flex align-items-lg-center price"
                                    style="font-size: 17px;">118100 تومان</span>
                                <span
                                    class="text-danger border rounded-circle border-danger d-lg-flex align-items-lg-center percentage"
                                    style="padding: 5px;">4%</span>
                            </div>
                            <div class="text-right card-content"><img class="img-fluid" src="contents/img/57_1_1.jpg">
                                <h5 class="text-right text-dark"><br> رژگونه کاپریس مدل Eclat Gourmand شماره 57<br><br>
                                </h5><span>Ciate Satin Kiss Lipstick No.LS001 Velvteen Satin</span>
                                <div class="btn-wrapper">
                                    <button class="btn btn-danger btn-sm active d-sm-flex"
                                            type="button"><i class="material-icons cart-icon">add_shopping_cart</i><span
                                            class="cart-add">&nbsp;اضافه کردن به کارت</span></button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3" style="padding: 0 5px;">
                    <div class="card border rounded-0 card" style="padding: 5px;">
                        <a href="#">
                            <div class="text-truncate text-center d-xl-flex align-content-around border-bottom card-head"
                                 style="font-size: 14px;padding: 2px;"><span
                                    class="text-muted d-lg-flex d-xl-flex align-items-lg-center pre-price"
                                    style="font-weight: normal;">124000</span><span
                                    class="text-danger d-lg-flex align-items-lg-center price"
                                    style="font-size: 17px;">118100 تومان</span>
                                <span
                                    class="text-danger border rounded-circle border-danger d-lg-flex align-items-lg-center percentage"
                                    style="padding: 5px;">4%</span>
                            </div>
                            <div class="text-right card-content"><img class="img-fluid" src="contents/img/57_1_1.jpg">
                                <h5 class="text-right text-dark"><br> رژگونه کاپریس مدل Eclat Gourmand شماره 57<br><br>
                                </h5><span>Ciate Satin Kiss Lipstick No.LS001 Velvteen Satin</span>
                                <div class="btn-wrapper">
                                    <button class="btn btn-danger btn-sm active d-sm-flex"
                                            type="button"><i class="material-icons cart-icon">add_shopping_cart</i><span
                                            class="cart-add">&nbsp;اضافه کردن به کارت</span></button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3" style="padding: 0 5px;">
                    <div class="card border rounded-0 card" style="padding: 5px;">
                        <a href="#">
                            <div class="text-truncate text-center d-xl-flex align-content-around border-bottom card-head"
                                 style="font-size: 14px;padding: 2px;"><span
                                    class="text-muted d-lg-flex d-xl-flex align-items-lg-center pre-price"
                                    style="font-weight: normal;">124000</span><span
                                    class="text-danger d-lg-flex align-items-lg-center price"
                                    style="font-size: 17px;">118100 تومان</span>
                                <span
                                    class="text-danger border rounded-circle border-danger d-lg-flex align-items-lg-center percentage"
                                    style="padding: 5px;">4%</span>
                            </div>
                            <div class="text-right card-content"><img class="img-fluid" src="contents/img/57_1_1.jpg">
                                <h5 class="text-right text-dark"><br> رژگونه کاپریس مدل Eclat Gourmand شماره 57<br><br>
                                </h5><span>Ciate Satin Kiss Lipstick No.LS001 Velvteen Satin</span>
                                <div class="btn-wrapper">
                                    <button class="btn btn-danger btn-sm active d-sm-flex"
                                            type="button"><i class="material-icons cart-icon">add_shopping_cart</i><span
                                            class="cart-add">&nbsp;اضافه کردن به کارت</span></button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            <div style="text-align:center;">
                <h2 class="divider-style"><span>جدیدترین  محصولات فروشگاه</span></h2>
                <br>
            </div>
            <div class="row bazaar product-slider">
                @for($i=0 ; $i< 8 ; $i++)
        <div class="col-lg-3" style="padding: 0 5px;">
         <div class="card border rounded-0 card" style="padding: 5px;">
             <a href="#">
                 <div class="text-truncate text-center d-xl-flex align-content-around border-bottom card-head"
                      style="font-size: 14px;padding: 2px;"><span
                         class="text-muted d-lg-flex d-xl-flex align-items-lg-center pre-price"
                         style="font-weight: normal;">124000</span><span
                         class="text-primary d-lg-flex align-items-lg-center price"
                         style="font-size: 17px;">118100 تومان</span>
                     <span
                         class="text-primary border rounded-circle border-primary d-lg-flex align-items-lg-center percentage"
                         style="padding: 5px;">4%</span>
                 </div>
                 <div class="text-right card-content"><img class="img-fluid" src="contents/img/mashillebas.PNG">
                     <h5 class="text-right text-dark"><br>ماشین لباسشویی اسنوا<br><br>

                     <div class="btn-wrapper">
                         <button class="btn btn-primary btn-sm active d-sm-flex"
                                 type="button"><i class="material-icons cart-icon">add_shopping_cart</i><span
                                 class="cart-add">&nbsp;اضافه کردن به کارت</span></button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endfor

        </div>
-->
        <section id="products">
            <div>
                <h4 class="divider-style" style="text-align:center"><span>جدیدترین  محصولات فروشگاه</span></h4>
                <br>
            </div>
            <div class="container-fluid">
                <div class="row">
                    @for($i=0 ; $i < 4 ;$i++)
                        <div class="col-md-3">
                            <div class="card rounded-0 border border-secondary   productSimiler " >
                                <a  href="/detailProduct/{{$newests[$i]->id}}"  class="text-decoration-none ">

                                    <div class="text-right card-content "><img class="img-fluid  d-block mx-auto"   src="{{asset('storage/products/'.($newests[$i]->productimages()->first())['image']  )}}">
                                        <h5 class="text-center p-1">{{$newests[$i]->name}} </h5>
                                        <div class="btn-wrapper text-center">
                                        <span class="text-center text-danger">
                                             قیمت : {{number_format($newests[$i]->price)}} تومان</span>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="row">
                    @for($i=4 ; $i < 8 ;$i++)
                        <div class=" col-md-3 ">
                            @if($newests[$i]->id)
                                <div class="card rounded-0 border border-secondary productSimiler mt-2 " >
                                    <a  href="/detailProduct/{{$newests[$i]->id}}"  class="text-decoration-none ">

                                        <div class="text-right card-content "><img class="img-fluid  d-block mx-auto"   src="{{asset('storage/products/'.($newests[$i]->productimages()->first())['image']  )}}">
                                            <h5 class="text-center p-1">{{$newests[$i]->name}} </h5>
                                            <div class="btn-wrapper text-center">
                                        <span class="text-center text-danger">
                                             قیمت : {{number_format($newests[$i]->price)}} تومان</span>
                                                @if($newests[$i]->available >0)

                                                    <div class="text-success">
                                                        <img src="{{asset('storage/exists.png')}}">
                                                    </div>
                                                @else
                                                    <div> <span class="text-danger">ناموجود</span></div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
        </section>
</main>
