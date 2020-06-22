
@extends('layouts.app')
@section('title', $catagory[0]['cat1'] ?? '')
@section('content')
    @include('header')

    <div class="container-fluid">
        <div class="row">
            <div class="empty my-5">

            </div>
            <div class="col-10">
                @if($products->count()>0)

                <div class="d-flex bg-white flex-wrap">
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
                       <p class="text-dark text-center ">محصولی  وجود ندارد</p>
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
        });
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

