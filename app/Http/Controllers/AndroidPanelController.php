<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PHPUnit\Util\Json;
use Symfony\Component\Console\Input\Input;

class AndroidPanelController extends Controller
{

    public function get(Request $request,$modelName)
    {
       $namespace = 'App\\'.$modelName;
        $data =$namespace::all();
        $data->toJson();
        echo $data;

    }

    // store in database
    public function store($modelName)
    {
        $request = Input::all();
        switch ($modelName)
        {
            case 'Product':
            {

            }
            case 'User':
            {
                $this->storeUser($request);
            }
            case 'Payment':
            {
                $this->storePayment($request);
            }
        }
    }
    private function  storePayment($request)
    {

    }
    private function storeUser($data)
    {
        $objuser = new App\User();
        $objuser->name = $data->name ;
        $objuser->email = $data->email ;
        $objuser->gener =$data->gener ;
        $objuser->age = $data->age ;
        $objuser->shoghl = $data->shoghl ;
        $objuser->tahsilat = $data->tahsilat ;
        $objuser->mahalZendegi = $data->mahalZendegi ;
        $objuser->mahalTavalod = $data->mahalTavalod ;
        $objuser->mobile = $data->mobile ;
        $objuser->password = Hash::make($data->password);
        $objuser->api_token = Str::random(80);
        $objuser->role_id = 2 ;
        $result = $objuser->save;
        $response = array('response' =>$result);
        echo \GuzzleHttp\json_encode($response);



    }
    // delete from database
    public function delete(Request $request ,$modelName)
       {
            $id = $request->input('userid');
            switch ($modelName)
            {
                case 'Product':
                {

                }
                case 'User':
                {
                    $this->deleteUser($id);
                }
                case 'Payment':
                {
                    $this->storePayment($id);
                }
            }
       }

    private function deleteUser($id)
    {
        $objuserfordelete = App\User::where('id',$id)->delete();
        $json =  json_encode(array(['response' => $objuserfordelete]));

       echo $json;

    }

}
