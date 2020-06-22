<?php
use App\Brand;
use App\Filter;
use App\Filtervalue;
use App\Product;
use App\Productfilter;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\Category;
$catagories = Category::all();
$filters = Filter::all();
$filterValues = Filtervalue::all();
?>
<h3 class="text-success">ابتدا فیلتر دلخواه برای اعمال را انتخاب و سپس مقدار ان را مشخص کنید.</h3>

    @foreach($filters as $filter)
        <div class="container-fluid"  style="font-size: large;border-style: solid;border-color:#0c5460;border-width: 1px ">

                <div class=" row" >
                    <div class="col-sm-12">
                       <div class="checkbox">
                        <label ><input type="checkbox" name="filter[]" value='<?php echo  "$filter->id"; ?>' ><strong class="text-danger">{{$filter->name}} : </strong></label>
                    </div>
                    @php
                        $id = $filter->id;
                        $filterval = $filterValues->whereIn('filter_id',[$id]);

                    @endphp

                    @foreach($filterval as $fv)
                        <label class="radio-inline" style="margin-right:20px">

                            <input type="radio" name="<?php echo $filter->id; ?>" value='<?php echo "$fv->value";?>' @if($loop->first) checked @endif>
                            {{$fv->value}}
                        </label>
                    @endforeach


                             <div class="form-group">
                                 <label class="radio-inline" style="margin-right:20px">

                                     <input type="radio" name="<?php echo $filter->id; ?>" value=""  id="<?php echo $filter->id; ?>">
                                     دلخواه <input type="text" class="form-control" id="<?php echo 'txtradio'.$filter->id; ?>" onkeyup="addvaluetoradionbutton({{$filter->id}})" >
                                 </label>
                             </div>

                </div>

                </div>

        </div>

    @endforeach
<script>
    function addvaluetoradionbutton(textid)
    {
       if( document.getElementById(textid).checked == true )
           {
               var textfilter = document.getElementById('txtradio'+textid).value;
               document.getElementById(textid).value = textfilter;
               window.alert( document.getElementById(textid).value);
           }



    }
</script>

