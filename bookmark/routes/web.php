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

#ERROR
Route::get('/example', function() {
    return view('abc');
});

 
#HOMEPAGE
#
#static pages
#
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'PageController@welcome');



#BOOKS
#
#dynamic pages
#

#the question mark makes the title optional and we handle
#the case where a user enters a book in the url or
#they do not enter a book in the url

#while this code will work fine it is not as logically organized as if we 
#created two separate cases
/*
Route::get('/books/{title?}', function ($title = null) {

    #eventually we will do something like query the
    #database for a book where the title is $title
    #then return a view to show the book
    #including book data such as title, author, summary, isbn, comments, ratings, etc.

    if (is_null($title)) {
        #query the database for all the books
        #return a view to show all the books
        return 'Here are all the books....';
    }
    return 'Details for book: ' . $title;
});
*/

#No book in the URL
#instead of using the function we are now going to use the BookController Method 
/*Route::get('/books', function () {
    return 'Here are all the books....';
});*/

Route::get('/books', 'BookController@index');

#Dynamic title listed
/*
Route::get('/books/{$title?}', function ($title = null) {
    return 'Details for book: ' . $title;
});*/

Route::get('/books/{title?}', 'BookController@show');

#multiple route parameters as part of your url structure
/*Route::get('/filter/{category}/{subcategory?}', function ($category, $subcategory = null) {
    $output = 'Books in category <b>' . $category . '</b>';

    if ($subcategory) {
        $output .= ' and subcategory <b>' . $subcategory . '</b>';
    }

    return $output;
});*/
Route::get('/filter/{category}/{subcategory?}', 'BookController@filter');

#remember that outputs normally occur in our view files
