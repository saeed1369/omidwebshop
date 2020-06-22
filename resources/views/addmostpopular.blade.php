


@extends('voyager::master')

@section('page_header')
    <h3 class="text-center"> افزودن تصویر خاص</h3>
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

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form  method="post" action="/admin/mostpopular/savemostpopular"   enctype="multipart/form-data" id="createproductform">
                        <!-- PUT Method if we are editing -->
                        <!-- CSRF TOKEN -->
                        @csrf

                        <div class="panel-body">

                                <input type="hidden" value="{{$id}}" name="productid">
                            <div class="form-group  col-md-12 "  >
                                <div id="wrapper">
                                    {{-- <label class="control-label" for="name">آدرس تصویر</label> --}}

                                    <span style="font-size: small" class="bg-info">با کلیک بر روی 'انتخاب تصویر' تصویری خاص برای محصول خود انتخاب کنید.</span>
                                    <div>
                                        <input type="button" class="btn btn-secondary" name="btnuploadimage" id="btnuploadimage1" value="انتخاب تصویر ">
                                        <span id="tasvir1" class="bg-success" style="margin-right:8px"></span>
                                        <span id="del1"  style="margin-right:8px"></span>
                                    </div>


                                    <input  type="file" id="fileuploadimage1" name="image" accept="image/*"  style="display:none" >

                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save px-3">ذخیره</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="{{asset('style/jquery.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){


        // show window of select file whene click button of انتخاب تصویر
        $('#btnuploadimage1').click(function () {
            $('#fileuploadimage1').click();
            // var file1 =$(this).file[0].name;
        });
        $('#fileuploadimage1').change(function () {
            //  window.alert(this.files[0].name);

            var file =this.files[0].name;
            //  var f = this.files[0];
            //  storedFiles.push(f);
            //  window.alert(this.files[0].name);
            //   $('#tasavir').val(storedFiles);


            var close = "<button type='button' name='clos'  id='deletetasvir1' style='border:1px;border-style:solid;border-radius: 50%;margin-right: 8px;background-color: red' title='حذف'>&times;</button>";
            $('#tasvir1').append(file);
            $('#del1').append(close);



        });
        $('#del1').on('click','#deletetasvir1',function () {

            $('#fileuploadimage1').val('');
            $('#tasvir1').html('');
            $('#deletetasvir1').remove();
        });





    });

</script>
