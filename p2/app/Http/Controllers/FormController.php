<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Arr;
use Str;

class FormController extends Controller
{
    public function index()
    {
        return view('index')->with([
            'inputFile' => session('inputFile', null),
            'studentFirstName' => session('studentFirstName', null),
            'studentLastName' => session('studentLastName', null),
            'detailedReport' => session('detailedReport', null),
            'totalVolunteerTime' => session('totalVolunteerTime', null),
            'remainingVolunteerTime' => session('remainingVolunteerTime', null),
            'searchResults' => session('searchResults', null)
        ]);
    }
    
    public function search(Request $request)
    {
        #validate input values from the form
        $request ->validate([
            'inputFile' => 'required',
            'studentFirstName' => 'required|alpha',
            'studentLastName' => 'required|alpha_dash',
            'detailedReport' => 'required',
        ]);
        
        //totalVolunteerTime is in minutes
        $totalVolunteerTime = 0;
        //remainingVolunteerTime is in minutes
        //2160 minutes = 36 hours
        $remainingVolunteerTime = 2160;
        $searchResults = [];
        
        #get input values from the form
        $inputFile = $request->input('inputFile', null);
        $studentFirstName = $request->input('studentFirstName', null);
        $studentLastName = $request->input('studentLastName', null);
        $detailedReport = $request->input('detailedReport', null);
                
        #check for which file to pull data from
        #based on the users selection
        if($inputFile == 'jan2020'){
            $volunteerDataString = file_get_contents(database_path('jan2020.json'));
        }else{
            $volunteerDataString = file_get_contents(database_path('feb2020.json'));
        }
        
        #turn the string into an array
        $volunteerDataArray = json_decode($volunteerDataString, true);
        
        #find the student entries in the json file by
        #comparing the student's first and last name entered 
        #into the form to the student's first and last name in
        #the json file
                
        foreach ($volunteerDataArray as $slug => $entry)
        {
            if(strtolower($entry['studentFirstName'])==strtolower($studentFirstName) && strtolower($entry['studentLastName'])==strtolower($studentLastName))
             {
                $searchResults[$slug] = $entry;
                //dump($searchResults[$slug]);
             }
            
            //if studentFirstName and studentLastName == the First and Last 
            //Name entered into form then add up the volunteer hours
            if($studentFirstName == $entry['studentFirstName'] && 
               $studentLastName == $entry['studentLastName'])
            {
                $totalVolunteerTime += $entry['volunteerTimeToday'];
            
                //dump($slug);
                //dump($entry);
                //dump($totalVolunteerTime);
            }
        }
        
        //dd($totalVolunteerTime);
        
        $remainingVolunteerTime -= $totalVolunteerTime;
        
        $totalVolunteerTime /= 60;
        $remainingVolunteerTime /= 60;
                
        #return the information from the form and the
        #entries in the json form that match the requested
        #data
        return redirect('/')->with([
            'inputFile' => $inputFile,
            'studentFirstName' => $studentFirstName,
            'studentLastName' => $studentLastName,
            'detailedReport' => $detailedReport,
            'totalVolunteerTime' => $totalVolunteerTime,
            'remainingVolunteerTime' => $remainingVolunteerTime,
            'searchResults' => $searchResults
        ]);
    }
}