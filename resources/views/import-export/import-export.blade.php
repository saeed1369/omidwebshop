
@extends('layouts.app')

@section('title','export')
@section('content')

<div class="container">
    <div class="card mt-4" >
        <div class="card-header " style="direction: rtl">
            وارد کردن و استخراج کاربران
        </div>
        <div class="card-body">
            <form action="{{ url('importUser') }}" method="POST" name="importform"
                  enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <a class="btn btn-info rtl" href="{{ url('exportUser') }}">
                    دخیره کاربران</a>
                <button class="btn btn-success">وارد کردن کاربران به دیتابیس</button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="card mt-4" >
        <div class="card-header " style="direction: rtl">
            وارد کردن و استخراج فاکتورها
        </div>
        <div class="card-body">
            <form action="{{ url('importFactor') }}" method="POST" name="importform"
                  enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <a class="btn btn-info rtl" href="{{ url('exportFactor') }}">
                    دخیره فاکتورها</a>
                <button class="btn btn-success">وارد کردن فاکتور به دیتابیس</button>
            </form>
        </div>
    </div>
</div>
@endsection
