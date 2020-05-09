<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your
| application. These
| routes are loaded by the RouteServiceProvider 
| within a group which
| contains the "web" middleware group. Now create 
| something great!
|
*/

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

/********************************** 
 *
 * ROUTES FOR USERS NOT LOGGED IN
 ***********************************/

#Welcome Page
Route::get('/', function () {
    return view('/pages/welcome');
});

#Support page for all users whether logged in or not
Route::get('/support', 'PageController@support');

#Bloomz page for all users whether logged in or not
Route::get('/bloomz', 'PageController@bloomz');

Auth::routes();


/***********************************
 * ROUTES ONLY FOR USERS LOGGED IN
 *
 * RESTRICTED ROUTES
 *
 ************************************/
Route::group(['middleware' => 'auth'], function () {

    //IMPORT
    #Import new students form page
    Route::get('/import', function () {
        return view('admin/import');
    });
    #Import new students Excel File to the STUDENT
    #TABLE in p3 database
    Route::post('/import/students', 'MyController@import')->name('import');
    #Get Php Info
    Route::get('/getinfo', 'MyController@getinfo');



    //REPORTS
    #Reports Main Menu Page
    Route::get('/reports', function () {
        return view('/admin/reports');
    });

    #REPORT - listVolunteers.blade.php
    Route::get('/reports/listVolunteers', 'AdminController@reportListVolunteers');

    #REPORT - studentHours.blade.php
    Route::get('/reports/studentHours', 'AdminController@reportStudentHours');

    #Generate reports based on the selection on the /reports page
    //Route::get('/admin/{id?}', 'AdminController@show');



    //EDIT 
    #Edit Information Main Menu Page
    Route::get('/editInfo', function () {
        return view('/admin/editInfo');
    });


    #EDIT STUDENT
    //Show all students in a dropdown list
    Route::get('/students', 'AdminController@getStudents');

    //Get student data 
    Route::get('/editStudent/{id}', 'AdminController@findStudent');

    //Update student data
    Route::put('/editStudent/{id}/update', 'AdminController@updateStudent');


    #REMOVE STUDENT
    //Show all students in a dropdown list
    Route::get('/deleteStudent', 'AdminController@getStudentsToDelete');
    #Remove the one that is clicked.
    //used web spoofing to use get instead of delete
    Route::get('/deleteStudent/{id}/remove', 'AdminController@destroy');
});
