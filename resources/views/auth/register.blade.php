@extends('layouts.app')
@section('title','ثبت نام')
@section('content')
@include('header')




<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ثبت نام کاربر جدید</div>
                <p style="font-size:small;color: red;padding-right: 2px">پر کردن موارد ستاره دار الزامی می باشد.</p>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">نام و نام خانوادگی<span class="required">*</span> </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">سن</label>

                            <div class="col-md-6">
                                <input id="age" type="number" min="10" max="120" class="form-control" name="age">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="genere" class="col-md-4 col-form-label text-md-right">جنسیت</label>
                            <div class="col-md-6">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input mx-1" name="gener" value="مرد" checked >مرد
                                    </label>

                                </div>

                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input mx-1" name="gener" value="زن">زن
                                    </label>

                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="shoghl" class="col-md-4 col-form-label text-md-right">شغل</label>

                            <div class="col-md-6">
                                <input id="shoghl" type="text" class="form-control" name="shoghl">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tahsilat" class="col-md-4 col-form-label text-md-right">تحصیلات</label>

                            <div class="col-md-6">
                                <input id="tahsilat" type="text" class="form-control" name="tahsilat">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mahalZendegi" class="col-md-4 col-form-label text-md-right">آدرس محل زندگی</label>

                            <div class="col-md-6">
                                <input id="mahalZendegi" type="text" class="form-control" name="mahalZendegi">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="mahalTavalod" class="col-md-4 col-form-label text-md-right">محل تولد</label>

                            <div class="col-md-6">
                                <input id="mahalTavalod" type="text" class="form-control" name="mahalTavalod">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">شماره تلفن همراه</label>

                            <div class="col-md-6">
                                <input id="mobile" type="tel" class="form-control" name="mobile">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">ادرس ایمیل<span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">رمز عبور<span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">تکرار رمز عبور<span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-secondary">
                                    ثبت نام
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('ersal')
@include('footer')
@endsection
