<?php

namespace App\Http\Controllers;

use App\Exports\ExportFactor;
use App\Imports\ImportFactor;
use Illuminate\Http\Request;
use App\Exports\ExportUser;
use App\Import\ImportUser;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;

class ExcelController extends Controller
{
    public function ImportExport()
    {
        return view('import-export.import-export');
    }
    public function exportUser()
    {

        return Excel::download(new ExportUser,'users.xlsx','Xlsx');
    }
    public function importUser()
    {
        Excel::import(new ImportUsers,\request()->file('file'));
        return back();
    }

    public function exportFactor()
    {
        return Excel::download(new ExportFactor,'Factors.xlsx');
    }
    public function importFactor()
    {
        Excel::import(new ImportFactor,\request()->file('file'));
        return back();
    }
}
