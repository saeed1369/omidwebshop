<?php

namespace App\Imports;

use App\Sale;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportFactor implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'id' =>$row[0] ,
            'name' =>$row[1] ,
            'catagory1' =>$row[2] ,
            'catagory2' =>$row[3] ,
            'catagory3' =>$row[4] ,
            'price' =>$row[5] ,
            'number' =>$row[6] ,
            'takhfif' =>$row[7] ,
            'transId' =>$row[8] ,
            'user_id' =>$row[9] ,
            'product_id' =>$row[10] ,
            //
        ]);
    }
}
