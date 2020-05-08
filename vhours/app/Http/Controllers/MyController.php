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
        return view('/import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new StudentsImport, request()->file('file'));

        //return back();
        return redirect('/')->with('success', 'Import is complete!');
    }

    public function getinfo()
    {
        //return back();
        return view('getinfo');
    }
}
