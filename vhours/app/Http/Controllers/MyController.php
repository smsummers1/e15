<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
  
class MyController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importView()
    {
       return view('import');
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new UsersImport,request()->file('file'));
           
        return back();
    }
}
