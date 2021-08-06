<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    function export()
    {
        // return Excel::create('Filename', function($excel) {

        //     $excel->sheet('Sheetname', function($sheet) {
        
        //         $sheet->setOrientation('landscape');
        
        //     });
        
        // })->export('xlsx');
        return Excel::download(new UserExport, 'users.xlsx');
    }

}