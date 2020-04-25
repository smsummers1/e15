<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Arr;
use Str;


class AdminController extends Controller
{

    /*******************************************
        GET /admin/create
        
        Display the form to add a new file
     ********************************************/
    public function create(Request $request)
    {
        return view('admin.create');
    }


    /******************************************** 
        POST /admin 
        
        Process the excel files to add new 
        data to the database
     *********************************************/
    public function store(Request $request)
    {
        #Validate data entered
        # The `$request->validate` method takes an array of data
        # where the keys are form inputs
        # and the values are validation rules to apply to those inputs
        $request->validate([
            'fileType' => 'required',
            'fileUpload' => 'required',
            'description' => 'required'
        ]);

        #NOTE: If validation fails, it will automatically redirect the visitor back to the form 
        #and none of the code that follows will execute.
        dump($request);

        #eventually we will store the new uploaded file to the database. 

    }
}
