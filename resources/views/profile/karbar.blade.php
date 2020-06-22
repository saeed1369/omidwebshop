@php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
@endphp
@extends('layouts.app')
@section('title','پروفایل')
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
                    <li class="nav-item" role="presentation"><a class="nav-link active text-right" href="{{url('profile')}}"><i class="fa fa-user"></i><span class="mr-1">اطلاعات حساب</span></a></li>

                    <li class="nav-item" role="presentation"><a class="nav-link  text-right" href="{{url('address')}}"><i class="fa fa-user"></i><span class="mr-1">جزئیات آدرس</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-right" href="{{url('purchasesUser')}}"><i class="fa fa-shopping-cart"></i><span class="mr-1">خرید های شما</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-right" href="{{url('/')}}"><i class="fa fa-home"></i><span class="mr-1">صفحه اصلی</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-right" href="#"><i class="fa fa-home"></i><span class="mr-1">محصولات مناسب شما</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-right" href="{{url('logout')}}"><i class="fas fa-sign-out-alt"></i><span class="mr-1">خروج</span></a></li>
                </ul>

            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">

                <div class="container-fluid">

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow">
                                    <img class="rounded-circle mb-3 mt-4" src="{{asset('storage/'.\Illuminate\Support\Facades\Auth::user()->avatar)}}" width="160" height="160">
                                    <form method="post" action="{{url('userAvatarFile')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="file" name="userAvatarImage">

                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class=" btn btn-danger" name="saveAvatar" value="ذخیره ">
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-header py-3 text-right">
                                            <p class="text-primary m-0 font-weight-bold">تغییر رمز عبور</p>
                                        </div>
                                        <div class="card-body">
                                            @error('password')
                                            <div class="alert alert-danger text-right">{{ $message }}</div>
                                            @enderror
                                            <form method="post" action="{{url('changeUserPassword')}}">
                                                @csrf
                                                <div class="form-group text-right "><label for="password"><strong>رمز عبور جدید</strong></label><input class="form-control" id="password" type="password"  name="password"></div>
                                                <div class="form-group text-right "><label for="password-confirmation"><strong>تکرار رمز عبور جدید</strong></label><input class="form-control" id="password-confirmation" type="password" name="password_confirmation"></div>

                                                <div class="form-group"><button class="btn btn-danger btn-sm" type="submit" name="btnChangePassword">تغییر رمز عبور</button></div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-header py-3">
                                        <p class="text-primary text-right m-0 font-weight-bold">اطلاعات شخصی</p>
                                    </div>
                                    <div class="card-body bg-white">
                                        @if($errors->any())
                                        <div class="alert alert-danger text-right">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                    @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        <form method="post" action="{{url('/changeOherAttributes')}}">
                                            @csrf

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group text-right"><label for="first_name"><strong>نام و نام خانوادگی</strong></label><input class="form-control" type="text" placeholder="" name="name" value= "{{Auth::user()->name}}"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group text-right"><label for="last_name"><strong>شماره موبایل</strong></label><input class="form-control" type="tel" placeholder="" name="mobile" value= "{{Auth::user()->mobile}}"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group text-right"><label for="first_name"><strong>سن</strong></label><input class="form-control" type="text" placeholder="" name="age"  value= "{{Auth::user()->age}}"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group text-right"><label for="kodemelli"><strong>کد ملی</strong></label><input class="form-control" type="text" placeholder="" name="kodemelli"  value= "{{Auth::user()->kodemelli}}"></div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group text-right"><label for="first_name"><strong>شغل</strong></label><input class="form-control" type="text" placeholder="" name="shoghl" value= "{{Auth::user()->shoghl}}"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group text-right"><label for="last_name"><strong>تحصیلات</strong></label><input class="form-control" type="text" placeholder="" name="tahsilat" value= "{{Auth::user()->tahsilat}}"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group text-right"><label for="first_name"><strong>جنسیت</strong></label></div>
                                                    <div class="form-group text-right ">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label text-right">
                                                                <input type="radio" class="form-check-input mx-1 text-right" name="gener" value="مرد" @php  if(Auth::user()->gener == 'مرد') echo 'checked'; @endphp  >مرد
                                                                <input type="radio" class="form-check-input mx-1" name="gener" value="زن" @php  if(Auth::user()->gener == 'زن') echo 'checked'; @endphp>زن
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group"><button class="btn btn-danger btn-sm" type="submit" name="saveUserCahnge">دخیره تغییرات</button></div>
                                        </form>
                                    </div>

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
