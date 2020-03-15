<?php

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


//page to the form
Route::get('/', 'FormController@index');

//processes the form and pulls data for user
//this route will be redirected to show on the 
//same page as the form in my search function
Route::get('/search', 'FormController@search');


