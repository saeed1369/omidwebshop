


@extends('voyager::master')

@section('page_header')
   <h3 class="text-center"> درباره محصول</h3>
   @if ($errors->any())
       <div class="alert alert-danger">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
   @endif
@endsection
@php

@endphp
@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <form  method="post" action="/admin/productsContinue"   enctype="multipart/form-data" id="createproductform">
                @csrf
                <div class="col-md-12">

                <div class="form-group  col-md-12 ">

                        <textarea id="ckeckditor1" name="aboutProduct">
                                    {{session('aboutproducts')}}
                        </textarea>
                </div>
            </div>

            <div class="col-md-12 text-center">
                <input type="submit" class="btn btn-primary " name="savecountinue" value="ذخیره">
            </div>
            </form>
        </div>
    </div>
    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> اطمینان دارید</h4>
                </div>

                <div class="modal-body">
                    <h4>از حذف اطمینان دارید '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">بله، این را حذف کن!</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('style/ckeditor/ckeditor.js')}}"></script>

    <script type="text/javascript">
        CKEDITOR.replace( 'ckeckditor1' );
    </script>
@endsection

    <script src="{{asset('style/jquery.min.js')}}"></script>






