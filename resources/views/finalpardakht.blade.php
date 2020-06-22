@extends('layouts.app')
@section('title','سبد خرید')

@section('content')
    @include('header')


    @if($errors)
        @foreach($errors->all() as $error)
            <div class="bg-danger"> {{$error}}</div>
        @endforeach
    @endif
    @if(session('pardakht'))
      <div class="container mt-2">
          <div class="row">
              <div class="col-8 offset-2">
                  <div class="text-dark text-center border border-0  shadow ">
                      {!! (session('pardakht')) !!}
                      {{-- session()->forget('pardakht') --}}
                  </div>
              </div>
          </div>
      </div>
    @endif
      <div class="container bg-white shadow">
          <div class="row p-2" style="background-color: rgba(91,142,141,0.45)">
              <div class="col-md-4  offset-md-2">
                  <span>نام تحویل گیرنده : </span><span>{{session('namegirandeh')}}</span>
              </div>
              <div class="col-md-4">
                  <span>شماره تماس : </span><span>{{session('mobile')}}</span>
              </div>
          </div>
          <div class="row p-2">
              <div class="col-md-4 offset-md-2 ">
                  <span>تعداد مرسوله : </span><span>{{session('number')}}</span>
              </div>
              <div class="col-md-4">
                  <span> مبلغ کل : </span><span>{{session('mablagh')}}</span>
              </div>
          </div>
          <div class="row p-2"  style="background-color: rgba(91,142,141,0.45)">
              <div class="col-md-4 offset-md-2">
                  <span>روش پرداخت : </span><span>اینترنتی</span>
              </div>
              <div class="col-md-4">
                  <span> وضعیت سفارش : </span><span>در حال پردازش</span>
              </div>
          </div>
          <div class="row p-2">
              <div class="col-md-8 offset-md-2">
                  <span> آدرس : </span><span>{{session('address')}}</span>
              </div>
          </div>
      </div>
    <div class="container">
        <div class="mt-3">
            <h4>جزئیات پرداخت</h4>
        </div>
    </div>
    <div class="container bg-white shadow">
        <div class="row">
            <div class="col-8">
                <table class="table table-responsive table-hover table-striped">
                    <thead class="text-center">
                    <tr>
                        <th>ردیف</th>
                        <th>درگاه پرداخت</th>
                        <th>شماره پیگیری</th>
                        <th>تاریخ</th>
                        <th>مبلغ(تومان)</th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(session('result'))

                            <tr>
                                <td>1</td>
                                <td>درگاه پی</td>
                                <td>{{session('result')->transId}}</td>
                                <td>{{now()}}</td>
                                <td>{{number_format(session('result')->amount /10)}}</td>
                                <td>پرداخت موفق</td>

                            </tr>

                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group">
            <a class="btn btn-dark " href="/"> صفحه اصلی</a>
        </div>
    </div>




    @include('ersal')
    @include('footer')

@endsection

