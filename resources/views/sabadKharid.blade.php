@extends('layouts.app')
@section('title','سبد خرید')

@section('content')
    @include('header')

    <input type="hidden" value="0" id="sumhidden">
    <div class="container bg-white mt-3">
        <div class="row justify-content-center">
            <div class="col-4">
                <h3 class="text-center  border text-danger">سبد خرید شما</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-6 my-2">
                <div class="form-group">
                    <a class="btn btn-dark " href="/">افزودن کالا</a>
                    <a class="btn btn-danger " href="/empty/cart">خالی کردن سبد خرید</a>
                </div>
            </div>
        </div>
    </div>
    @if($errors)
        @foreach($errors->all() as $error)
            <div class="bg-danger"> {{$error}}</div>
        @endforeach
    @endif
    @if(session('pardakht'))
        <div class="text-success text-center border">
            {!! (session('pardakht')) !!}
            {{session()->forget('pardakht')}}
        </div>

    @endif


    <div class="container">
        <div class="row bg-light mt-2">
            <div class="col-sm-4 border-left text-center">
                <span>نام محصول</span>
            </div>

            <div class="col-sm-1 border-left text-center">
                <span>تعداد</span>
            </div>

            <div class="col-sm-2 border-left text-center">
                <span>قیمت واحد</span>
            </div>

            <div class="col-sm-4 border-left text-center">
                <span>قیمت کل</span>
            </div>

            <div class="col-sm-1 border-left bg-danger text-center">
                <span>حذف</span>
            </div>
        </div>
    </div>
    @if(session()->has('cartItem'))
        @foreach(session('cartItem') as $item)
            <div class="container">
                <div class="row bg-white mt-2">
                    <div class="col-sm-4 border-left text-center">

                        <img src="{{asset('storage/products/'.$item['image'])}}" class="img-fluid" width="60px" height="60px">
                        <span>{{$item['name']}}</span>
                    </div>

                    <div class="col-sm-1 border-left d-flex">
                        <div class="my-auto">
                            <input type="number" value="{{$item['number']}}" min="1" class="form-control d-block" onchange="calculateSum({{$item['id']}})" id="number{{$item['id']}}">
                        </div>
                    </div>

                    <div class="col-sm-2 border-left d-flex">
                        <div class="my-auto mx-auto">

                            <span> {{ number_format( $item['price'] ) }}  تومان </span>
                        </div>
                    </div>

                    <div class="col-sm-4 border-left d-flex">
                        <div class="my-auto mx-auto">
                            قیمت : <span id="sum{{$item['id']}}" class="sum">{{ number_format( $item['price'] * $item['number'] )}} </span>

                            <span>تومان</span>
                            <div class=" text-danger">
                                تخفیف :  <span id="takhfif{{$item['id']}}" class="takhfif">{{number_format( ( ($item['price'] * $item['takhfif'])/100 ) * $item['number'] )}} </span>

                                <span>تومان</span>
                            </div>
                            <div class="bg-danger"><hr></div>
                            <div class="">
                                قیمت نهایی :  <span class="finalPrice">{{number_format ( ($item['price'] * $item['number'])-( ($item['price'] * $item['takhfif'])/100 ) * $item['number'] )}}</span>       تومان
                            </div>
                            <div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-1 border-left d-flex bg-danger" >
                        <div class="my-auto mx-auto">
                            <a href="/deleteFromCart/{{$item['id']}}" class="close bg-danger">&times;</a>
                        </div>
                    </div>



                </div>
            </div>
        @endforeach

        <div class="container">
            <div class="row">
                <div class="col-4 offset-6 border mt-3 p-2">
                    <div class="">
                        مجموع سبد خرید :
                        @php $sum = 0 @endphp
                        <span id="sumofsabadkharid">

                    @foreach(session('cartItem') as $item)
                                @php  $sum += ( $item['number'] * $item['price'] ) @endphp

                            @endforeach
                            {{number_format($sum)}}
                </span>  تومان
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row ">
                <div class="col-4 offset-6 border mt-3 p-2 bg-info">
                    <div class="">
                        @php $sumtakhfif = 0 @endphp
                        مجموع تخفیف :
                        <span id="sumoftakhfif">
                        @foreach(session('cartItem') as $item)
                                @php  $sumtakhfif += ( ( ($item['price'] * $item['takhfif'])/100 ) * $item['number'] ) @endphp

                            @endforeach
                            {{number_format($sumtakhfif)}}
                    </span>  تومان
                    </div>
                </div>
            </div>
        </div>

        <div class="container ">
            <div class="row">
                <div class="col-4 offset-6 border mt-3 p-2 bg-success">
                    <div class="">
                        مبلغ قابل پرداخت :
                        <span id="priceofsabadkharid">
                        {{number_format($sum - $sumtakhfif)}}
                    </span>  تومان
                    </div>
                </div>
            </div>
        </div>



        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-6 offset-6 my-2">
                    <form method="get" action="/continuePardakht">
                        @csrf
                        <input type="hidden" name="pay" id="sumofsabadkharidforpay" value="{{ ($sum - $sumtakhfif) ?? ''}}">

                        <div class="form-group">
                            <input type="submit" value="تأیید و ادامه فرایند خرید" name="btnContinuePardakht" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @include('ersal')
    @include('footer')
    <script type="text/javascript">
        function calculateSum(id) {
            var number = '#number'+id;
            var number = $(number).val();
            window.location = "/add/cart/"+id+"/"+number;
        }//end of function calculateSum
        //----------------------------------------------------------------------------------


    </script>
@endsection

