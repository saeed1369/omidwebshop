<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use  Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUser implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('id','name','age','gener','shoghl','tahsilat','mahalZendegi','mahalTavalod','mobile','email','created_at')->get();
    }
    public  function headings():array
    {
        return  ['ردیف','نام','سن','جنسیت','شغل','تحصیلات','محل زندگی','محل تولد','شماره همراه','ادرس ایمیل','تاریخ ثبت نام'];
    }
}
