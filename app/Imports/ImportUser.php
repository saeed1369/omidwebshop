<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUser implements ToModel
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
            'age' =>$row[2] ,
            'gener' =>$row[3] ,
            'shoghl' =>$row[4] ,
            'tahsilat' =>$row[5] ,
            'mahalZendegi' =>$row[6] ,
            'mahalTavalod' =>$row[7] ,
            'mobile' =>$row[8] ,
            'email' =>$row[9] ,
            //
        ]);
    }
}
