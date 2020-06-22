
@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title','ویرایش محصول')

@section('page_header')
    <h1 class="page-title">

       ویرایش محصول
    </h1>


@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                          class="form-edit-add"
                          action="{{route('voyager.products.update',$id)}}"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        {{ method_field("PUT") }}

                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group  col-md-12 ">

                                    <label class="control-label" for="name">نام محصول</label>
                                    <input required="" type="text" class="form-control" name="name" placeholder="نام محصول" value="{{$data->name}}">
                                </div>
                                <!-- GET THE DISPLAY OPTIONS -->
                                <div class="container"  id="wrapper"  style="margin-top: 5px ;">
                                    <div class="row">
                                        <legend>تصاویر محصول</legend>
                                        @foreach($data->productimages()->get() as $img)
                                            <div class="col-sm-3" style="text-align: center">
                                                <div>
                                                    <img src="{{asset('storage/products/'.$img->image)}}" width="60px" height="60px" id="image{{$loop->iteration}}">
                                                </div>
                                                <div>
                                                    <button type='button' name='clos' class="btn btn-danger"   id='deletetasvir{{$loop->iteration}}' style='border:1px;border-style:solid;margin-right: 3px;background-color: red;margin-top: 2px;margin-bottom: 2px' title='حذف'>حذف </button>
                                                </div>
                                                <div>
                                                    <input  type="file" id="fileuploadimage{{$loop->iteration}}" name="image[]" accept="image/*"  style="display:none" >
                                                    <input type="hidden" name="oldimage{{$loop->iteration}}" id="oldimage{{$loop->iteration}}" value="1">
                                                    <input type="hidden" name="oldimageid{{$loop->iteration}}" id="oldimageid{{$loop->iteration}}" value="{{$img->id}}">
                                                    <input type="button" class="btn btn-secondary" name="btnuploadimage" id="btnuploadimage{{$loop->iteration}}" value="تغییر تصویر {{$loop->iteration}}">
                                                </div>
                                            </div>
                                        @endforeach
                                        @php
                                            $countofimage = $data->productimages()->count();
                                        @endphp
                                        @for($i=$countofimage+1;$i <= 4 ; $i++)
                                            <div class="col-sm-3" style="text-align: center">
                                                <div>
                                                    <img src="" width="60px"; height="60px" id="image{{$i}}">
                                                </div>
                                                <div>
                                                    <button type='button' name='clos'   id='deletetasvir{{$i}}' style='border:1px;border-style:solid;margin-right: 3px;background-color: red;margin-bottom: 2px;margin-top: 2px' title='حذف'>حذف </button>
                                                </div>
                                                <div>
                                                    <input type="button" class="btn btn-secondary" name="btnuploadimage" id="btnuploadimage{{$i}}" value="انتخاب تصویر {{$i}}">
                                                    <input  type="file" id="fileuploadimage{{$i}}" name="image[]" accept="image/*"  style="display:none" value="">
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>


                                <!-- GET THE DISPLAY OPTIONS -->
                                <div class="form-group  col-md-12 ">

                                    <label class="control-label" for="name">قیمت ( تومان )</label>
                                    <input required="" type="text" class="form-control" name="price" placeholder="قیمت ( تومان )" value="{{$data->price}}">
                                </div>
                                <!-- GET THE DISPLAY OPTIONS -->

                                <div class="form-group  col-md-12 ">

                                    <label class="control-label" for="name">درصد تخفیف</label>
                                    <input  type="text" class="form-control" name="takhfif" placeholder="درصد تخفیف" value="{{$data->takhfif}}">


                                </div>

                                <!-- GET THE DISPLAY OPTIONS -->

                                <div class="form-group  col-md-12 ">

                                    <label class="control-label" for="name">دسته بندی سطح 1</label>



                                    <select class="form-control select2 select2-hidden-accessible" name="catagory1" id="catagory1"  tabindex="-1" aria-hidden="true">

                                        @foreach($catagory as $cat1)
                                            @if($cat1->parent_id ==null)
                                                <option value="{{$cat1->id}}" @php if($cat1->name == $data->catagory1){echo 'selected';$id= $cat1->id;} @endphp>
                                                    {{$cat1->name}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <!-- GET THE DISPLAY OPTIONS -->

                                <div class="form-group  col-md-12 ">

                                    <label class="control-label" for="name">دسته بندی سطح 2</label>
                                    <select id="catagory2" class="form-control select2 select2-hidden-accessible" name="catagory2"  tabindex="-1" aria-hidden="true">
                                        @php
                                            $objid = $catagory->first();
                                            //$id = $objid->id;
                                            $parentid = $objid->parent_id;
                                            $first=true;
                                        @endphp
                                        @foreach($catagory as $cat2)

                                            @if($cat2->parent_id ==$id)
                                                @php if($first) $id3  = $cat2->id;$first=false; @endphp
                                                <option value="{{$cat2->id}}" @php if($cat2->name == $data->catagory2) echo 'selected' @endphp>{{$cat2->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>


                                </div>
                                <!-- GET THE DISPLAY OPTIONS -->

                                <div class="form-group  col-md-12 ">

                                    <label class="control-label" for="name">دسته بندی سطح 3</label>


                                        <select id="catagory3" class="form-control select2 select2-hidden-accessible" name="catagory3"  tabindex="-1" aria-hidden="true">

                                            @foreach($catagory as $cat3)
                                                @if($cat3->parent_id ==$id3 ?? '')
                                                    <option value="{{$cat3->id}}" @php if($cat3->name == $data->catagory3) echo 'selected' @endphp>{{$cat3->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                </div>


                                <!-- GET THE DISPLAY OPTIONS -->

                                <div class="form-group  col-md-12 ">

                                    <label class="control-label" for="name">شرکت</label>
                                    <input  type="text" class="form-control" name="company" placeholder="شرکت" value="{{$data->company}}">


                                </div>
                                <!-- hidden aboutproduct save for next -->
                                <input type="hidden" name="aboutproduct" value="{{$data->aboutProduct}}">
                                <!-- GET THE DISPLAY OPTIONS -->


                                <!-- GET THE DISPLAY OPTIONS -->
                                <!--
                                <div class="form-group  col-md-12 ">

                                    <label class="control-label" for="name">درباره محصول</label>
                                    <input  type="text" class="form-control" name="aboutProduct" placeholder="درباره محصول" value="{{$data->aboutProduct}}">


                                </div>
                                -->



                                <!-- GET THE DISPLAY OPTIONS -->

                                <!-- GET THE DISPLAY OPTIONS -->





                                <!-- GET THE DISPLAY OPTIONS -->

                                <div class="form-group  col-md-12 ">

                                    <label class="control-label" for="name">تعدا موجود</label>
                                    <input type="text" class="form-control" name="available" placeholder="تعدا موجود" value="{{$data->available}}">


                                </div>

                                <div class="form-group  col-md-12 ">

                                    <label class="control-label" for="name">ویژگی ها(هر ویژگی را در یک خط وارد کنید.)</label>
                                    <textarea name="featuers" class="form-control" rows="6">{{$data->featuers}}</textarea>
                                </div>
                                <!-- GET filters -->

                                <div class="col-md-12 ">

                                     @include('voyager::products.filtersEdit')
                                </div>
                        </div><!-- panel-body -->


                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit" class="btn btn-primary save">مرحله بعد</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                               onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ 'products' }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>


    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
            return function() {
                $file = $(this).siblings(tag);

                params = {
                    slug:   'products',
                    filename:  $file.data('file-name'),
                    id:     $file.data('id'),
                    field:  $file.parent().data('field-name'),
                    multi: isMulti,
                    _token: '{{ csrf_token() }}'
                }

                $('.confirm_delete_name').text(params.filename);
                $('#confirm_delete_modal').modal('show');
            };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });



            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.'products'.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();

            $('#catagory2').change(function () {
                var selectedindexcatagory2 = $(this).val();
                console.log("selected index catgory2 is "+selectedindexcatagory2);
                var cat2 =<?php echo $catagory ;?>;
                var option = "";
                if(selectedindexcatagory2) {
                    console.log("selected index catgory2 is not null");
                    for (var x in cat2)
                        if (cat2[x]['parent_id'] == selectedindexcatagory2)
                            option += "<option value=" + cat2[x]['id'] + ">" + cat2[x]['name'] + "</option>";
                }
                console.log("option is :" +option);
                if(option == "")
                {
                    console.log("option is empty");
                    $('#catagory3').find('option').remove();
                }
                else
                    $('#catagory3').html(option);


            });
            $('#catagory1').change(function () {
                var selectedindexcatagory1 = $(this).val();
                console.log("cat 3 is "+selectedindexcatagory1);
                var cat1 =<?php echo $catagory ;?>;
                var option = "";
                for(var x in cat1)
                    if(cat1[x]['parent_id'] == selectedindexcatagory1)
                        option += "<option value="+cat1[x]['id']+">"+cat1[x]['name']+"</option>";
                $('#catagory2').html(option);
                $('#catagory2').trigger('change');

            });

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
                if(this.files && this.files[0])
                {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image1').attr("src",e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                    $('#oldimage1').val("2");
                }
            });

            $('#btnuploadimage2').click(function () {
                $('#fileuploadimage2').click();
                // var file1 =$(this).file[0].name;
            });
            $('#fileuploadimage2').change(function () {
                //  window.alert(this.files[0].name);

                var file =this.files[0].name;
                //  var f = this.files[0];
                //  storedFiles.push(f);
                //  window.alert(this.files[0].name);
                //   $('#tasavir').val(storedFiles);
                var close = "<button type='button' name='clos'  id='deletetasvir2' style='border:1px;border-style:solid;border-radius: 50%;margin-right: 8px;background-color: red' title='حذف'>&times;</button>";
                if(this.files && this.files[0])
                {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image2').attr("src",e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                    $('#oldimage2').val("2");
                }
            });

            $('#btnuploadimage3').click(function () {
                $('#fileuploadimage3').click();
                // var file1 =$(this).file[0].name;
            });
            $('#fileuploadimage3').change(function () {
                //  window.alert(this.files[0].name);

                var file =this.files[0].name;
                //  var f = this.files[0];
                //  storedFiles.push(f);
                //  window.alert(this.files[0].name);
                //   $('#tasavir').val(storedFiles);
                var close = "<button type='button' name='clos'  id='deletetasvir3' style='border:1px;border-style:solid;border-radius: 50%;margin-right: 8px;background-color: red' title='حذف'>&times;</button>";
                if(this.files && this.files[0])
                {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image3').attr("src",e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                    $('#oldimage3').val("2");
                }



            });

            $('#btnuploadimage4').click(function () {
                $('#fileuploadimage4').click();
                // var file1 =$(this).file[0].name;
            });
            $('#fileuploadimage4').change(function () {
                //  window.alert(this.files[0].name);

                var file =this.files[0].name;
                //  var f = this.files[0];
                //  storedFiles.push(f);
                //  window.alert(this.files[0].name);
                //   $('#tasavir').val(storedFiles);
                var close = "<button type='button' name='clos'  id='deletetasvir4' style='border:1px;border-style:solid;border-radius: 50%;margin-right: 8px;background-color: red' title='حذف'>&times;</button>";
                if(this.files && this.files[0])
                {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image4').attr("src",e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                    $('#oldimage4').val("2");
                }



            });
            $('#deletetasvir1').on('click',function () {

                $('#fileuploadimage1').val('');
                $('#image1').attr("src",'');
                $('#oldimage1').val("2");


            });
            $('#deletetasvir2').on('click',function () {

                $('#fileuploadimage2').val('');
                $('#image2').attr("src",'');
                $('#oldimage2').val("2");

            });
            $('#deletetasvir3').on('click',function () {

                $('#fileuploadimage3').val('');
                $('#image3').attr("src",'');
                $('#oldimage3').val("2");

            });
            $('#deletetasvir4').on('click',function () {

                $('#fileuploadimage4').val('');
                $('#image4').attr("src",'');
                $('#oldimage4').val("2");

            });
        });
    </script>
@stop
