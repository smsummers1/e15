<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Arr;
use Str;
use App\Book;
use App\Author;

class BookController extends Controller
{

    /*************************************
     * GET /books/create
     * Display the form to add a new book
     *************************************/
    public function create(Request $request)
    {
        //getting the author id, firstname, and lastname
        $authors = Author::orderBy('last_name')->select(['id', 'first_name', 'last_name'])->get();

        //dump($authors);

        //returning the view with the authors information
        return view('books.create')->with(['authors' => $authors]);
    }


    /******************************************
     * POST /books
     * Process the form for adding a new book
     ******************************************/
    public function store(Request $request)
    {
        # Validate the request data
        # The `$request->validate` method takes an array of data
        # where the keys are form inputs
        # and the values are validation rules to apply to those inputs
        $request->validate([
            'slug' => 'required|unique:books,slug|alpha_dash',
            'title' => 'required',
            //'author' => 'required',
            'author_id' => 'required',
            'published_year' => 'required|digits:4',
            'cover_url' => 'url',
            'info_url' => 'url',
            'purchase_url' => 'required|url',
            'description' => 'required|min:255'
        ]);

        //die dump of all the information to make sure it is working up to this point.
        //dd($request->all());
        #NOTE: If validation fails, it will automatically redirect the visitor back to the form 
        #and none of the code that follows will execute.

        #Add the book to the database
        $newBook = new Book();
        $newBook->slug = $request->slug;
        $newBook->title = $request->title;
        //$newBook->author = $request->author;
        $newBook->author_id = $request->author_id;
        $newBook->published_year = $request->published_year;
        $newBook->cover_url = $request->cover_url;
        $newBook->info_url = $request->info_url;
        $newBook->purchase_url = $request->purchase_url;
        $newBook->description = $request->description;
        $newBook->save();

        return redirect('/books/create')->with(['flash-alert' => $newBook->title . ' was added.']);
        //dump($newBook->toArray());
    }


    /**************
     * GET /search *
     **************/
    public function search(Request $request)
    {
        #validate entry first
        #if validation fails then we will be redirected back to the previous
        #location which in this instance is the form
        $request->validate([
            'searchTerms' => 'required',
            'searchType' => 'required',
        ]);

        #first we need to know what user entered
        #instead of using the superglobal $_GET we will use
        #a Laravel built in request class


        # ======== Temporary code to explore $request ==========

        # Get all the properties and methods available in the $request object
        //dump($request); # Object of type Illuminate\Http\Request

        # Get the form data (array) from the $request object
        //dump($request->all()); # Equivalent of dump($_GET)

        # Get the form data from individual fields
        //dump($request->input('searchTerms'));
        //dump($request->input('searchType'));

        # Form data from individual fields can also be accessed via dynamic properties
        //dump($request->searchTerms);

        # Boolean to see if the request contains data for a particular field
        //dump($request->has('searchTerms')); # Should be true

        # You can get more information about a request than just the data of the form, for example...
        //dump($request->path()); # "search"
        //dump($request->is('search')); # true
        //dump($request->is('books')); # false
        //dump($request->fullUrl()); # e.g. http://bookmark.loc search?searchTerms=Harry%20Potter&searchType=title
        //dump($request->method()); # GET
        //dump($request->isMethod('post')); # False

        # ======== End exploration of $request ==========
        # Start with an empty array of search results; books that
        # match our search query will get added to this array
        $searchResults = [];

        # Get the input values (default to null if no values exist)
        $searchTerms = $request->input('searchTerms', null);
        $searchType = $request->input('searchType', null);

        # Load our book data using PHP's file_get_contents
        # We specify our books.json file path using Laravel's database_path helper
        $bookData = file_get_contents(database_path('books.json'));

        //dd($bookData);

        # Convert the string of JSON text we loaded from books.json into an
        # array using PHP's built-in json_decode function
        $books = json_decode($bookData, true);

        //dd($books);

        # This algorithm will filter our $books down to just the books where either
        # the title or author ($searchType) matches the keywords the user entered ($searchTerms)
        # The search values are convereted to lower case using PHP's built in strtolower function
        # so that the search is case insensitive
        $searchResults = array_filter($books, function ($book) use ($searchTerms, $searchType) {
            return Str::contains(strtolower($book[$searchType]), strtolower($searchTerms));
        });

        //dd($searchResults);

        # The above array_filter accomplishes the same thing this for loop would
        // foreach ($books as $slug => $book) {
        //     if (strtolower($book[$searchType]) == strtolower($searchTerms)) {
        //         $searchResults[$slug] = $book;
        //     }
        // }

        //dd($searchResults);
        # Redirect back to the form with data/results stored in the session
        # Ref: https://laravel.com/docs/redirects#redirecting-with-flashed-session-data
        return redirect('/')->with([
            'searchTerms' => $searchTerms,
            'searchType' => $searchType,
            'searchResults' => $searchResults
        ]);
    }

    /************************************
     * GET /books                        *  
     * Show all the books in the library *
     * using the json file               *
     *************************************
    
    public function index()
    {
        # Open the books.json data file
        # database_path() is a Laravel helper to get the path to the database folder
        # See https://laravel.com/docs/helpers for other path related helpers
        # file_get_contents is a built-in PHP function
        $bookData = file_get_contents(database_path('books.json'));

        # Convert the JSON to an array PHP's json_decode function
        $books = json_decode($bookData, true);
        
        # Alphabetize the books
        $books = Arr::sort($books, function ($value) {
            return $value['title'];
        });

        return view('books.index')->with([
            'books' => $books
        ]);
    }*/

    /************************************
     * GET /books                        *  
     * Show all the books in the library *
     * using the database                *
     ************************************/

    public function index()
    {
        $books = Book::orderby('title')->get();

        //Query database for the last three books entered in the database or the most recent books added
        //$newBooks = Book::orderByDesc('created_at')->limit(3)->get();

        //instead of quering the database we can filter through the data we have using collection methods
        $newBooks = $books->sortByDesc('created_at')->take(3);

        return view('books.index')->with([
            'books' => $books,
            'newBooks' => $newBooks
        ]);
    }



    /******************************************
     * GET /book/{slug}                        *
     * Show the details for an individual book *
     * using the JSON file                     *
     *******************************************
    public function show($slug)
    {
        # Load the JSON book data
        $bookData = file_get_contents(database_path('books.json'));

        # Convert the JSON to an array
        $books = json_decode($bookData, true);
        
        $book = Arr::first($books, function ($value, $key) use ($slug) {
            return $key == $slug;
        });
        
        return view('books.show')->with([
            'book' => $book,
            'slug' => $slug,
        ]);
    }*/

    /******************************************
     * GET /book/{slug}                        *
     * Show the details for an individual book *
     * using the database                      *
     ******************************************/
    public function show($slug)
    {

        $book = Book::where('slug', '=', $slug)->first();

        return view('books.show')->with([
            'book' => $book,
            'slug' => $slug,
        ]);
    }

    /**
     * GET /filter/{$category}/{subcategory?}
     * Example demonstrating multiple parameters
     * Not a feature we're actually building, so I'm commenting out
     */
    // public function filter($category, $subcategory = null)
    // {
    //     $output = 'Here are all the books under the category '.$category;

    //     if ($subcategory) {
    //         $output .= ' and also the subcategory '.$subcategory;
    //     }

    //     return $output;
    // }


    /******************************************
     * EDIT /book/{slug}/edit                  *
     * Get book data to EDIT                   *  
     *                                         *
     ******************************************/
    public function edit(Request $request, $slug)
    {
        #find the book we need to edit
        $book = Book::where('slug', '=', $slug)->first();

        # Get data for authors in alphabetical order by last name
        $authors = Author::orderBy('last_name')->select(['id', 'first_name', 'last_name'])->get();

        #pass the book to the view
        return view('books.edit')->with([
            'book' => $book, 'authors' => $authors
        ]);
    }


    public function update(Request $request, $slug)
    {
        //dump($request->all());
        $book = Book::where('slug', '=', $slug)->first();

        $request->validate([
            'slug' => 'required|unique:books,slug,' . $book->id . '|alpha_dash',
            'title' => 'required',
            //'author' => 'required',
            'author_id' => 'required',
            'published_year' => 'required|digits:4',
            'cover_url' => 'url',
            'info_url' => 'url',
            'purchase_url' => 'required|url',
            'description' => 'required|min:255'
        ]);



        # the book to the database
        $book->slug = $request->slug;
        $book->title = $request->title;
        //$book->author = $request->author;
        $book->author_id = $request->author_id;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;

        $book->save();

        return redirect('/books/' . $slug . '/edit')->with([
            'flash-alert' => 'Your changes were saved.'
        ]);
    }



    /******************************************
     * REMOVE /book/{slug}                      *
     * Get book data to REMOVE                  *  
     *                                          *
     *******************************************/
    public function delete(Request $request, $slug)
    {

        #find the book we need to edit
        $book = Book::where('slug', '=', $slug)->first();

        #pass the book to the view
        return view('books.delete')->with([
            'book' => $book
        ]);
    }


    /******************************************
     * DESTROY /book/{slug}                      *
     * Decide to destroy/remove book from db    * 
     *                                          *
     *******************************************/
    public function destroy(Request $request, $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        #not the best way to code this in that you could lose very valuable user notes
        #remove any relationships with this book and its users
        if ($book->users()) {
            $book->users()->detach();
        }

        #Validations
        #At least one of the radio buttons has to be selected to be valid
        $request->validate([
            'deleteChoice' => 'required',
        ]);

        if ($request['deleteChoice'] == 'NO') {
            return view('books.show')->with([
                'book' => $book,
                'slug' => $slug,
            ]);
        } else {
            $book->delete();

            return redirect('/books')->with([
                'flash-alert' => '"' . $book->title . '" was removed.'
            ]);

            //return $this->index();
        }
    }
}
