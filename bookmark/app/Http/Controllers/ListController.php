<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;
use Arr;
use Str;


class ListController extends Controller
{
    //restrict this view so that only logged in viewers can view this
    public function show(Request $request)
    {
        $books = $request->user()->books->sortByDesc('pivot.created_at');

        dd($books);

        return view('lists.show')->with(['books' => $books]);
    }

    public function add($slug)
    {
        //dump($slug);
        //return 'Show the page to add a book to your list......';

        $book = Book::findBySlug($slug);

        #TODO:  Handle case where book isn't found for the given slug

        return view('lists.add')->with(['book' => $book]);
    }

    public function save(Request $request, $slug)
    {
        #dump($request->all());

        #TODO:  Validate incoming data, making sure they entered a note

        $book = Book::findBySlug($slug);

        #Add book to users list
        #create a new row in the book_user table
        $request->user()->books()->save($book, ['notes' => $request->notes]);

        return redirect('/list')->with([
            'flash-alert' => 'The book ' . $book->title . ' was added to your list.'
        ]);
    }
}
