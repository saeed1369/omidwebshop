


@extends('voyager::master')

@section('page_header')
   <h3 class="text-center"> افزودن محصول جدید</h3>
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
                    <form  method="post" action="/admin/products"   enctype="multipart/form-data" id="createproductform">
                        <!-- PUT Method if we are editing -->
                        <!-- CSRF TOKEN -->
                        @csrf

                        <div class="panel-body">

                            <div class="form-group  col-md-12 ">

                                <label class="control-label" for="name">نام محصول</label>
                                <input required="" type="text" class="form-control" name="name" placeholder="نام محصول" value="">
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->

                            <div class="form-group  col-md-12 "  >
                                <div id="wrapper">
                               {{-- <label class="control-label" for="name">آدرس تصویر</label> --}}

                                    <span style="font-size: small" class="bg-info">با کلیک بر روی 'انتخاب تصویر' تصاویر برای محصول خود انتخاب کنید.</span>
                                    <div>
                                        <input type="button" class="btn btn-secondary" name="btnuploadimage" id="btnuploadimage1" value="انتخاب تصویر اصلی">
                                        <span id="tasvir1" class="bg-success" style="margin-right:8px"></span>
                                        <span id="del1"  style="margin-right:8px"></span>
                                    </div>
                                    <div>
                                        <input type="button" class="btn btn-secondary" name="btnuploadimage" id="btnuploadimage2" value="انتخاب تصویر 2">
                                        <span id="tasvir2" class="bg-success" style="margin-right:8px"></span>
                                        <span id="del2"  style="margin-right:8px"></span>
                                    </div>
                                    <div>
                                        <input type="button" class="btn btn-secondary" name="btnuploadimage" id="btnuploadimage3" value=" انتخاب تصویر 3">
                                        <span id="tasvir3" class="bg-success" style="margin-right:8px"></span>
                                        <span id="del3"  style="margin-right:8px"></span>
                                    </div>
                                    <div>
                                        <input type="button" class="btn btn-secondary" name="btnuploadimage" id="btnuploadimage4" value="انتخاب تصویر 4">
                                        <span id="tasvir4" class="bg-success" style="margin-right:8px"></span>
                                        <span id="del4"  style="margin-right:8px"></span>
                                    </div>


                                    <input  type="file" id="fileuploadimage1" name="image[]" accept="image/*"  style="display:none" >
                                    <input  type="file" id="fileuploadimage2" name="image[]" accept="image/*"  style="display:none" >
                                    <input  type="file" id="fileuploadimage3" name="image[]" accept="image/*"  style="display:none" >
                                    <input  type="file" id="fileuploadimage4" name="image[]" accept="image/*"  style="display:none" >
                                </div>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->

                            <div class="form-group  col-md-12 ">

                                <label class="control-label" for="name">قیمت ( تومان )</label>
                                <input required="" type="text" class="form-control" name="price" placeholder="قیمت " value="" id="price" onkeyup="separateNum(this.value,this);">
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->

                            <div class="form-group  col-md-12 ">

                                <label class="control-label" for="name">درصد تخفیف</label>
                                <input  type="text" class="form-control" name="takhfif" placeholder="درصد تخفیف" value="">
                            </div>


                            <div class="form-group  col-md-12 ">

                                <label class="control-label" for="name">دسته بندی سطح 1</label>



                                <select class="form-control select2 select2-hidden-accessible" name="catagory1" id="catagory1"  tabindex="-1" aria-hidden="true">

                                    @foreach($catagory as $cat1)
                                        @if($cat1->parent_id ==null)
                                            <option value="{{$cat1->id}}" >{{$cat1->name}}</option>
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
                                        $id = $objid->id;
                                        $parentid = $objid->parent_id;
                                        $first=true;
                                   @endphp
                                    @foreach($catagory as $cat2)

                                        @if($cat2->parent_id ==$id)
                                            @php if($first) $id3 = $cat2->id;$first=false; @endphp
                                            <option value="{{$cat2->id}}">{{$cat2->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->

                            <div class="form-group  col-md-12 ">

                                <label class="control-label" for="name">دسته بندی سطح 3</label>


                                <select id="catagory3" class="form-control select2 select2-hidden-accessible" name="catagory3"  tabindex="-1" aria-hidden="true">

                                    @foreach($catagory as $cat3)
                                        @if($cat3->parent_id ==$id3)
                                            <option value="{{$cat3->id}}">{{$cat3->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group  col-md-12 ">

                                <label class="control-label" for="name">شرکت</label>
                                <input  type="text" class="form-control" name="company" placeholder="شرکت" value="">
                            </div>
                            <!--
                            <div class="form-group  col-md-12 ">

                                <label class="control-label" for="name">درباره محصول</label>
                                <input  type="text" class="form-control" name="aboutProduct" placeholder="درباره محصول" value="">
                            </div>
                            -->
                            <!-- GET THE DISPLAY OPTIONS -->

                            <div class="form-group  col-md-12 ">

                                <label class="control-label" for="name">تعدا موجود</label>
                                <input type="text" class="form-control" name="available" placeholder="تعدا موجود" value="" required>
                            </div>

                            <div class="form-group  col-md-12 ">

                                <label class="control-label" for="name">ویژگی ها<span class="bg-info">(هر ویژگی را در یک خط وارد کنید.)</span></label>
                                <textarea name="featuers" class="form-control" rows="6"></textarea>
                            </div>

                            <!--  add to mostpopular products -->
                            <div class="form-group  col-md-12 ">

                                <div class="checkbox">
                                    <label ><input type="checkbox" name="chkmostpopular"  id="chkmostpopular"><strong class="text-danger">انتخاب به عنوان محبوب ترین محصول </strong></label>
                                    <div>
                                        <input type="button" class="btn btn-secondary" name="btnmostpopular" id="btnmostpopular" value="انتخاب تصویر محبوب ترین محصول" style="display: none">
                                        <span id="tasvirmostpopular" class="bg-success" style="margin-right:8px"></span>
                                        <span id="delmostpopular"  style="margin-right:8px"></span>
                                    </div>
                                    <input  type="file" id="filemostpopular" name="mostpopular" accept="image/*"  style="display:none" >
                                </div>
                            </div>
                            <!-- GET filters -->

                            <div class="col-md-12 ">

                               @include('filters')
                            </div>

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save px-3">مرحله بعد</button>
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="http://shop-laravel.com/admin/upload" target="form_target" method="post" enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="products">
                        <input type="hidden" name="_token" value="TNDGbpgBmbqTyrK3ebEe9mwKGENURqthAsZm5uYd">
                    </form>
                </div>
            </div>
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

@endsection
<script src="{{asset('style/jquery.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
       // $("#fileuploadimage").fileinput();
        $('input[name ="image"] ').val('');
        var storedFiles = []
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
            $('#tasvir2').append(file);
            $('#del2').append(close);



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
            $('#tasvir3').append(file);
            $('#del3').append(close);



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
            $('#tasvir4').append(file);
            $('#del4').append(close);



        });
        $('#del1').on('click','#deletetasvir1',function () {

            $('#fileuploadimage1').val('');
            $('#tasvir1').html('');
            $('#deletetasvir1').remove();
        });
        $('#del2').on('click','#deletetasvir2',function () {

            $('#fileuploadimage2').val('');
            $('#tasvir2').html('');
            $('#deletetasvir2').remove();
        });
        $('#del3').on('click','#deletetasvir3',function () {

            $('#fileuploadimage3').val('');
            $('#tasvir3').html('');
            $('#deletetasvir3').remove();
        });
        $('#del4').on('click','#deletetasvir4',function () {

            $('#fileuploadimage4').val('');
            $('#tasvir4').html('');
            $('#deletetasvir4').remove();
        });
        $('#createproductform').on('submit',function () {
            var price = $('#price').val();
            price = price.replace(/,\s?/g, "");
           $('#price').val(price);
        });

        $('#btnmostpopular').click(function () {
            $('#filemostpopular').click();
            // var file1 =$(this).file[0].name;
        });
        $('#filemostpopular').change(function () {
            //  window.alert(this.files[0].name);

            var file =this.files[0].name;
            //  var f = this.files[0];
            //  storedFiles.push(f);
            //  window.alert(this.files[0].name);
            //   $('#tasavir').val(storedFiles);
            var close = "<button type='button' name='clos'  id='deletetasvirmostpopular' style='border:1px;border-style:solid;border-radius: 50%;margin-right: 8px;background-color: red' title='حذف'>&times;</button>";
            $('#tasvirmostpopular').append(file);
            $('#delmostpopular').append(close);



        });
        $('#delmostpopular').on('click','#deletetasvirmostpopular',function () {

            $('#filemostpopular').val('');
            $('#tasvirmostpopular').html('');
            $('#delmostpopular').remove();
        });

        if( $('#chkmostpopular').prop('checked') ==true)
        {
            $('#btnmostpopular').css('display','inline-block');
        }


        $('#chkmostpopular').change(function () {
                if(this.checked)
                {
                    $('#btnmostpopular').css('display','inline-block');
                }
                else
                {
                    $('#btnmostpopular').css('display','none');
                }

        });



    });
    function separateNum(value, input) {
        /* seprate number input 3 number */
        var nStr = value + '';
        nStr = nStr.replace(/\,/g, "");
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        if (input !== undefined) {

            input.value = x1 + x2;
        } else {
            return x1 + x2;
        }
    }



</script>
