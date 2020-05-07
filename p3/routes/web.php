<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


#Welcome Page for users not logged in
Route::get('/', function () {
    return view('/pages/welcome');
});

#Support page for both logged in and not logged in users
Route::get('/support', 'PageController@support');



#RESTRICTED ROUTES - ONLY FOR LOGGED IN USERS
Route::group(['middleware' => 'auth'], function () {
    #Two routes to Upload New Data Files Page
    Route::get('/admin/create', 'AdminController@create');

    Route::post('/admin', 'AdminController@store');

    #Report option page
    Route::get('/reports', function () {
        return view('/admin/reports');
    });

    #Generate reports based on the selection on the /reports page
    //Route::get('/admin/{id?}', 'AdminController@show');

    #Edit Information page
    Route::get('/editInfo', function () {
        return view('/admin/editInfo');
    });

    #EDIT STUDENT
    //Show all students in a dropdown list
    Route::get('/students', 'AdminController@getStudents');

    #Get specific student user chose from the dropdown list
    Route::get('/editStudent/{id}', 'AdminController@findStudent');

    #Update the specific student after user updated info in the form
    Route::put('/editStudent/{id}/update', 'AdminController@updateStudent');


    #DELETE STUDENT
    //Show all students in a dropdown list
    Route::get('/deleteStudent', 'AdminController@getStudentsToDelete');
    #Remove the one that is clicked.
    //used web spoofing to use get instead of delete
    Route::get('/deleteStudent/{id}/remove', 'AdminController@destroy');


    #REPORT - listVolunteers.blade.php
    Route::get('/reports/listVolunteers', 'AdminController@reportListVolunteers');

    #REPORT - studentHours.blade.php
    Route::get('/reports/studentHours', 'AdminController@reportStudentHours');


    #Add New Family page
    #Remove Family/Student (graduated, moved)
    #Change Current Student Info
    #Change Volunteer Hours
});

#Testing my local database connection
Route::get('/debug', function () {

    $debug = [
        'Environment' => App::environment(),
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: ' . $e->getMessage();
    }

    dump($debug);
});

Auth::routes();
