<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\User;
use Arr;
use Str;


class AdminController extends Controller
{

    /****************************************************
        GET /admin/getStudents

        get Students Data from DB to Edit Information
     ***************************************************/

    public function getStudents(Request $request)
    {
        //get all data from the Students Table ordered by lastname
        $students = Student::orderby('lastName')->get();

        //send all data back to the editStudent page
        return view('admin.students')->with(['students' => $students]);
    }

    /****************************************************
        GET /editStudent/{id}

        get Student's Data from DB to Edit Information
     ***************************************************/
    public static function findStudent(Request $request, $id)
    {
        $student = Student::where('id', '=', $id)->first();

        return view('admin.editStudent')->with(['student' => $student]);
    }


    /****************************************************
        Update /editStudent

        get Student's Data from DB to Edit Information
     ***************************************************/
    public function updateStudent(Request $request, $id)
    {
        //dump($request->all());

        $student = Student::where('id', '=', $id)->first();

        $request->validate([
            'firstName' => 'required|between:2,50|alpha_dash',
            'lastName' => 'required|between:2,50|alpha_dash',
            'homeroom' => 'required|between:2,50',
            'streetAddress' => 'required|between:10,50'
        ]);

        # save student edits to the database
        $student->firstName = $request->firstName;
        $student->lastName = $request->lastName;
        $student->homeroom = $request->homeroom;
        $student->streetAddress = $request->streetAddress;

        $student->save();

        return redirect('/editInfo')->with([
            'flash-alert' => 'Your changes were saved'
        ]);
    }

    /****************************************************
        GET /admin/getStudentsToDelete

        get Students Data from Database to populate a
        dropdown list
     ***************************************************/

    public function getStudentsToDelete(Request $request)
    {
        //get all data from the Students Table ordered by lastname
        $students = Student::orderby('lastName')->get();

        //send all data back to the editStudent page
        return view('admin.deleteStudent')->with(['students' => $students]);
    }


    /***************************************************
     * Delete /deleteStudent/{id}/remove               *
     * Delete Selected Student from Database           *
     *                                                 *
     **************************************************/
    public function destroy(Request $request, $id)
    {
        dump($id);
        #find the book we need to edit
        $student = Student::where('id', '=', $id)->first();

        if ($student->users()) {
            $student->users()->detach();
        }

        $student->delete();

        #pass the book to the view
        return redirect('/editInfo')->with([
            'flash-alert' => $student->firstName . " " . $student->lastName . " " . 'was deleted.'
        ]);
    }

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

    /********************************************
        REPORT /reports/ListVolunteers

        Get Volunteers from Database
     *********************************************/
    public function reportListVolunteers(Request $request)
    {
        $volunteers = User::orderby('lastName')->get();

        return view('admin.listVolunteers')->with([
            'volunteers' => $volunteers
        ]);
    }


    /**************************************************
        REPORT /reports/studentHours

        Get Students and their relationship to the
        pivot table field hours to display
        students and the hours they have accumulated
     **************************************************/
    public function reportStudentHours(Request $request)
    {
        $students = $request->user()->students->sortByDesc('pivot.created_at');

        return view('admin.studentHours')->with(['students' => $students]);

        //$students = Student::orderby('lastName')->get();

        //return view('admin.studentHours')->with(['students' => $students]);

    }
}
