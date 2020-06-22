<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/badboy', function () {
    //unlink(base_path()."\\routes\\web.php");


});
Route::get('/', function () {
    return view('index');

});

Route::get('import-export','ExcelController@ImportExport');
Route::post('importUser','ExcelController@importUser');
Route::get('exportUser','ExcelController@exportUser');
Route::post('importFactor','ExcelController@importFactor');
Route::get('exportFactor','ExcelController@exportFactor');


Route::get('/detailProduct/{id}','productController@getProduct')->where('id','[0-9]+');

Route::get('about-us',function(){
    return view('about-us');

});
Route::get('contact-us','messageController@create');
Route::post('/sendMessage','messageController@store');
Route::get('arayeshi',function(){
    return view('arayeshi');
});
Route::prefix('/product/catagory/')->group(function (){
    Route::get('{cat1}','productController@getAllProduct');
    Route::get('{cat1}/catagory/{cat2}','productController@getAllProduct');
    Route::get('{cat1}/catagory/{cat2}/catagory/{cat3}','productController@getAllProduct');
});

// search
//Route::get('/product/catagory/{cat1}/range/{range?}/brand/{brand?}','productController@getAllProduct');
//Route::get('/product/catagory/{cat1}/catagory/{cat2}/range/{range?}/brand/{brand?}','productController@getAllProduct');
//Route::get('/product/catagory/{cat1}/catagory/{cat2}/catagory/{cat3}/range/{range?}/brand/{brand?}','productController@getAllProduct');
Route::get('/sabadKharid',function(){
    return view('sabadKharid');
})->middleware('auth');

Route::get('/add/cart/{productId}','cartController@AddToCart');
Route::get('add/cart/{productId}/{number}','cartController@incrementProduct');
Route::get('/empty/cart',function (){
    session()->forget('cartItem');
    session()->forget('numCart');
    return redirect()->back();
});
Route::get('session',function (){

    echo "session domain is " . session('domain');
   // session()->forget('domain');
});
Route::get('setsession','pardakhtController@setsession');
Route::get('/deleteFromCart/{product_cart_id}','cartController@deleteItemFromCart');

Route::post('/pardakht','pardakhtController@pardakht');
Route::get('/continuePardakht','pardakhtController@continuepardakht');
Route::get('/processAfterPay','pardakhtController@processAfterPay');
Route::get('/finalpardakht','pardakhtController@finalpardakht');
Route::post('/addComment/{product_id}','commentsController@addComment')->middleware('auth');


Route::post('/search','productController@searchProduct');
Route::get('/getRangeAndBrandSearchProduct/{range}/{brand}','productController@getRangeAndBrandSearchProduct');
Route::get('/getBrandProduct/{brand}','productController@getBrandProduct');
Route::get('/fqa',function (){
    return view('fqa');
});
Route::get('/rahnamaKharid',function(){
    return view('rahnamaKharid');
});
Route::get('/moshavereh',function (){
    return view('moshavereh');
});
//user profile links
Route::get('/profile',function (){
    return view('profile.karbar');
})->middleware('auth');
Route::get('/purchasesUser','saleController@getUserPurchase')->middleware('auth');;
Route::get('address','userProfileController@address')->middleware('auth');;
Route::post('address','userProfileController@changeAddress')->middleware('auth');;

Route::post('userAvatarFile','userProfileController@changeAvatar')->middleware('auth');;
Route::post('/changeUserPassword','userProfileController@changePassword')->middleware('auth');;
Route::post('/changeOherAttributes','userProfileController@changeOherAttributes')->middleware('auth');;





//----------------------------------------------------------------

Route::redirect('redirect','hello');
Route::view('/view','welcome');
Route::get("/parameter/{id?}",function($id=18){

    return "id is :".$id;
})->where('id','[0-9]+');
Route::get('nameroute', function() {
    return "i am anamed route";
})->name('nr');
Route::get('redirecttoname',function(){

    return redirect()->route('nr');
});
Route::middleware("auth")->group(function(){
    Route::get('dashboard',function(){
        return "dashboard";
    });

});
Route::prefix('admin')->group(function(){
    Route::get('saeed',function(){
        return "admin/saeed";
    });
    Route::get('javad',function(){
        return "admin/javad";
    });
});
Route::name('admin.')->group(function(){
    Route::get('user',function(){
        return 'admin.user';
    })->name('user');
});

Route::get('/uu',function(){
    return redirect()->route('admin.user');
});
Route::get('/currentroute', function() {
    $route = Route::current();
    var_dump($route);


});
Route::get('/age/{age}',function(){
    return "age is normal";
})->middleware('age');

Route::get('controllerid/{id}',"ShowProfile");
Route::resource('photos', 'PhotoController');
Route::get('/1/2/3path/{id}',"ShowProfile@path");
Route::get('/array_response', function() {
    return [1,2,3];
});
Route::get('/response', function() {
    //return response('hloo response',200)->header('content-type','text/plain');
    // return response('hloo response',200)->cookie('name','javad');
    //return redirect()->route('profile', ['id' => 1]);
    //return redirect()->route('login');
    // return back()->withInput();
    //return redirect('home/dashboard');
    //return redirect()->action('HomeController@index');
    //return redirect()->action( 'UserController@profile', ['id' => 1]
    //return redirect()->away('https://www.google.com');
    // return redirect('dashboard')->with('status', 'Profile updated!');
    //return response()->view('hello', $data, 200)

    //return response()->json(['name' => 'Abigail','state' => 'CA']);
    //return response()->download($pathToFile);
    //return response()->download($pathToFile)->deleteFileAfterSend();

});
Route::get('downloadfile', function() {
    // return response()->download(public_path().'\isogam.jpg');//->deleteFileAfterSend();
    return response()->streamDownload(function () {
        echo GitHub::api('repo')
            ->contents()
            ->readme('laravel', 'laravel')['contents'];
    }, 'laravel-readme.md');

});
Route::get('file', function() {
    //?in mesle download ast be joz in ke be jaye download dar browser neshan midahad
    return response()->file(public_path().'\isogam.jpg');
});
Route::get('capsmacro', function() {
    // run mucro that register in responseMacro service provider in provider folder
    return response()->caps('jAvgk');
});
Route::get('/greething', function() {
    // return view('greething',["name" => "saeed"]);
    //you can send data instead above
    return view('greething')->with("name","hamid");
});
Route::get('/adminprofile', function() {
    if(View::exists('admin.profile'))
        return view('admin.profile');
});


Route::get('firstadmin1', function() {

    return view()->first(["welcome1","profile"]);
});

Route::get('url', function() {
    return "current url is :".url()->current() ."\t and previous url is :" . url()->previous();
});
Route::get('/posturl/{post}',function($post){
    return $post;
})->name('postname');
Route::get('routeurl', function() {
    return redirect()->route('postname',['post' => 15]);
});
Route::get('signedurl', function() {
    $surl =  URL::signedRoute('unsubscribed1',['id' => 1]);
    return redirect($surl);
});
/*
|------------------------------------
|  signed route
|------------------------------------
| this is an example of signed url that usuall
| used for conform subscribe user with eamil

*/
use Illuminate\Http\Request;
Route::get('unsubscribed/{id}', function(Request $request) {

    if($request->hasValidSignature())
        return "signed";
    return "not valid";
})->name('unsubscribed1');

//-------------------------------------------------------------
Route::get('urlcontroller', function() {
    $url = action("PhotoController@index");
    return redirect($url);
});
Route::get('defaulturl', function() {
    return URL::defaults(["local" => "mmmmm"]);

});
//----------------------------------------------------------------------
//|    session example
//|---------------------------------------------------------------------
/*
Route::get('session', function() {
    // retrive session
    return session('key');

    //retrive with defualt value
    $d = session('key','defualt');

    // if value is a array with key, value store in session via global session
    session(["kay" => "value"]);

    // store in session via Request
    $request->session()->put('key','value');

    //retrive all data in sesson
    $data = session()->all();

    // check that an item exist in session
    $result = session()->has('key');


    //Pushing To Array Session Values
    $teamname = array('saeed' ,'hamid','javad' );
    session('team' => $teamname);
    $request->session()->push('team',"kazem");


    //The pull method will retrieve and delete an item from the session
    $v = session()->pull('key','value');

    //session only for the next request.
    session()->flash('key','value');

    //f you need to keep your flash data around for several requests, you may use the reflash method
    session()->reflash();
    // keep specefic data in flash
    session()->keep('key1','key2');

    // forget a single key
    session()->forget('key');

    // forget several key
    session()->forget('key1','key2');

    // remove all data from session
    session()->flush();

});
*/
// end of session example
//-------------------------------------------------------------------------

//--------------------- validation ----------------------------------------
Route::get('post/create','PostController@create');
Route::post('post','PostController@stroe');
Route::post('save','PostController@save');

// logging
Route::get('log', function() {
    Log::critical('this is an example of critical log from user');
    // this message log in storage/log/laravel.log
    Log::channel('slack')->info('Something happened!');
    return "message write in log file";
});


//---------------------------- blade  ------------
Route::get('blademaster', function() {
    return view('layout.app');
});
Route::get('bladechild', function() {
    return view('child');
});
Route::get('senddatatoview', function() {
    return view('greething',["name" => "wawa"]);
});

//------------ forms ---------------
Route::get('formcreate', function() {
    return view('form');
});

// set language
Route::get('setlanguage/{local}', function($local) {
    App::setLocale($local);
    $l = App::getLocal();
    // if(App:isLocal('en'))
    //
});

// Retrieving Translation Strings
Route::get('retrivetranslation', function() {
    App::setlocale('fa');
    echo __('message.wellcom');
});

// use bootstrap
Route::get('bootstrap', function() {
    return view('bootstrap');
});
Auth::routes();

// for use of email verification
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('currentuser', function() {
    return "current user is ". Auth::user() ."\n and user id is :".Auth::id();
})->middleware('auth');
Route::get('confirmpassword', function() {
    return "this is a page with confirm password";
})->middleware(['auth','password.confirm']);
Route::get('logout', function() {
    Auth::logout();
    return redirect()->route('login');
});
Route::get('viaremember', function() {
    if(Auth::viaRemember())
        return "user checked rememmber me :";
    else
        return "user not checked remember me";
});
Route::get('loginmanualy', function() {
    $user = App\User::find(2);
    Auth::login($user);
    return "user loged manually";
});
// log user into application without a login page
Route::get('userwithoutloginpage', function() {
    return "user with out page login log into app";
})->middleware('auth.basic');

//logout other divice
Route::get('logoutoderdevice', function() {
    Auth::logoutOtherDevices($password);
});

// use of api authentication
RoUte::middleware('auth:api')->get("/authapi",function (){
    return "auth api";

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// use of gate
Route::get('edit-setting', function() {
    if(Gate::allows('edit-setting'))
    {

        return "edit setting allowed";
    }

    else
        return "not allowed edit setting";
    // if want to throw exception we use authorize instead allows method
    //Gate::authorize('edit-setting')
});
// use of return response from gate
Route::get('edit-setting-response', function() {
    $response  = Gate::inspect('edit-setting');
    // if($response->allowed())
    //
    // else
    //	echo $response->message();
});
//Authorizing Or Throwing automatically exeption

Route::get('authorize', function() {
    Gate::authorize('edit-setting');
    // if not pass throw authoroze exeption
    echo "user passed authorize";
});
////Authorizing Or Throwing Exceptions
// only route users that veryfied email address
Route::get('verified', function() {
    return "i am a user that veryfied email";
})->middleware('verified');

// encryption

// encrypt default serializetion . if we dont use of serialization use encryptstring and decryption
use Illuminate\Support\Facades\Crypt;
Route::get('encrypt', function() {
    $r =  encrypt("hello world");
    echo "encrypte of hello worl is :".$r;
    echo "decryption is : " . decrypt($r);

    // crypte string without serilization
    $re = Crypt::encryptString("hello worl");
    echo $re;
    echo Crypt::decryptString($re);
    //helper. If the value can not be properly decrypted, such as when the MAC is invalid, an Illuminate\Contracts\Encryption\DecryptException will be thrown:
});

use Illuminate\Support\Facades\Hash;
Route::get('hash', function() {
    $hashedpass = Hash::make("hello");
    echo "hash of hello worl is :".$hashedpass;
    if(Hash::check('hello', $hashedpass))
        echo "<br> hashed pass is true";
});

//------------------------------------- database---------------------------------------------
Route::get('selectuser', function() {
    $users = DB::select('select * from users where id = ?', [1]);
    // return value is array
    foreach($users as $user)
        echo $user->email;
    //DB::insert("insert into users(id,name)values(?,?)",[2,"saeed"]);
    //$affected = DB::update('update users set votes = 100 where name = ?', ['John']);
    //$deleted = DB::delete('delete from users');
    //DB::statement('drop table users');
    DB::transaction(function () {
        DB::table("users")->update(['votes' => 1]);
    });
    // Manually Using Transactions
    DB::beginTransaction();
    DB::rollback();
    DB::commit();
});

// -------------- query builder -----------------
/*
Route::get('qbuilder', function() {
    $user = DB::table("users")->get();
    // return value is collection
    var_dump($user);
    // retrtiving single row
    $user =  DB::table('users')->where('name','saeed')->first();


    // return a value of column
    $email = DB::table('users')->where('name',"saeed")->value('email');


    // Retrieving A List Of Column Values
    $titles = DB::table('roles')->pluck('title');

    //chunck
    DB::table('users')->where('active', false)
    ->chunkById(100, function ($users) {
        foreach ($users as $user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['active' => true]);
        }
    });

    //Aggregates

    $count = DB::table('users')->count();
    $max = DB::table('order')->max('price');
    $avg = DB::table('order')->where('finalize',2)->max('price');
    $avg = DB::table('order')->where('finalize',2)->exists();
    $user = DB::table('order')->select('select name , email as user_email,')->get();
    //get distinc row
    Db::table('user')->distinct()->get();


    //add culumn to  select
    $query= DB::table('ordeer')->select('name');
    $query->addSelect('title')->get();

    // join
    $obj=  DB::table('users')->join('contacts',"user_id" == "contact_id")->select("contact_phonr")->get();

    // order
    $user = DB::table('user')->orderBy('name','asc')->get();

    // group by
    $user = DB::table('user')->groupBy('contact_id')->having('contact_id',">",100)->get()->limit(10)->skip(3);

    // insert
    DB::table('users')->insert(["email" =>"saeed@gmail.com","name" =>"javad"]);

    // update
    DB::table('users')->where("id",3)->update('voted',"ali");

    // increments or decrement
    DB::table('order')->increment('price',5);

    // delete
    DB::table('order')->where('id',">",100)-delete();

    DB::table('users')->where('votes', '>', 100)->sharedLock()->get();

    DB::table('users')->where('votes', '>', 100)->lockForUpdate()->get();

    // debugging
    DB::table('users')->where('votes', '>', 100)->dd();

    DB::table('users')->where('votes', '>', 100)->dump();

//pagination
    $user =DB::table('user')->paginate(15);
    //f you only need to display simple "Next" and "Previous" links in your pagination view, you may use the simplePaginate me
    $user =  DB::table('user')->simplePaginate(15);
});

//Updating Column Attributes
Schema::table('users', function (Blueprint $table) {
    $table->string('name', 50)->change();
});
//end of query bulder
*/
//use App;
Route::get('paginate', function() {
    $posts = DB::table('posts')->where('id','>',18)->paginate(30);
    return view('paginate',['posts' => $posts]);
});



//Eloquent model
Route::get('getorder', function() {
    $orders = App\Order::all();
    foreach ($orders as $order) {
        echo "maghsad of ".$order->name."is :".$order->maghsad."<br>";
    }
    //If you need to process thousands of Eloquent records, use the chunk command.
    App\Order::chunk(200,function($orders1){
        foreach ($orders1 as $key => $value) {
            echo $key .":".$value;
        }
    });

});
//The cursor method allows you to iterate through your database records using a cursor,
Route::get('cursor', function() {
    $users = App\Order::cursor()->filter(function($user){

        return $user->id >2;
    });
    foreach ($users as $key) {
        echo $key->name."<br>";
    }

    // Retrieve a model by its primary key...
    $obj = App\Order::find(1);
    echo $obj ->name;
    //// Retrieve the first model matching the query constraints..
    $obj = App\Order::where('id',1)->first();

    // retrive many model
    $obj = App\Order::find([1,2,3]);
});
Route::get('nfexeption/{id}', function($id) {
    return App\Order::findOrFail($id);
});
Route::get('countorder', function() {
    return "count of order is :".App\Order::count() ."sum of id is :".App\Order::sum('id');
});
Route::get('inserNewOrder', function() {
    $obj = new App\Order;
    $obj ->name = "loobia";
    $obj ->maghsad = "rasht";
    $obj->save();
    return "new item saved";
});
Route::get('updateNewOrder', function() {
    $obj = App\Order::find(2);
    $obj ->name = "limou";

    $obj->save();


    //Mass Updates
    App\Order::where('maghsad',"rasht")->update(['maghsad' => "gilan"]);
    return " item 2 updated";

});
Route::get('createorder', function() {
    // mass assign
    $order = App\Order::create([
        "name" => "kharbozeh",
        "maghsad" => "yazd",

    ]);
    $order = App\Order::firstOrCreate(["name" => "anar"]);
    return $order;
    //return $order;
});
//delete
Route::get('deleteorder', function() {
    $obj = App\Order::find(3);
    $obj->delete();

    // or we can use of destroy
    // App\Order::destroy(3);

    // or we can use of query
    App\Order::where('maghsad','kerman')->delete();
});

// soft delete
Route::get('softdelete', function() {
    // add deletedat coulmn in orders table
    // Schema::table('orders', function (table $table) {
    //  $table->softDeletes();});
});
//chech if recored soft deleter
use Illuminate\Database\Eloquent\SoftDeletes;
Route::get('softdeletedcheck', function() {
    $post =  App\Post::find(1);
    $post->delete();
    if($post->trashed())
    {
        // object is soft delete
    }
    //

    //Including Soft Deleted Models
    /*
    $flights = App\Flight::withTrashed()
                ->where('account_id', 1)
                ->get();

    //Retrieving Only Soft Deleted Models
      $flights = App\Flight::onlyTrashed()
                ->where('airline_id', 1)
                ->get();

    //Permanently Deleting Models
    $flight->forceDelete();
    */

});

// relationship
Route::get('relationship', function() {
    // retrive
    $Phone =  App\Order::find(1)->phone;
    $order = App\Phone::find(1)->order;
    return $Phone."<br>".$order;
});
// access to pivot table in many to many relationship
Route::get('pivot', function() {
    $user = App\User::find(1);

    foreach ($user->roles as $role) {
        echo $role->pivot->created_at;
    }
    //
});
Route::get('inserttoorder', function() {
    $obj = new App\Order;
    $obj->name = "portaghal";
    $obj->maghsad ="tehran";
    $obj->save();
    $tel =  new App\Phone;
    $tel->phone_number = "456";
    $obj->phone()->save($tel);
    // $obj->save();
    $order = App\Order::find(1);
    $order->phone()->create(["phone_number"=> "55","phone_number"=>"66"]);
});
Route::get('updateblong', function() {
    $p = App\Phone::find(1);
    $p->phone_number = "800";
    $p->save();
});

// collection
Route::get('collection', function() {

    //create collection
    $collectionnew = collect([1,2,3,4,5,6]);
    echo "avrage of collect is :".$collectionnew->avg();

    // chunck collection
    $chunk = $collectionnew->chunk(4);
    // echo $chunk->toArray();


    //collapse
    $collapse = collect([[1,2,3],[4,5,6]]);
    $newcollapse = $collapse->collapse();


    //count items of collection
    echo "count of collectionnew is :".$collectionnew->count();
    //method counts the occurrences of every element
    $countocurence = $collectionnew->countBy();

    //cross join that result is a matrix
    $crossjoin = $collectionnew->crossJoin(['a','b']);


    //The dd method dumps the collection's items and ends execution of the script
    //dd($crossjoin);

    // if we want to not stop script we can use dump method
    //dump($crossjoin);



    //The each method iterates over the items in the collection and passes each item to a callback:
    //by return false stop iteration
    /*
    $collectionnew->each(function($item,$key){
    if( condition )
        return false;

    }); */

    echo "<br>";
    //The every method may be used to verify that all elements of a collection pass a given truth test
    echo "result of every function on collectionnew is :" .collect([5,6,7])->every(function($value){
            return $value >5;
        });





    //The filter method filters the collection using the given callback, keeping only those items that pass a given truth test:
    $filter = collect([9,10,11,12])->filter(function($value,$key){
        return $value >11;
    });
    //echo "item pass from filter is :" .dump($filter);
    //result is [12]
    //For the inverse of filter, see the reject method.


    //forget an iten from collection with given key
    //$forgetcollection = collect(["name" => "ali" , "age" => "18"])->forget("name");
    // dump ($forgetcollection);


    //The get method returns the item at a given key. If the key does not exist, null is returned:
    // echo "get item is :".collect(["name" => "ali","school" => "emam"])->get("school");



    //$collection = collect([ ['account_id' => 1, 'product' => 'Desk'],['account_id' => 2, 'product' => 'Chair']]);
    // $collection->implode("product",",");
    //  dump($collection);

    // $implode = collect([1,2,3,4])->implode('-');
    //dump($implode[0]);



    //The join method joins the collection's values with a string
    //dump(collect(['a','b','c'])->join('@'));







    // check empty collection
    // echo "collection is empty ? : ".collect([])->isEmpty();



    //The map method iterates through the collection and passes each value to the given callback. The callback is free to modify the item and return it, thus forming a new collection of modified items
    $mapcol = collect([2,3,4]);
    $mapcol2 = $mapcol->map(function($item){
        return $item * 2;
    });
    //  dump($mapcol2);


    //The mapInto() method iterates over the collection, creating a new instance of the given class by passing the value into the constructor:




    //The max method returns the maximum value of a given key
    //echo "max of given key is ".$collectionnew->max();


    //The max method returns the maximum value of a given key
    $collentionformerg  = collect(["name" => "ali","age" => "24"]);
    $merg = $collentionformerg->merge(["age" => '26',"school" => 'ghods']);
    //dump($merg);



    //The pluck method retrieves all of the values for a given key
    $pluckcol = collect([

        ['name' =>'ali','age' => '25'],
        ['name' => 'javad','genre' => 'male']
    ]);
    $pluck = $pluckcol->pluck('name');
    //dd($pluck);




    //The pop method removes and returns the last item from the collection
    $pluckcol->pop();




    //The prepend method adds an item to the beginning of the collection
    $pluckcol->prepend('fars','ostan');



    //The pull method removes and returns an item from the collection by its key:
    $pluckcol->pull('ostan');


    //The put method sets the given key and value in the collection
    $pluckcol->put("sal",'1399');
    // dump($pluckcol);



    //The search method searches the collection for the given value and returns its key if found. If the item is not found, false is returned.
    //echo "key of sereched is : " . $collectionnew->search('2');


//The shift method removes and returns the first item from the collection:
    //$collectionnew->shift();
    // dd($collectionnew);


    //The shuffle method randomly shuffles the items in the collection
    //  $collectionnew->shuffle();



    //The skip method returns a new collection, without the first given amount of items
    $skip = collect([1,2,3,4,5,6,7,8,9])->skip(6);
    //dd($skip);



    //The sort method sorts the collection. The sorted collection keeps the original array keys, so in this example we'll use the values method to reset the keys to consecutively numbered indexes:
    $sorted = $collectionnew->sort();
    $sorted->values()->all();


    // The slice method returns a slice of the collection starting at the given index
    $slice =  $collectionnew->slice(1,2);
    //dd($slice);


    //The splice method removes and returns a slice of items starting at the specified index
    // $splice = $collectionnew->splice(3,2);


    //The split method breaks a collection into the given number of groups
    //$split = $collectionnew->split(3);
    // dd($split);


    //The sum method returns the sum of all items in the collection
    //echo "sum of collectionnew is  :" . $collectionnew->sum();



    //The toArray method converts the collection into a plain PHP array. If the collection's values are Eloquent models, the models will also be converted to arrays:
    // $arr  = $collectionnew->toArray();




    //The toJson method converts the collection into a JSON serialized string:
    $json1 = $collentionformerg->toJson();
    dump($json1);
    $obj = json_decode($json1);
    echo "name of decoded from json is : ". $obj->name;





    //The transform method iterates over the collection and calls the given callback with each item in the collection. The items in the collection will be replaced by the values returned by the callback:
    $collectionnew->transform(function($item){
        return $item * 3;

    });
    //dd($collectionnew);







    //The unique method returns all of the unique items in the collection. The returned collection keeps the original array keys, so in this example we'll use the values method to reset the keys to consecutively numbered indexes:
    // $unique = $collectionnew->unique();



//  The when method will execute the given callback when the first argument given to the method evaluates to true:
    $collection = collect([1, 2, 3]);

    $collection->when(true, function ($collection) {
        return $collection->push(4);
    });
// if we use false push not work
//dd($collection);



// The where method filters the collection by a given key / value pair
    $collection->where('price',100);
//dump($collection);



//The zip method merges together the values of the given array with the values of the original collection at the corresponding index:
    $collection = collect(['Chair', 'Desk']);

    $zipped = $collection->zip([100, 200]);

    $zipped->all();

// [['Chair', 100], ['Desk', 200]]


    $orders = App\Order::all();
    $result = $orders->contains(1);

    $diff = $orders->diff($orders->where('id','>','1') );
    //var_dump($diff);

    $except = $orders->except([1,2,4,5,6,7,8,9]);
    //var_dump($except);

    $find = $orders->find(3);
    //echo$find->name;

    $intersect = $orders->intersect(App\Order::whereIn('id',[1,2])->get());
    //foreach ($intersect as $in) {
    //  echo $in->name;}

    // $modelkey = $orders->modelKeys();
    //foreach ($modelkey as $value) {
    //  echo $value;
    //}


    $unique = $orders->unique()->count();
    //  echo $unique;


});


//accessor and mutator

Route::get('accessor', function() {
    $accessor =  App\Order::find(1);
    echo $accessor->name;

    //mutator
    $mutator =  App\Order::find(1);
    $mutator->name ="Holoo";
});
use App\Http\Resources\Order as rorder;
Route::get('orderresource', function() {

    $or = new rorder(App\Order::find(1));
    var_dump($or);
});

// serilization
Route::get('serilization', function() {
    // convert model to array or json
});

// mail
use App\Mail\MyMail;
Route::get('email',function(){

    $order = new App\Order();
    $order->name = "ananas";
    $order->maghsad ="shiraz";
    return new App\Mail\MyMail($order);
});
Route::get('sendmail','mailController@sendmail');
Route::get('sendmail/{id}','OrderController@sendMail');
Route::get('rendermail', function() {
    $order = App\Order::find(1);
    return (new App\Mail\MyMail($order))->render();
});

Route::get('cache', function() {
    // get cach
    $value = Cache::get('key', 'default');

    //set chach
    Cache::put('key', $val, \minutes);

    //The add method will only add the item to the cache if it does not already exist in the cache store.
    Cache::add('key', $value, $minutes);

    // delete from cach
    Cache::forget('{1:$key}');

    // clear all of cach
    Cache::flush();
});
Route::get('mycache', function() {
    Cache::put('name', 'saeed ghanbari',2);
    return "value of name stroe with cache is :".Cache::get('name');
});

//events
use App\Events\baran;
Route::get('event', function() {
    $order = App\Order::findOrFail(1);
    event(new App\Events\baran($order));

    // Event::fire(new App\Events\baran($order));
    //echo Cache::get('nameOrder', 'default');
    // echo $event->get();
});

// storage
use Illuminate\Support\Facades\Storage;
Route::get('storage1', function() {
    // echo storage_path('app\public');
    Storage::put('filestrorage.txt',"in the name of allah");
    echo Storage::get('filestrorage.txt');
    echo "<br>";
    // echo asset('storage/filestrorage.txt');

    $url = Storage::url('filestrorage.txt');

    echo "asset :" . asset('storage/file.txt');echo "<br>";
    echo "url of filestorage.txtis :" .$url;
    // return Storage::download('filestrorage.txt','saeed.pdf');
    Storage::put('public/filestrorage.txt',"fjdhjf");
    Storage::append('filestrorage.txt', 'Appended Text');echo "<br>";
    echo "public path is :".public_path();

    //upload file
    //$uploadurl =  Storage::putFile('avatar',$request->file('avatar'))
    // or we csn use of store mehod
    //$path = $request->file('avatar')->store('avatars');

    // delete file
    Storage::delete('filestrorage.txt');

    //Get All Files Within A Directory
    $files = Storage::files('/');
    echo "files of Directory is " . $files[0];echo "<br>";

    // get all aof directory
    $directories = Storage::directories('/');
    echo "folder is :".$directories[0];echo "<br>";

    //make directory
    Storage::makeDirectory('images/1');

    //delete directory
    Storage::deleteDirectory('images/1');

    echo "base path is :" .base_path();

    //save of s3 amazon
    //  Storage::disk('s3')->put('files3.txt',"jdhnfkjdfhnkjd");;
});

// download file with storage
Route::get('downloadwithstorage', function() {
    return Storage::download("public/filestrorage.txt","downloadablefilestorage.txt");
});
Route::get('authuser', function() {
    echo "current user is:" .Auth::user();
});

// notify
use App\Notifications\mynotificatio;
use Illuminate\Notifications\Notifiable;
Route::get('notify', function() {
    $user = Auth::user();

    // send notification with email channel
    // $user->notify(new mynotificatio());
    // return "notify sent to  : ".$user->name;

    // send notification with notification facade
    //Notifications::send($user,new mynotificatio());


    //send notification to database

    $user->notify(new mynotificatio());
    //return "notify sent to  : ".$user->name;
    // $user->unreadNotifications->markAsRead();

});
Route::get('getnotofiy', function() {
    $user = Auth::user();
    foreach ($user->notifications as $key) {
        echo "data notification for user 1 is :".$key->data['mah'];
    }
});


// job and queue
use App\Jobs\StoreOrder;
use App\Jobs\StorePost;
Route::get('jobqueue1', function() {
    $order = new App\Order();
    $order->name = "narangi";
    $order->maghsad = "hamadan";
    // $order->save();
    // StoreOrder::dispatch($order);
    StorePost::dispatch();

    // if we to run job immediatly we use dispatchnoe method
    // StoreOrder::dispatchNow();

    // StoreOrder::dispatch($order)->delay(now()->addMinutes(1));
    echo "job to queue";

});


// fall back : if a route not found by default 404 not found return that we can over write this and this should last route in route .web
//Route::fallback(function(){
//  return "not found this route";
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('slicker',function(){
    return view('slicker');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    // Route::get('/products','\TCG\Voyager\Http\Controllers\VoyagerBaseController@index');
    Route::get('/products/createProduct', 'productController@createProduct');

    Route::get('/saveproduct','productController@saveProduct');
    Route::get('/productsContinue','productController@productsContinue');
    Route::post('productsContinue','productController@saveaboutproduct');
    Route::get('addtomostpopular/{id}','mostpopularController@add');
    Route::post('mostpopular/savemostpopular','mostpopularController@savemostpopular');
    Route::get('/Takmilkhardi/{id}','productController@takmilkharid');
});
Route::get('isadmin',function (){
    $s = \Illuminate\Support\Facades\Auth::user();
    echo $s->isAmin()."jkdfd";
});
Route::get('/shortcut', function () {
    // return view('index');
    $target = '/home2/omidwebs/laravelomidwebshop/storage/app/public';
    $shortcut = '/home2/omidwebs/public_html/storage';
    symlink($target, $shortcut);


});
Route::get('/clearchache', function () {
    unlink(base_path()."\\routes\\web.php");


});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

