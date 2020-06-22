
@extends('layouts.app')
@section('title', $catagory[0]['cat1'])
@section('content')
    @include('header')

    <div class="container-fluid">
        <div class="row">
            <div class="empty my-5">

            </div>
            <div class="col-sm-2 col-4  overflow-hidden" >
                <div class="range my-4 bg-white">

                        <label for="customrangeprice"> قیمت</label>
                        <div class="position-relative">
                            <span class="position-absolute overflow-hidden rangelable" style="right:80%;top: 40%;font-size: small">1 تومان</span>
                            <span class="position-absolute rangelable" style="right:0;top: 40%;font-size: small">{{number_format(20000000)}}تومان</span>

                             <input class="custom-range" type="range" name="priceRange" id="customrangeprice" min="1" max="20000000"
                                    value="<?php foreach ($requestold->query() as $key => $value)
                                        {
                                            if($key == 'priceRange')
                                            {
                                             echo $value;
                                            }
                                        }
                                        ?>" >
                        </div>
                </div>

                <form method="post" >
                    @isset($avalablefilter)
                        @foreach($avalablefilter as $af)
                            <div class=" my-3">
                                <div style="cursor: pointer;" id="filtername{{$loop->iteration}}" onclick="togglefilter({{$loop->iteration}})">
                                    <div class="sidefilter p-2" for="">
                                        {{$af->name}} <span class="fa fa-caret-down float-left" style="margin-left:1em;color:black"></span>
                                    </div>
                                </div>
                               <div class="chckboxfilters bg-white " id="chckboxfilters{{$loop->iteration}}" style="display: block">
                                   <input type="hidden" name="{{$af->name.'[]'}}" value="{{$af->name}}">
                                   @foreach($avaliblefiltervalue as $afv)
                                       @if($afv->filter_id == $af->id)
                                           <div class="form-check">
                                               <label class="form-check-label">
                                                   <input type="checkbox"  class="form-check-input" value="{{$afv->value}}" name="{{$af->slug.'[]'}}"
                                                   <?php
                                                       foreach ($requestold->query() as $key => $value)
                                                       {
                                                           if($key == $af->slug)
                                                           {
                                                               foreach ($value as $v)
                                                                   if($v == $afv->value)
                                                                       echo 'checked';
                                                           }
                                                       }
                                                       ?>>
                                                   {{$afv->value}}
                                               </label>
                                           </div>
                                       @endif
                                   @endforeach
                               </div>
                            </div>
                        @endforeach
                    @endisset
                </form>

                <!--
               <div class="dastebandi my-5">
                   <h4>دسته بندی ها</h4>
                   <div class="list-group">
                       <a href="#" class="list-group-item list-group-item-action text-danger">ارایش صورت</a>
                       <a href="#" class="list-group-item list-group-item-action text-danger">کرم صورت</a>
                       <a href="#" class="list-group-item list-group-item-action text-danger">ضد افتاب صورت</a>
                   </div>
               </div>
                -->
            </div>
            <div class="col-sm-10 col-8">
                @if($products->count()>0)

                    <ul class="breadcrumb justify-content-lg-start">
                        <li class="breadcrumb-item  px-1"><a href="/"><span class="fa fa-home ml-1"></span>خانه</a></li>
                        @isset($catagory)
                        <li class="breadcrumb-item px-1"><a href="/product/catagory/{{$catagory[0]['cat1']}}">{{$catagory[0]['cat1']}}</a></li>
                        @if($catagory[0]['cat1'] !=NULL)
                            <li class="breadcrumb-item   px-1"><a href="/product/catagory/{{$catagory[0]['cat1']}}/catagory/{{$catagory[0]['cat2']}}">{{$catagory[0]['cat2']}}</a></li>
                        @endif
                        @if($catagory[0]['cat3'] !=NULL)
                        <li class="breadcrumb-item   px-1"><a href="/product/catagory/{{$catagory[0]['cat1']}}/catagory/{{$catagory[0]['cat2']}}/catagory/{{$catagory[0]['cat3']}}">{{$catagory[0]['cat3']}}</a></li>
                        @endif
                            @endisset
                    </ul>
                <div class="d-flex bg-white flex-wrap justify-content-start">
                  @foreach($products as $pro)
                    <div class="m-2">
                        <div class="card rounded-0 productSimiler " >
                            <a  href="/detailProduct/{{$pro->id}}"  class="text-decoration-none ">

                                <div class="text-right card-content "><img class="img-fluid  d-block mx-auto"   src="{{asset('storage/products/'.($pro->productimages()->first())['image']  )}}">
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
    </div>
    <!--
    <div class="mt-3 bg-white">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="#">قبلی</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">بعدی</a></li>
        </ul>
    </div>
    -->
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6">
                   <div class="jumbotron bg-info mt-5">
                       <p class="text-dark text-center ">محصولی در این دسته بندی وجود ندارد</p>
                   </div>
                </div>
            </div>
        </div>
        @endif
    @include('ersal')
    @include('footer')
    <script type="text/javascript">
        $(document).ready(function () {
            $(':checkbox').change(function () {
                if (this.checked ){
                    var currenturl = "{{url()->current()}}";
                    var currentfullurl="{{url()->full()}}";
                 //   window.alert(currenturl);
                    if(currenturl == currentfullurl)
                    {
                        window.location = currenturl+"?"+this.name +"="+this.value;
                    }

                    else
                    {
                        currentfullurl = '<?php echo urldecode(url()->full())?>';
                        window.location = currentfullurl+"&"+this.name +"="+this.value;
                    }

                }
                else
                {
                    var hashes=[],hash;
                    var currenturl = "{{url()->current()}}";
                    currenturl = currenturl+"?";
                    console.log("current url is : " + currenturl);
                    var hashes = window.location.href.slice(window.location.href.indexOf('?')+1).split('&');

                    console.log("lent of curl item is : " + hashes.length);
                    for(var i=0 ; i< hashes.length ; i++)
                    {
                        hash = hashes[i].split('=');
                        if(decodeURI(hash[1]) != this.value)
                        {
                            currenturl +=hashes[i];
                            if(i != hashes.length-1)
                                currenturl+="&";
                            console.log("in iterate " + i +"is : " + hash[1] + "and this value is :" + this.value);
                        }

                        console.log("current url in "+ i+" is:" +currenturl);


                    }
                    window.location = currenturl;
                   // console.log("current url in "+ i+" is:" +currenturl);
                }

            });

            // change range of price controll
            $('#customrangeprice').change(function () {
                var range = $('#customrangeprice').val();
                var currenturl = "{{url()->current()}}";
                var currentfullurl="{{url()->full()}}";
                //   window.alert(currenturl);
                if(currenturl == currentfullurl)
                {
                    window.location = currenturl+"?"+this.name +"="+this.value;
                }

                else
                {
                    var hashes=[],hash;
                    var currenturl = "{{url()->current()}}";
                    currenturl = currenturl+"?";

                    var hashes = window.location.href.slice(window.location.href.indexOf('?')+1).split('&');
                    console.log("lent of rang is :" +hashes.length);
                    for(var i=0 ; i< hashes.length ; i++) {
                        hash = hashes[i].split('=');
                        if (hash[0] != this.name) {
                            currenturl += hashes[i];
                            if (i != hashes.length - 1 && hash[0]!='')
                                currenturl += "&";

                        }
                    }
                   // currentfullurl = '<?php echo urldecode(url()->full())?>';
                    window.location = currenturl+"&"+this.name +"="+this.value;
                }
            });
            // show or hide of checkbox filters

        });
        function togglefilter(id)
        {
           var fil = document.getElementById('chckboxfilters'+id);
            if(fil.style.display == 'block')
                fil.style.display = "none";
            else
                fil.style.display = "block";

        }
        function  search()
        {
       // $('#customrangeprice').e
         //   var range = $('#customrangeprice').val();

         //  cu =  currentUrl +"?range="+range+"&brand="+brand;
         //  window.location = cu;


        }

        @isset($selectedBrand )
            var i='{{$selectedBrand ?? ''}}';
      $('#brandSelect option').filter(function () {
            return $(this).text() == i;
      }).attr('selected',true);
        @endisset
        @isset($OldValueOfrange)
        $('#customrangeprice').val({{$OldValueOfrange}});

        @endisset
    </script>
@endsection

