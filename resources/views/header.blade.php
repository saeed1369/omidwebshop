<?php
use TCG\Voyager\Models\Category;
$catagories = Category::all();
$root = $catagories->filter(function ($value,$key){
    return $value->parent_id == null;
});
$root = $root->sortBy('order');


?>



<div class="container-fluid">
    <div class="row">
        <div  class="col-2">
            <div class="">
            <a href="/" title="لوگو" >
                <img src="{{asset('images/shortcutIcon.png')}}" alt="لوگو فروشگاه اینترتی"  class="img-fluid my-auto"/>
                </a>
            </div>
        </div>
        <div class="col-6">
            <div class="searchBox  mt-4  mr-auto ">
                <form class="form-inline" action="{{url('search')}}" method="post">
                    @csrf
                    <input class="form-control p-2 ml-2 rounded " type="search" placeholder="جستجو" size="40" onFocus="" name="valueSearch">
                    <input type="submit" class="btn btn-primary" name="btnSearch" value="جستجو">
                </form>
             </div>
        </div>
        <div class="col-4">
            <div class="d-flex justify-content-around align-items-center p-1 m-1">
                <div>
                    @if(\Illuminate\Support\Facades\Auth::check())

                        {{-- --------------------  drop down menu  --}}

                        <div class="dropdown  profile" role="presentation">

                                <a class="dropdown-toggle no-arrow" data-toggle="dropdown" aria-expanded="true" href="#">
                                    <span class="d-none d-lg-inline  text-secondary small">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                                    <img class="border rounded-circle img-profile" width="60px0" height="60px" src="{{asset('storage/'.\Illuminate\Support\Facades\Auth::user()->avatar)}}">
                                </a>
                                <div class="dropdown-menu shadow   dropdown-menu-animated  border-secondary " role="menu" style="z-index: 111111111" id="profileBlock">
                                    <a class="dropdown-item text-right" role="presentation" href="{{url('profile')}}">
                                        <i class="fas fa-user fa-sm fa-fw  text-gray-400"></i>&nbsp;پروفایل شما
                                    </a>
                                    <a class="dropdown-item text-right" role="presentation" href="{{url('/')}}">
                                        <i class="fas fa-home  fa-sm fa-fw  text-gray-400"></i>&nbsp;صفحه اصلی
                                    </a>
                                    <a class="dropdown-item text-right" role="presentation" href="{{url('sabadKharid')}}"><i class="fas fa-shopping-basket fa-sm fa-fw text-gray-400"></i>&nbsp;سبد خرید</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-right text-danger" role="presentation" href="{{route('logout')}}"><i class="fas fa-sign-out-alt fa-sm fa-fw  text-gray-400"></i>&nbsp;خروج</a>
                                </div>
                        </div>
                        {{-- ----------------------------------------------------             --}}
                    @else
                     <a  class="btn btn-outline-primary text-dark ml-auto " value="ورود" name="btnLogin" href="{{route('login')}}">ورود</a>
                   @endif
                </div>
                <div class="divider" style="padding: 13px;"></div>
                <a href="/sabadKharid">
                 <div class="d-lg-flex d-xl-flex justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center">
                            <span class="d-xl-flex justify-content-xl-center align-items-xl-center"><span
                                    class="badge badge-pill badge-success "
                                    style="z-index: 5;">{{(session('numCart')) ?? '0'}}</span><i
                                    class="icon ion-ios-cart-outline"
                                    style="font-size: 60px;color: rgb(0,0,0);width: 60px;"></i></span><span
                        class="text-danger">سبد خرید</span>
                  </div>
                </a>
            </div>

        </div>
    </div>
</div>

 <nav class="navbar navbar-expand-md navbar-light sticky-top">

	  <!-- Toggler/collapsibe Button -->
	<button  type="button" class="navbar-toggler"  data-toggle="collapse" data-target="#menu1">
    	<span class="navbar-toggler-icon"></span>
     </button>

     <div class="collapse navbar-collapse" id="menu1">

     	<!-- navbar -->
        <ul class="navbar-nav nav-pills">
            @php

            @endphp
            @foreach($root as $item)

        	<li class="nav-item dropdown position-static">
            	<a class="nav-link"  @if($item->name == 'صفحه اصلی') href="/" @else href="/product/catagory/{{$item->name}}" @endif id="menu1dropdown">{{$item->name}}</a>
                @php
                    $id = $item->id;

                    $cat1 = $catagories->filter(function ($value,$key) use($id){
                                   return $value->parent_id == $id;
                    });
                    $countItemCate1 = $cat1->count() ;
                    if($countItemCate1 == 0)
                        $col = 12;
                    else
                          $col = (12 / $countItemCate1);
                @endphp
                @if($countItemCate1 > 0)


                        <div class="dropdown-menu w-100 dropdown-menu-right mt-n2" >
                            <div class="container-fluid">
                                <div class="row ">
                            @foreach($cat1 as $itemcat1)
                        	<div class="col-{{$col}} p-1">
                            	<a href="/product/catagory/{{$item->name}}/catagory/{{$itemcat1->name}}" style="text-decoration: none"><h6 class="dropdown-header text-center">{{$itemcat1->name}}</h6></a>
                                <div class="dropdown-divider"></div>
                                @php
                                    $id = $itemcat1->id;
                                  $cat2 = $catagories->filter(function ($value,$key) use($id){
                                                   return $value->parent_id == $id;
                                                              });
                                  @endphp
                                @foreach($cat2 as $cat2)
                            	  <a class="dropdown-item  text-center"  href="/product/catagory/{{$item->name}}/catagory/{{$itemcat1->name}}/catagory/{{$cat2->name}}">{{$cat2->name}}</a>
                                    @endforeach

                             </div>
                            @endforeach
                         </div>
                       </div>
                    </div>
                @endif
            </li>
            @endforeach
            <li class="nav-item">
                <a class="nav-link" href="/contact-us">تماس با ما</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/about-us">درباره ما</a>
            </li>
        </ul>
     </div>
</nav>














  <script type="text/javascript">


// code of button for go to top of page site
var speed=250;
var offset = 150;
var duration = 500;
$(window).scroll(function(){
	if ($(this).scrollTop()<offset)
	{
		$('.btndowntoup').fadeOut(duration);
	}
	else
	{
		$('.btndowntoup').fadeIn(duration);
	}
	});
	$('btndowntoup').on('click',function(){

		$('html,body').animate({scrollTop:0},speed);
		return false;
		});


new WOW().init();
 </script>
