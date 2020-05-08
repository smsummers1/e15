<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class MyController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function importView()
    {
        return view('admin.import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        //make sure the file is an excel file
        request()->validate(['file' => 'mimes:xlsx, xls']);

        Excel::import(new StudentsImport, request()->file('file'));

        //return back();
        return redirect('/')->with('flash-alert', 'Import is complete!');
    }

    public function getinfo()
    {
        //return back();
        return view('getinfo');
    }
}
