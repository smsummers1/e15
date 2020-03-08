<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        //eventually this will be a view
        //do not normally want to return a string from here
        //this is just for a quick example and slowly 
        //introduce you to how all of these pieces work together
        #return 'Here are all the books!';
        
        return view('books.index')->with(['books'=>[
            ['title' => 'Winnie The Pooh'],
            ['title' => 'Turtle and Nacho']
        ]]);
    }

    public function show($title = null)
    {
        //Query the database for a book where the title = $title
        //return a view to show the book
        //Include the book data
        //return 'Details for book: ' . $title;
        
        #the path to the views directory is known by the view()
        #books.show = books is the directory and show is the show.blade.php file
        #be sure to use dot notation for directories to files
        #only use the first part of the blade.php file types
        #view() understands that show is the show.blade.php file
        
        $bookFound = false;
        
        #must pass the $title variable along with the view()
        #
        dump($title);
        return view('books.show')->with(['title' => $title, 'bookFound' => $bookFound]);
        
        
    }

    public function filter($category, $subcategory = null)
    {
        $output = 'Books in category <b>' . $category . '</b>';

        if ($subcategory) {
            $output .= ' and subcategory <b>' . $subcategory . '</b>';
        }

        return $output;
    }
}
