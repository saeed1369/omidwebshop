<?php

namespace App\Exports;

use App\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use  Maatwebsite\Excel\Concerns\WithHeadings;

class ExportFactor implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sale::select('id','name','catagory1','catagory2','catagory3','price','number','takhfif','transId','created_at','product_id')->get();
    }
    public  function headings():array
    {
        return  ['ردیف','نام','دسته بندی','دسته بندی 2','دسته بندی 3','قیمت','تعداد','تخفیف','شماره تراکنش','تاریخ','ای دی محصول'];
    }
}
