<?php

namespace App\Http\Controllers;

use App\Mostpopular;
use Illuminate\Http\Request;

class mostPopularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MostPopular  $mostPopular
     * @return \Illuminate\Http\Response
     */
    public function show(MostPopular $mostPopular)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MostPopular  $mostPopular
     * @return \Illuminate\Http\Response
     */
    public function edit(MostPopular $mostPopular)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MostPopular  $mostPopular
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MostPopular $mostPopular)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MostPopular  $mostPopular
     * @return \Illuminate\Http\Response
     */
    public function destroy(MostPopular $mostPopular)
    {
        //
    }
    public function add($id)
    {
        return view('addmostpopular',['id' => $id]);
    }
    public function savemostpopular(Request $request)
    {
        if (isset($request->image) && isset($request->productid)) {
            $obj = new Mostpopular();
            $img = $request->image;
            $obj->product_id = $request->productid;
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
                //  $foo->image_ratio_x = true;
                // $foo->image_x = 200;
                $foo->process('storage/mostpopulars');
                if ($foo->processed) {
                    $obj->image = 'mostpopulars/' . $path;
                    $obj->save();
                    return redirect()->route("voyager.products.index")->with([
                        'message' => "محبوب ترین " . __('voyager::generic.successfully_added_new'),
                        'alert-type' => 'success',
                    ]);


                } else {
                    return redirect()->back()->withErrors(['file_error' => $foo->error]);

                }
            }

        }
    }

}
