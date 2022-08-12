<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BulkExport;
use App\Exports\postExport;
use App\Imports\BulkImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Bulk;

class ImportExportController extends Controller
{
    /**
     * 
     */
    public function importExportView()
    {
        return view('importexport');
    }
    public function export()
    {
        return Excel::download(new BulkExport, 'users.xlsx');
    }
    public function postexport()
    {
        return Excel::download(new PostExport, 'Posts.xlsx');
    }
}
