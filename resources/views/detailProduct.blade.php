<?php


?>
@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('contents/library/slick/slick.css')}}"/>
    <!-- Add the new slick-theme.css if you want the default styling  -->
    <link rel="stylesheet" type="text/css" href="{{asset('contents/library/slick/slick-theme.css')}}"/>

@endsection
@section('title','فروشگاه اینترنتی محصولات آرایشی')

@section('content')
@include('header')
    <div class="container bg-white">
        <div class="row mt-2">
            <div class="col-12 ">
                <div class="row">
                    <div class="col-10 mt-2 text-center mt-1">
                        <h6>{{$product->name}}</h6>
                        <hr>
                    </div>
                    <div class="col-2 mt-2">
                        <a href="">
                            @isset($brand)
                           <img src="{{asset('storage/'.$brand->imageBrand)}}" class="img-fluid" alt="برند محصول" >
                                @endisset
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-5 ">
               <div class="mx-auto">
                   <img class="img-fluid d-block mx-auto" src="{{asset('storage/products/'.$product->productimages()->first()['image'])}} "  align="کرم درست و صورت"id="orginalimagezoomed" data-zoom-image="{{asset('storage/products/large/'.$product->productimages()->first()['image'])}}"/>
               </div>
                <div class="d-flex justify-content-center flex-wrap my-2" id="thumbnailimageblock">

                    @foreach($product->productimages()->get() as $proimg)
                        <div >
                           <a href="#" data-image="{{asset('storage/products/'.$proimg->image)}}" data-zoom-image="{{asset('storage/products/large/'.$proimg->image)}}" >
                               <img src="{{asset('storage/products/'.$proimg->image)}}" width="60px" height="60px"  style="border:2px solid white;" id="orginalimagezoomed"/>
                           </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-3 ">
                <div>
                    کشور :{{$product->country ?$product->country : ' ----' }}
                </div>
                <div>شرکت :
                    {{$product->company}}

                </div>
            </div>

            <div class="col-md-4  p-2">
             <div class="border border-secondary">
                 <h4>ویژگی های محصول</h4>
                 <ul class="" style="list-style-type: disc;margin-right: 20px">

                     @php
                         if($product->featuers){
                              $features = explode("\n",$product->featuers);

                             foreach ($features as $f)
                                 echo "<li>$f</li>";
                          }
                     @endphp
                 </ul>
             </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h6 class="text-center">قیمت :<small class="tymon-delete"><del class="text-danger">{{number_format( $product->price )}}</del></small>  {{number_format(  $product->price -(($product->price * $product->takhfif)/100)  )}} تومان </h6>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-md-12 text-center">
                <a @if($product->available > 0 ) href="/add/cart/{{$product->id}}" @else href ="" @endif class="btn btn-danger mb-2" >
                    <span class="fa fa-shopping-basket"></span>
                    افزودن به سبد خرید</a>
            </div>
        </div>
    </div>


<ul class="nav nav-tabs mt-4">
    <li class="nav-item ">
        <a class="nav-link bg-light p-3 active" href="#takmili" data-toggle="tab">اطلاعات تکمیلی</a>
    </li>
    <li class="nav-item">
        <a class="nav-link p-3" data-toggle="tab" href="#aboutproduct">درباره محصول</a>
    </li>

    <li class="nav-item">
        <a class="nav-link p-3" data-toggle="tab" href="#nazarat">نظرات کاربران</a>
    </li>
</ul>

<!-- tab pan -->
<div class="tab-content bg-white mx-5">
    <div class="tab-pane active " id="takmili">
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                @foreach($productfilters as $profilter)
                    <tr>
                        <td>{{$profilter->filterName}}</td>
                        <td>{{$profilter->filterValue}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane  " id="aboutproduct">
        <div class="card">

            <div class="card-body">
                <p>
                    {!!  $product->aboutProduct !!}
                </p>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="nazarat">
        <div class="container">

            <form method="post" action="/addComment/{{$product->id}}" onsubmit="return showMessage()">
                @csrf
                <h4 class="text-center pt-2">نظرات کاربران</h4>
                <h6 class="text-center">شما هم می توانید نظر خود را درباره این محصول بنویسید</h6>

                @if(\Illuminate\Support\Facades\Auth::check())
                    <div class="form-group mt-5"><textarea class="form-control mr-4" name="message" placeholder="نظر خود را درباره این محصول بنویسید" required></textarea></div>
                    <div class="form-group "><input  class="btn btn-danger" value="ارسال نظر" type="submit" ></div>
            </form>
            @else
                <div class="jumbotron">
                    <p>برای ارسال نظر درباره این محصول بایستی ابتدا وارد سایت شوید.</p>
                    <a href="{{route('login')}}" class="btn btn-primary">ورود به سایت</a>
                </div>
            @endif


            <hr>
            @if($product->comments->count()==0)
                <p>هنوز نظری درباره این محصول ثبت نشده است.</p>
            @endif
            @foreach($product->comments as $comment)
                <div class="karbar_nazar my-2">
                    <h4>{{$comment->name}}</h4>
                    <h6>{{$comment->comment}}</h6>
                </div>
                <hr>
            @endforeach
        </div>
    </div>

<div class="card mt-3">
    <div class="card-header aboutProductCard">محصولات مشابه</div>
    <div class="card-body ">
        <!--
        <div class="row bazaar product-slider">
            <div class="col-lg-3 ">
                <div class="card rounded-0 productSimiler " >
                    <a href="#" class="text-decoration-none ">

                        <div class="text-right card-content "><img class="img-fluid  d-block mx-auto"  src="/images/mashillebas.PNG">
                            <h5 class="text-center p-1"> رژگونه کاپریس </h5>
                            <div class="btn-wrapper text-center">
                             <span class="text-center"> 53,500 تومان</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        -->



        <div class="d-flex bg-white  justify-content-around sameproducts">
            @foreach($sameproducts as $pro)
                <div class="m-2 ">
                    <div class="card rounded-0   " >
                        <a  href="/detailProduct/{{$pro->id}}"  class="text-decoration-none ">

                            <div class="text-right card-content ">
                                <img class="img-fluid  d-block mx-auto"   src="{{asset('storage/products/'.($pro->productimages()->first())['image']  )}}">
                                <h5 class="text-center p-1">{{$pro->name}} </h5>
                                <div class="btn-wrapper text-center">
                                        <span class="text-center text-danger">
                                             قیمت : {{number_format($pro->price)}} تومان</span>
                                    @if($pro->available >0)

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
                </div>
            @endforeach
        </div>
    </div>

</div>
<!--   tab of detail product     -->

    <script type="text/javascript" src="{{asset('contents/library/slick/slick.min.js')}}"></script>
@include('ersal')
@include('footer')

        <script type="text/javascript">
            function  showMessage()
            {
                window.alert('با تشگر. نظر شما ثبت شد.');
            }

            // zoom image in detail product
            function mouseenterimage() {
               var demisition = $('#imageProduct').getBoundingClientRect();
               console.log('top is :'+demisition.top + 'left corner is :' + demisition.top);
            }
            function mouseLeaveImage() {
                $('#imageProduct').css('width',"auto");
            }
$(document).ready(function () {
    $('#thumbnailimageblock a').click(function (event) {
        event.preventDefault();
        var h = $(this).attr("href");
        $('#orginalimagezoomed').attr("src",h);

    });
  //  $("#orginalimagezoomed").elevateZoom();



//initiate the plugin and pass the id of the div containing gallery images
    $("#orginalimagezoomed").elevateZoom({gallery:'thumbnailimageblock', cursor: "crosshair", galleryActiveClass: 'active', imageCrossfade: true,zoomWindowPosition:10 });

//pass the images to Fancybox
    $("#orginalimagezoomed").bind("click", function(e) {
        var ez =   $('#orginalimagezoomed').data('elevateZoom');
        $.fancybox(ez.getGalleryList());
        return false;
    });
    $('.sameproducts').slick({
        slidesToShow: <?php  if(count($sameproducts) >3 ) echo "3" ; else echo "1"?>,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots : true ,
        arrows: true,
        adaptiveHeight : true ,
        rtl : true,
        mobileFirst : true ,

    });



});
        </script>
        <script src="{{asset('style/jquery.elevateZoom-3.0.8.min.js')}}"></script>

@endsection

