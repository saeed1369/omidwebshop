@extends('layouts.app')
@section('title','خرید های من')
@section('profile_assets')
<link href="{{ asset('style/profile/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('style/profile/script.min.js')}}"></script>
@endsection
@section('content')
@include('header')

<div  class="mt-3">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar  sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column justify-content-start p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>فروشگاه لوازم خانگی</span></div>
                </a>
                <hr class="divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">

                    <li class="nav-item" role="presentation"><a class="nav-link  text-right" href="{{url('profile')}}"><i class="fa fa-user"></i><span class="mr-1">اطلاعات حساب</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link  text-right" href="{{url('address')}}"><i class="fa fa-user"></i><span class="mr-1">جزئیات آدرس</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active text-right" href="{{url('purchasesUser')}}"><i class="fa fa-shopping-cart"></i><span class="mr-1">خرید های شما</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-right" href="{{url('/')}}"><i class="fa fa-home"></i><span class="mr-1">صفحه اصلی</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-right" href=""><i class="fa fa-home"></i><span class="mr-1">محصولات مناسب شما</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-right" href="{{url('logout')}}"><i class="fas fa-sign-out-alt"></i><span class="mr-1">خروج</span></a></li>
                </ul>

            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header py-3 text-right">
                            <p class="text-danger m-0 font-weight-bold">خریدهای شما</p>
                        </div>
                        <div class="card-body">
                            <div class="panel border shadow">
                                <div class="panel-content">
                                    <table class="table table-responsive table-hover table-striped">
                                        <thead class="text-center">
                                            <tr>
                                                <th>ردیف</th>
                                                <th>نام محصول</th>
                                                <th> قیمت واحد(تومان)</th>
                                                <th>تعداد</th>
                                                <th>قیمت کل</th>
                                                <th>تاریخ</th>
                                                <th>شماره پیگیری</th>
                                                <th>وضعیت سفارش</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $i = 1 @endphp

                                            @isset($purchases)
                                            @foreach($purchases as $sal)
                                                <tr>
                                                    <td>{{$i++ }}</td>
                                                    <td>{{$sal->name}}</td>
                                                    <td>{{number_format(  ($sal->price)-($sal->price * $sal->takhfif/100) )}}</td>
                                                    <td>{{$sal->number}}</td>
                                                    <td>{{number_format( (($sal->price)-($sal->price * $sal->takhfif/100))* $sal->number )}}</td>
                                                    <td>{{$sal->created_at}}</td>
                                                    <td>{{$sal->transId}}</td>
                                                    <td>
                                                        @if($sal->status =='در حال پردازش')
                                                            <span class="bg-danger text-dark p-1 rounded">{{$sal->status}}</span>
                                                            @else
                                                            <span class="bg-success text-dark p-1 rounded">{{$sal->status}}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
     </div>
</div>


@include('ersal')
@include('footer')
@endsection
