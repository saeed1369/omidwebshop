<?php

namespace TCG\Voyager\Http\Controllers;
use App\Brand;
use App\Filter;
use App\Filtervalue;
use App\Http\Controllers\Upload;
use App\Mostpopular;
use App\Product;
use App\Productfilter;
use App\Productimage;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\productController;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataRestored;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use TCG\Voyager\Models\Category;


class VoyagerBaseController extends Controller
{
    use BreadRelationshipParser;

    //***************************************
    //               ____
    //              |  _ \
    //              | |_) |
    //              |  _ <
    //              | |_) |
    //              |____/
    //
    //      Browse our Data Type (B)READ
    //
    //****************************************

    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $getter = $dataType->server_side ? 'paginate' : 'get';
        $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];
        if($slug == 'products')
        {
            if( $request->get('keycatagory1') =='all') $catagory1value ='all';elseif(!$request->get('keycatagory1'))$catagory1value ='all'; else $catagory1value = Category::find($request->get('keycatagory1'))->name;
            if( $request->get('keycatagory2') =='all') $catagory2value ='all';elseif(!$request->get('keycatagory2'))$catagory2value ='all'; else $catagory2value = Category::find($request->get('keycatagory2'))->name;
           if( $request->get('keycatagory3') =='all') $catagory3value ='all';elseif(!$request->get('keycatagory3'))$catagory3value ='all'; else $catagory3value = Category::find($request->get('keycatagory3'))->name;
            $searchnameproduct = (object) ['key'=> 'name' ,'value' => $request->get('sname'), 'filter' => $request->get('filtername')];
            $searchcatagory1 = (object) [ 'key' => $request->get('keycatagory1'),'value' =>$catagory1value ];
            $searchcatagory2 = (object) ['key' => $request->get('keycatagory2'),'value'=>$catagory2value];
            $searchcatagory3 = (object) [ 'key' => $request->get('keycatagory3'),'value'=>$catagory3value];
        }

        $searchNames = [];
        if ($dataType->server_side) {
            $searchable = SchemaManager::describeTable(app($dataType->model_name)->getTable())->pluck('name')->toArray();
            $dataRow = Voyager::model('DataRow')->whereDataTypeId($dataType->id)->get();
            foreach ($searchable as $key => $value) {
                $field = $dataRow->where('field', $value)->first();
                $displayName = ucwords(str_replace('_', ' ', $value));
                if ($field !== null) {
                    $displayName = $field->getTranslatedAttribute('display_name');
                }
                $searchNames[$value] = $displayName;
            }
        }

        $orderBy = $request->get('order_by', $dataType->order_column);
        $sortOrder = $request->get('sort_order', $dataType->order_direction);
        $usesSoftDeletes = false;
        $showSoftDeleted = false;

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $query = $model->{$dataType->scope}();
            } else {
                $query = $model::select('*');
            }

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model)) && Auth::user()->can('delete', app($dataType->model_name))) {
                $usesSoftDeletes = true;

                if ($request->get('showSoftDeleted')) {
                    $showSoftDeleted = true;
                    $query = $query->withTrashed();
                }
            }

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');

            if ($search->value != '' && $search->key && $search->filter && $slug !='products') {
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%'.$search->value.'%';
                $query->where($search->key, $search_filter, $search_value);
            }
            if($slug == 'products')
            {

                if ($searchnameproduct->value!='' && $searchnameproduct->key && $searchnameproduct->filter) {
                    $search_filter = ($searchnameproduct->filter == 'equals') ? '=' : 'LIKE';
                    $search_value = ($searchnameproduct->filter == 'equals') ? $searchnameproduct->value : '%'.$searchnameproduct->value.'%';
                    $query = $query->where($searchnameproduct->key, $search_filter, $search_value);
                    echo "name";
                }
                if ($searchcatagory2->key && $searchcatagory1->key !='all') {
                    $query = $query->where('catagory1',$searchcatagory1->value);
                    echo "catgory1";
                }

                if ( $searchcatagory2->key && $searchcatagory2->key !='all') {

                    $query = $query->where('catagory2' , $searchcatagory2->value);
                    echo "catgory2";
                }
                if ($searchcatagory3->key && $searchcatagory3->key !='all') {

                    $query = $query->where('catagory3' , $searchcatagory3->value);
                    echo "catgory3";
                }
                //exit('end of search products');
            }

            if ($orderBy && in_array($orderBy, $dataType->fields())) {
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
                $dataTypeContent = call_user_func([
                    $query->orderBy($orderBy, $querySortOrder),
                    $getter,
                ]);
            } elseif ($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
            } else {
                $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'browse', $isModelTranslatable);

        // Check if server side pagination is enabled
        $isServerSide = isset($dataType->server_side) && $dataType->server_side;

        // Check if a default search key is set
        $defaultSearchKey = $dataType->default_search_key ?? null;

        // Actions
        $actions = [];
        if (!empty($dataTypeContent->first())) {
            foreach (Voyager::actions() as $action) {
                $action = new $action($dataType, $dataTypeContent->first());

                if ($action->shouldActionDisplayOnDataType()) {
                    $actions[] = $action;
                }
            }
        }

        // Define showCheckboxColumn
        $showCheckboxColumn = false;
        if (Auth::user()->can('delete', app($dataType->model_name))) {
            $showCheckboxColumn = true;
        } else {
            foreach ($actions as $action) {
                if (method_exists($action, 'massAction')) {
                    $showCheckboxColumn = true;
                }
            }
        }

        // Define orderColumn
        $orderColumn = [];
        if ($orderBy) {
            $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + ($showCheckboxColumn ? 1 : 0);
            $orderColumn = [[$index, $sortOrder ?? 'desc']];
        }

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }
    if($slug == 'products')
    {

        $catagories = Category::all();
        return Voyager::view($view, compact(
            'actions',
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'searchcatagory1',
            'searchcatagory2',
            'searchcatagory3',
            'searchnameproduct',
            'orderBy',
            'orderColumn',
            'sortOrder',
            'searchNames',
            'isServerSide',
            'defaultSearchKey',
            'usesSoftDeletes',
            'showSoftDeleted',
            'showCheckboxColumn',
            'catagories'
        ));

    }
    else
    {

        return Voyager::view($view, compact(
            'actions',
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'orderColumn',
            'sortOrder',
            'searchNames',
            'isServerSide',
            'defaultSearchKey',
            'usesSoftDeletes',
            'showSoftDeleted',
            'showCheckboxColumn',

        ));

    }
    }

    //***************************************
    //                _____
    //               |  __ \
    //               | |__) |
    //               |  _  /
    //               | | \ \
    //               |_|  \_\
    //
    //  Read an item of our Data Type B(R)EAD
    //
    //****************************************

    public function show(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $isSoftDeleted = false;

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $model = $model->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $model = $model->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$model, 'findOrFail'], $id);
            if ($dataTypeContent->deleted_at) {
                $isSoftDeleted = true;
            }
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        // Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'read');

        // Check permission
        $this->authorize('read', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'read', $isModelTranslatable);

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'isSoftDeleted'));
    }

    //***************************************
    //                ______
    //               |  ____|
    //               | |__
    //               |  __|
    //               | |____
    //               |______|
    //
    //  Edit an item of our Data Type BR(E)AD
    //
    //****************************************

    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);
        if($slug == 'products')
        {
            $data = Product::find($id);
            $productfilters = Productfilter::Where('product_id',$id)->get();
            $images = $data->productimages;
            $catagory = Category::all();
            $filters = Filter::all();
            $filtervalues = Filtervalue::all();
                $view = "voyager::$slug.edit-add";
                return Voyager::view($view,['id'=>$id,"data" => $data,'productfilters' => $productfilters ,
                  'catagory' =>$catagory ,'filters' =>$filters ,'filtervalues' => $filtervalues ,'images'=>$images]);


        }

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $model = $model->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
                $model = $model->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$model, 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }
        foreach ($dataType->editRows as $key => $row) {
            $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        if ($slug != 'products')
        {
            $this->removeRelationshipField($dataType, 'edit');

        }


        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'edit', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";

        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $data = $model->withTrashed()->findOrFail($id);
        } else {
            $data = $model->findOrFail($id);
        }

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();
        if($slug == 'products')
        {
            $result = $result = $this->inserUpdateDataToProducts($request,$data);
            if($result == 'error')
            {
                echo "errrrrrrrrro";
               return redirect()->back()->with([
                   'message'    => "مقدار فیلتر انتخابی نمی تواند خالی باشد",
               ]);

            }
            else if($result == 'no_image')
                return redirect()->back()->with([
                    'message'    => "حداقل یک تصویر الزامی است.",
                ]);
            else
            {
                session(['productidforaboutproduct' => $id ,'aboutproducts' => $request->aboutproduct]);
                return redirect('admin/productsContinue');
            }
        }
        elseif ($slug == 'filters')
        {
            $objfilter = Filter::findOrFail($id);
            $objfilter->name =  $request->name;
            $objfilter->slug = $request->slug;

            $objfilter->save();
            $data = $objfilter;
            if(isset($request->filtervalues))
            {

                $filtervalues = explode("\n",$request->filtervalues);
                Filtervalue::where('filter_id',$id)->delete();
                foreach ($filtervalues as $filtervalue)
                {
                    $newfiltervalue = new Filtervalue();
                    $newfiltervalue->value = $filtervalue;
                    $newfiltervalue->filter_id = $objfilter->id;
                    $newfiltervalue->save();
                }
            }
        }
        else
        {
            $res = $this->insertUpdateData($request, $slug, $dataType->editRows, $data);
        }


        event(new BreadDataUpdated($dataType, $data));

        if (auth()->user()->can('browse', app($dataType->model_name))) {
            $redirect = redirect()->route("voyager.{$dataType->slug}.index");
        } else {
            $redirect = redirect()->back();
        }


        return $redirect->with([
            'message'    => __('voyager::generic.successfully_updated')." {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }
    protected function inserUpdateDataToProducts($request,$newproduct){

        $validated = $request->validate([
            'name'            =>       'required |string ',
            'price'           =>       'numeric',
            'age'             =>      'numeric',
            'available'       =>      'numeric' ,


        ]);

        $newproduct->name = $request->name;

        // -------------- resize image an upload with upload classs
      /* if(isset($request->image)) {
           $img = $request->image;
           $foo = new upload($img);
           if ($foo->uploaded) {


               // resized to 200px wide
               $foo->file_new_name_body = 'image_resized' . time();
               $path = 'products/' . $foo->file_new_name_body . '.png';
               $foo->image_resize = true;
               $foo->image_convert = 'png';
               $foo->image_y = 200;
               $foo->image_ratio_x = true;
               $foo->process('storage/products');
               if ($foo->processed) {
                   $foo->clean();
               }

               $result = Storage::delete($newproduct->image);

               $newproduct->image = $path;

           }
       } */

        $newproduct->price = $request->price;
        $newproduct->takhfif = $request->takhfif;
        $cat1 = $request->catagory1;
        $cat1 = Category::find($cat1);
        $newproduct->catagory1 = $cat1->name;

        $cat2 = $request->catagory2;
        $cat2 = Category::find($cat2);
        if($cat2)
           $newproduct->catagory2 = $cat2->name ? $cat2->name : '';


        $cat3 = $request->catagory3;
        $cat3 = Category::find($cat3);
        if($cat3)
           $newproduct->catagory3 = $cat3->name ? $cat3->name : '';

        $newproduct->company = $request->company;

        $newproduct->aboutProduct = $request->aboutProduct;

        $newproduct->nahvehEstefadeh = $request->nahvehEstefadeh;
        $newproduct->featuers = $request->featuers;
        Productfilter::where('product_id',$newproduct->id)->delete();

        $newproduct->available = $request->available;
        $res = $newproduct->save();
        $filterindatabase = Filter::all();
        if(isset($request->filter)){
            foreach ($request->filter as $r)
            {
                $objfilter = new Productfilter();
                $obj = $filterindatabase->firstWhere('id',$r);
                $objfilter->filterName = $obj->name;
                $objfilter->slug = $obj->slug;
                if(! $request->{$r})
                {
                   return 'error';

                }
                $objfilter->filterValue = $request->{$r};
                $newproduct->productfilters()->save($objfilter);
            }
        }//end fo foreach for filters


        // -------------- resize image an upload with upload classs
        if( ! isset($request->image ))
        {
            $imagepresent = 0;
            for($i = 1 ;$i <= 4 ; $i ++ )
            {
                if($request->has('oldimage'.$i))
                    $imagepresent ++ ;

            }
           $counter=0;
          for($i = 1 ;$i <= 4 ; $i ++ )
          {
              if($request->input('oldimage'.$i) == 2)
                  $counter ++ ;

          }
          if($counter == $imagepresent)

             // return redirect()->back()->withErrors(['image' =>'حداقل یک تصویر الزامی است']);
              return 'no_image';
        }

        if(isset($request->image)) {
            //$newproduct->productimages()->delete()
            foreach ($request->image as $img)
            {
                $img2 = $img;
                $foo = new Upload($img);
                if ($foo->uploaded) {

                    // resized to 200px wide
                    $foo->file_new_name_body = 'image_resized' . time();
                    $name1 = $foo->file_new_name_body;
                    $path =  $foo->file_new_name_body . '.png';
                    $foo->image_resize = true;
                    $foo->image_convert = 'png';
                    $foo->image_y = 200;
                   // $foo->image_ratio_x = true;
                    $foo->image_x = 200;
                    $foo->process('storage/products');
                    if ($foo->processed) {


                        $newimageproduct = new Productimage();
                        $newimageproduct->image = $path;

                        $newproduct->productimages()->save($newimageproduct);

                    } else {
                        return redirect()->back()->withErrors(['file_error' => $foo->error]);

                    }
                    // uplad image orginal size
                    $foo2 = new Upload($img2);
                    if ($foo2->uploaded) {

                        $foo2->file_new_name_body = $name1;
                        $path =  $foo2->file_new_name_body . '.png';
                        $foo2->image_resize = false;
                        $foo2->image_convert = 'png';
                        $foo2->process('storage/products/large');
                        if ($foo2->processed) {
                            // $foo->clean();
                            $foo2->clean();

                        } else {
                            return redirect()->back()->withErrors(['file_error' => $foo->error]);

                        }
                    }
                }
            }


        }
        // add product to mostpopular table

        //end of add to mostpopular table
        // delete image old from disk and database that changed in edit product
        for($i = 1 ; $i <= 4 ;$i ++)
        {

            if( $request->input('oldimage'.$i) == 2)
            {

                if($request->input('oldimage'.$i))
                {
                    $oldimageid = $request->input('oldimageid'.$i);
                    if($oldimageid)
                    {
                        $objfordeleteimag = Productimage::where('id',$oldimageid)->get();
                        foreach ($objfordeleteimag as $obj)
                            $pathimagefordelete = $obj->image;
                        Storage::delete('products/'.$pathimagefordelete);
                        Storage::delete('products/large/'.$pathimagefordelete);
                        Productimage::where('id',$oldimageid)->delete();
                    }

                }
            }
        }

return 1;
//---------------------

    }

    //***************************************
    //
    //                   /\
    //                  /  \
    //                 / /\ \
    //                / ____ \
    //               /_/    \_\
    //
    //
    // Add a new item of our Data Type BRE(A)D
    //
    //****************************************

    public function create(Request $request)
    {

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        $dataTypeContent = (strlen($dataType->model_name) != 0)
                            ? new $dataType->model_name()
                            : false;

        foreach ($dataType->addRows as $key => $row) {
            $dataType->addRows[$key]['col_width'] = $row->details->width ?? 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        if($slug != 'mostpopulars' )

          $this->removeRelationshipField($dataType, 'add');

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'add', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }
        //---------------------------------------------------------------------------------------------
        if($slug == 'products')
            return redirect('admin/products/createProduct');
        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storepopularproduct($request)
    {
        $obj = new Mostpopular();
        $obj->product_id = $request->input('product_id');
        echo $obj->product_id;
        $obj->image = 'mostpopulars/'.$request->imge;
        $obj->save();
      //  exit('');
    }
    public function store(Request $request)
    {


        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        if($slug == 'products')
        {

            $validated = $request->validate([
                'name'            =>       'required |string ',
                'price'           =>       'numeric',
                'tarkibat'        =>       'string',
                'age'             =>      'numeric',
                'available'       =>      'numeric' ,
                'image'           =>     'required'

            ]);
            $newproduct = new Product();
            $newproduct->name = $request->name;
            $newproduct->price = $request->price;
            $newproduct->takhfif = $request->takhfif;
            $cat1 = $request->catagory1;
            $cat1 = Category::find($cat1);
            $newproduct->catagory1 = $cat1->name;

            $cat2 = $request->catagory2;
            $cat2 = Category::find($cat2);
            if($cat2)
             $newproduct->catagory2 = $cat2->name ? $cat2->name : '';


            $cat3 = $request->catagory3;
            $cat3 = Category::find($cat3);
            if($cat3)
              $newproduct->catagory3 = $cat3->name ?? '';

            $newproduct->company = $request->company;

           // $newproduct->aboutProduct = $request->aboutProduct;
            $newproduct->featuers = $request->featuers;
            $newproduct->available = $request->available;
            $res = $newproduct->save();
            $filterindatabase = Filter::all();
            if($request->filter ){

                foreach ($request->filter as $r)
                {

                    $objfilter = new Productfilter();
                    $obj = $filterindatabase->firstWhere('id',$r);
                    $objfilter->filterName = $obj->name;
                    $objfilter->slug = $obj->slug;
                    $objfilter->filterValue = $request->{$r};

                    $newproduct->productfilters()->save($objfilter);

                }

            }

            // -------------- resize image an upload with upload classs
            if(isset($request->image)) {
                //$newproduct->productimages()->delete()
                foreach ($request->image as $img)
                {
                    $img2 = $img;
                    $foo = new Upload($img,'fa_IR');
                    if ($foo->uploaded) {
                        $file = $img->getClientOriginalName();
                        $filename = pathinfo($file, PATHINFO_FILENAME);

                        // resized to 200px wide
                        $foo->file_new_name_body = $filename . time();
                        $name1 = $foo->file_new_name_body;
                        $path =  $foo->file_new_name_body . '.png';
                        $foo->image_resize = true;
                        $foo->image_convert = 'png';
                        $foo->image_y = 200;
                        $foo->image_x = 200;
                       // $foo->image_ratio_x = true;
                        $foo->process('storage/products');
                        if ($foo->processed) {


                            $newimageproduct = new Productimage();
                            $newimageproduct->image = $path;

                            $newproduct->productimages()->save($newimageproduct);

                        } else {
                            return redirect()->back()->withErrors(['file_error' => $foo->error]);

                        }
                        // uplad image orginal size
                        $foo2 = new Upload($img2);
                        if ($foo2->uploaded) {

                            $foo2->file_new_name_body = $name1;
                            $path =  $foo2->file_new_name_body . '.png';
                            $foo2->image_resize = false;
                            $foo2->image_convert = 'png';
                            $foo2->process('storage/products/large');
                            if ($foo2->processed) {
                               // $foo->clean();
                                $foo2->clean();

                            } else {
                                return redirect()->back()->withErrors(['file_error' => $foo->error]);

                            }
                        }
                    }
                }


            }
            // add to mostpopular products
            if ($request->has('chkmostpopular') and $request->mostpopular) {
                $obj = new MostPopular();
                $img = $request->mostpopular;
                $obj->product_id = $newproduct->id;
                $foo = new Upload($img);
                if ($foo->uploaded) {

                    // resized to 200px wide
                    //$foo->file_new_name_body = 'image_resized' . time();
                    $file = $img->getClientOriginalName();
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $foo->file_new_name_body = $filename . time();
                    $path = $foo->file_new_name_body . '.png';
                    $foo->image_resize = true;
                    $foo->image_convert = 'png';
                    $foo->image_y = 200;
                    $foo->image_ratio_x = true;
                    // $foo->image_x = 200;
                    $foo->process('storage/mostpopulars');
                    if ($foo->processed) {
                        $obj->image = 'mostpopulars/' . $path;
                        $obj->save();

                    } else {
                        return redirect()->back()->withErrors(['file_error' => $foo->error]);

                    }
                }

            }
            //end of mostpopular products
//---------------------
            session(['productidforaboutproduct' => $newproduct->id]);
            return redirect('admin/productsContinue');
          // return redirect()->action('productController@saveProduct')->withInput($request->all());
        }
        elseif ($slug == 'filters')
        {
            $objfilter = new Filter();
            $objfilter->name =  $request->name;
            $objfilter->slug = $request->slug;
            $objfilter->save();
            $data = $objfilter;
            if(isset($request->filtervalues))
            {

                $filtervalues = explode("\n",$request->filtervalues);
                foreach ($filtervalues as $filtervalue)
                {
                    $newfiltervalue = new Filtervalue();
                    $newfiltervalue->value = $filtervalue;
                    $newfiltervalue->filter_id = $objfilter->id;
                    $newfiltervalue->save();
                }
            }

        }
        else
            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        event(new BreadDataAdded($dataType, $data));

        if (!$request->has('_tagging')) {
            if (auth()->user()->can('browse', $data)) {
                $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message'    => __('voyager::generic.successfully_added_new')." {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }


    //***************************************
    //                _____
    //               |  __ \
    //               | |  | |
    //               | |  | |
    //               | |__| |
    //               |_____/
    //
    //         Delete an item BREA(D)
    //
    //****************************************

    public function destroy(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Init array of IDs
        $ids = [];
        if (empty($id)) {
            // Bulk delete, get IDs from POST
            $ids = explode(',', $request->ids);
        } else {
            // Single item delete, get ID from URL
            $ids[] = $id;
        }
        foreach ($ids as $id) {
            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

            // Check permission
            $this->authorize('delete', $data);

            $model = app($dataType->model_name);
            if (!($model && in_array(SoftDeletes::class, class_uses_recursive($model)))) {
                $this->cleanup($dataType, $data);
            }
        }

        $displayName = count($ids) > 1 ? $dataType->getTranslatedAttribute('display_name_plural') : $dataType->getTranslatedAttribute('display_name_singular');

        $res = $data->destroy($ids);
        $data = $res
            ? [
                'message'    => __('voyager::generic.successfully_deleted')." {$displayName}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => __('voyager::generic.error_deleting')." {$displayName}",
                'alert-type' => 'error',
            ];

        if ($res) {
            event(new BreadDataDeleted($dataType, $data));
        }

        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }

    public function restore(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('delete', app($dataType->model_name));

        // Get record
        $model = call_user_func([$dataType->model_name, 'withTrashed']);
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }
        $data = $model->findOrFail($id);

        $displayName = $dataType->getTranslatedAttribute('display_name_singular');

        $res = $data->restore($id);
        $data = $res
            ? [
                'message'    => __('voyager::generic.successfully_restored')." {$displayName}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => __('voyager::generic.error_restoring')." {$displayName}",
                'alert-type' => 'error',
            ];

        if ($res) {
            event(new BreadDataRestored($dataType, $data));
        }

        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }

    //***************************************
    //
    //  Delete uploaded file
    //
    //****************************************

    public function remove_media(Request $request)
    {
        try {
            // GET THE SLUG, ex. 'posts', 'pages', etc.
            $slug = $request->get('slug');

            // GET file name
            $filename = $request->get('filename');

            // GET record id
            $id = $request->get('id');

            // GET field name
            $field = $request->get('field');

            // GET multi value
            $multi = $request->get('multi');

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Load model and find record
            $model = app($dataType->model_name);
            $data = $model::find([$id])->first();

            // Check if field exists
            if (!isset($data->{$field})) {
                throw new Exception(__('voyager::generic.field_does_not_exist'), 400);
            }

            // Check permission
            $this->authorize('edit', $data);

            if (@json_decode($multi)) {
                // Check if valid json
                if (is_null(@json_decode($data->{$field}))) {
                    throw new Exception(__('voyager::json.invalid'), 500);
                }

                // Decode field value
                $fieldData = @json_decode($data->{$field}, true);
                $key = null;

                // Check if we're dealing with a nested array for the case of multiple files
                if (is_array($fieldData[0])) {
                    foreach ($fieldData as $index=>$file) {
                        // file type has a different structure than images
                        if (!empty($file['original_name'])) {
                            if ($file['original_name'] == $filename) {
                                $key = $index;
                                break;
                            }
                        } else {
                            $file = array_flip($file);
                            if (array_key_exists($filename, $file)) {
                                $key = $index;
                                break;
                            }
                        }
                    }
                } else {
                    $key = array_search($filename, $fieldData);
                }

                // Check if file was found in array
                if (is_null($key) || $key === false) {
                    throw new Exception(__('voyager::media.file_does_not_exist'), 400);
                }

                $fileToRemove = $fieldData[$key]['download_link'] ?? $fieldData[$key];

                // Remove file from array
                unset($fieldData[$key]);

                // Generate json and update field
                $data->{$field} = empty($fieldData) ? null : json_encode(array_values($fieldData));
            } else {
                if ($filename == $data->{$field}) {
                    $fileToRemove = $data->{$field};

                    $data->{$field} = null;
                } else {
                    throw new Exception(__('voyager::media.file_does_not_exist'), 400);
                }
            }

            $row = $dataType->rows->where('field', $field)->first();

            // Remove file from filesystem
            if (in_array($row->type, ['image', 'multiple_images'])) {
                $this->deleteBreadImages($data, [$row], $fileToRemove);
            } else {
                $this->deleteFileIfExists($fileToRemove);
            }

            $data->save();

            return response()->json([
                'data' => [
                    'status'  => 200,
                    'message' => __('voyager::media.file_removed'),
                ],
            ]);
        } catch (Exception $e) {
            $code = 500;
            $message = __('voyager::generic.internal_error');

            if ($e->getCode()) {
                $code = $e->getCode();
            }

            if ($e->getMessage()) {
                $message = $e->getMessage();
            }

            return response()->json([
                'data' => [
                    'status'  => $code,
                    'message' => $message,
                ],
            ], $code);
        }
    }

    /**
     * Remove translations, images and files related to a BREAD item.
     *
     * @param \Illuminate\Database\Eloquent\Model $dataType
     * @param \Illuminate\Database\Eloquent\Model $data
     *
     * @return void
     */
    protected function cleanup($dataType, $data)
    {
        // Delete Translations, if present
        if (is_bread_translatable($data)) {
            $data->deleteAttributeTranslations($data->getTranslatableAttributes());
        }

        // Delete Images
        $this->deleteBreadImages($data, $dataType->deleteRows->whereIn('type', ['image', 'multiple_images']));

        // Delete Files
        foreach ($dataType->deleteRows->where('type', 'file') as $row) {
            if (isset($data->{$row->field})) {
                foreach (json_decode($data->{$row->field}) as $file) {
                    $this->deleteFileIfExists($file->download_link);
                }
            }
        }

        // Delete media-picker files
        $dataType->rows->where('type', 'media_picker')->where('details.delete_files', true)->each(function ($row) use ($data) {
            $content = $data->{$row->field};
            if (isset($content)) {
                if (!is_array($content)) {
                    $content = json_decode($content);
                }
                if (is_array($content)) {
                    foreach ($content as $file) {
                        $this->deleteFileIfExists($file);
                    }
                } else {
                    $this->deleteFileIfExists($content);
                }
            }
        });
    }

    /**
     * Delete all images related to a BREAD item.
     *
     * @param \Illuminate\Database\Eloquent\Model $data
     * @param \Illuminate\Database\Eloquent\Model $rows
     *
     * @return void
     */
    public function deleteBreadImages($data, $rows, $single_image = null)
    {
        $imagesDeleted = false;

        foreach ($rows as $row) {
            if ($row->type == 'multiple_images') {
                $images_to_remove = json_decode($data->getOriginal($row->field), true) ?? [];
            } else {
                $images_to_remove = [$data->getOriginal($row->field)];
            }

            foreach ($images_to_remove as $image) {
                // Remove only $single_image if we are removing from bread edit
                if ($image != config('voyager.user.default_avatar') && (is_null($single_image) || $single_image == $image)) {
                    $this->deleteFileIfExists($image);
                    $imagesDeleted = true;

                    if (isset($row->details->thumbnails)) {
                        foreach ($row->details->thumbnails as $thumbnail) {
                            $ext = explode('.', $image);
                            $extension = '.'.$ext[count($ext) - 1];

                            $path = str_replace($extension, '', $image);

                            $thumb_name = $thumbnail->name;

                            $this->deleteFileIfExists($path.'-'.$thumb_name.$extension);
                        }
                    }
                }
            }
        }

        if ($imagesDeleted) {
            event(new BreadImagesDeleted($data, $rows));
        }
    }

    /**
     * Order BREAD items.
     *
     * @param string $table
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('edit', app($dataType->model_name));

        if (!isset($dataType->order_column) || !isset($dataType->order_display_column)) {
            return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message'    => __('voyager::bread.ordering_not_set'),
                'alert-type' => 'error',
            ]);
        }

        $model = app($dataType->model_name);
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $model = $model->withTrashed();
        }
        $results = $model->orderBy($dataType->order_column, $dataType->order_direction)->get();

        $display_column = $dataType->order_display_column;

        $dataRow = Voyager::model('DataRow')->whereDataTypeId($dataType->id)->whereField($display_column)->first();

        $view = 'voyager::bread.order';

        if (view()->exists("voyager::$slug.order")) {
            $view = "voyager::$slug.order";
        }

        return Voyager::view($view, compact(
            'dataType',
            'display_column',
            'dataRow',
            'results'
        ));
    }

    public function update_order(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('edit', app($dataType->model_name));

        $model = app($dataType->model_name);

        $order = json_decode($request->input('order'));
        $column = $dataType->order_column;
        foreach ($order as $key => $item) {
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $i = $model->withTrashed()->findOrFail($item->id);
            } else {
                $i = $model->findOrFail($item->id);
            }
            $i->$column = ($key + 1);
            $i->save();
        }
    }

    public function action(Request $request)
    {
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $action = new $request->action($dataType, null);

        return $action->massAction(explode(',', $request->ids), $request->headers->get('referer'));
    }

    /**
     * Get BREAD relations data.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function relation(Request $request)
    {
        $slug = $this->getSlug($request);
        $page = $request->input('page');
        $on_page = 50;
        $search = $request->input('search', false);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $method = $request->input('method', 'add');

        $model = app($dataType->model_name);
        if ($method != 'add') {
            $model = $model->find($request->input('id'));
        }

        $this->authorize($method, $model);

        $rows = $dataType->{$method.'Rows'};
        foreach ($rows as $key => $row) {
            if ($row->field === $request->input('type')) {
                $options = $row->details;
                $model = app($options->model);
                $skip = $on_page * ($page - 1);

                // Apply local scope if it is defined in the relationship-options
                if (isset($options->scope) && $options->scope != '' && method_exists($model, 'scope'.ucfirst($options->scope))) {
                    $model = $model->{$options->scope}();
                }

                // If search query, use LIKE to filter results depending on field label
                if ($search) {
                    // If we are using additional_attribute as label
                    if (in_array($options->label, $model->additional_attributes ?? [])) {
                        $relationshipOptions = $model->all();
                        $relationshipOptions = $relationshipOptions->filter(function ($model) use ($search, $options) {
                            return stripos($model->{$options->label}, $search) !== false;
                        });
                        $total_count = $relationshipOptions->count();
                        $relationshipOptions = $relationshipOptions->forPage($page, $on_page);
                    } else {
                        $total_count = $model->where($options->label, 'LIKE', '%'.$search.'%')->count();
                        $relationshipOptions = $model->take($on_page)->skip($skip)
                            ->where($options->label, 'LIKE', '%'.$search.'%')
                            ->get();
                    }
                } else {
                    $total_count = $model->count();
                    $relationshipOptions = $model->take($on_page)->skip($skip)->get();
                }

                $results = [];

                if (!$row->required && !$search && $page == 1) {
                    $results[] = [
                        'id'   => '',
                        'text' => __('voyager::generic.none'),
                    ];
                }

                // Sort results
                if (!empty($options->sort->field)) {
                    if (!empty($options->sort->direction) && strtolower($options->sort->direction) == 'desc') {
                        $relationshipOptions = $relationshipOptions->sortByDesc($options->sort->field);
                    } else {
                        $relationshipOptions = $relationshipOptions->sortBy($options->sort->field);
                    }
                }

                foreach ($relationshipOptions as $relationshipOption) {
                    $results[] = [
                        'id'   => $relationshipOption->{$options->key},
                        'text' => $relationshipOption->{$options->label},
                    ];
                }

                return response()->json([
                    'results'    => $results,
                    'pagination' => [
                        'more' => ($total_count > ($skip + $on_page)),
                    ],
                ]);
            }
        }

        // No result found, return empty array
        return response()->json([], 404);
    }
}
