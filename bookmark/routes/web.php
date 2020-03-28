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

# Example route used to demonstrate error pages
Route::get('/example', function () {
    $foo = [1,2,3];

    # dump, die
    //dd($foo);

    # dump, die, debug
    //ddd($foo);

    Log::info($foo);

    ddd(storage_path('temp'));

    return view('abc');
});

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
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});

#HOMEPAGE
#
#static pages
#
/*
Route::get('/', function () {
    return view('welcome');
});*/

# Misc. Pages
Route::get('/', 'PageController@welcome');
Route::get('/support', 'PageController@support');


#BOOKS
Route::get('/books/create', 'BookController@create');
Route::post('/books', 'BookController@store');


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

# Route::get('/books/{title?}', 'BookController@show');

#multiple route parameters as part of your url structure
/*Route::get('/filter/{category}/{subcategory?}', function ($category, $subcategory = null) {
    $output = 'Books in category <b>' . $category . '</b>';

    if ($subcategory) {
        $output .= ' and subcategory <b>' . $subcategory . '</b>';
    }

    return $output;
});*/

Route::get('/books/{slug?}', 'BookController@show');

Route::get('/search', 'BookController@search');

Route::get('/list', 'BookController@list');

#This is an example route to show multiple parameters
#Not a feature we're actually building, so I'm commenting it out
# Route::get('/filter/{category}/{subcategory?}', 'BookController@filter');

#remember that outputs normally occur in our view files
