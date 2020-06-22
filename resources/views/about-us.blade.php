@extends('layouts.app')
@section('title','فروشگاه اینترنتی محصولات آرایشی')

@section('content')
    @include('header')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-6 bg-white">
                <div class="my-3">
                    <p>
                        شرکت ما فعالیت خود را از سال 1383 شروع کرده و یکی از موفق ترین فروشگاه ها در زمینه فروش محصولات ارایشی و بهداشتی می باشد.
                    </p>
                </div>
            </div>
        </div>
    </div>

    @include('ersal')
    @include('footer')
@endsection

