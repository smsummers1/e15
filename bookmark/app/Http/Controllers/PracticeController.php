<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Str;

class PracticeController extends Controller
{
    
    public function practice1()
    {
        dump('This is the first example.');
    }
    
    //Demonstrating using the Book model (aka class)
    
    public function practice2()
    {
        //dump(Str::plural('mouse'));
        dump(Book::find(3));
        dump(Book::all()->toArray());
    }
    
    //Create a new book
    public function practice3()
    {
        # Instantiate a new Book Model object
        $book = new Book();

        # Set the properties
        # Note how each property corresponds to a column in the table
        $book->slug = 'the-martian';
        $book->title = 'The Martian';
        $book->author = 'Anthony Weir';
        $book->published_year = 2011;
        $book->cover_url = 'https://hes-bookmark.s3.amazonaws.com/the-martian.jpg';
        $book->info_url = 'https://en.wikipedia.org/wiki/The_Martian_(Weir_novel)';
        $book->purchase_url = 'https://www.barnesandnoble.com/w/the-martian-andy-weir/1114993828';
        $book->description = 'The Martian is a 2011 science fiction novel written by Andy Weir. It was his debut novel under his own name. It was originally self-published in 2011; Crown Publishing purchased the rights and re-released it in 2014. The story follows an American astronaut, Mark Watney, as he becomes stranded alone on Mars in the year 2035 and must improvise in order to survive.';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        dump('Added: ' . $book->title);
    }
    
    public function practice4()
    {
        //you can instantiate a book object
        //$book = new Book();
        //$books = $book->where('title', 'LIKE', '%Harry Potter%')->get();

        //or you can use the fascade
        $books = Book::where('title', 'LIKE', '%Harry Potter%')->get();
        
        //two design methods can be used
        //$books = Book::where('title', 'LIKE', '%Harry Potter%')->where('published_year', '>=', 1998)->get();
        
        if ($books->isEmpty()) {
            dump('No matches found');
        } else {
            //dump($books->toArray());
            foreach ($books as $book) {
                dump($book->title);
            }
        }
    }
    
    public function practice5()
    {
        $book = Book::where('slug', '=', 'the-martian')->first();
        
        dump($book);
        dump($book->toArray());
        
    }
    
    public function practice6()
    {
        # First get a book to update
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump("Book not found, can not update.");
        } else {
            # Change some properties
            $book->title = 'The Really Great Gatsby';
            $book->published_year = '2025';

            # Save the changes
            $book->save();

            dump('Update complete; check the database to confirm the update worked.');
        }    
    }
    
    public function practice7()
    {
        # First get a book to delete
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump('Did not delete- Book not found.');
        } else {
            $book->delete();
            dump('Deletion complete; check the database to see if it worked...');
        }
    }
    
    public function practice8()
    {
        #Retrieve the last 2 books that were added to the books table
        
        $books = Book::where('id', '=', Book::max('id'))->orWhere('id', '=', (Book::max('id')-1))->get();
        
        if ($books->isEmpty()) {
            dump('No matches found');
        } else {
            //dump($books->toArray());
            foreach ($books as $book) {
                dump($book->id, $book->title);
            }
        }
        
    }
    
    public function practice9()
    {
        #Retrieve all the books published after 1950
        
        $books = Book::where('published_year', '>', 1950)->get();
        
        if ($books->isEmpty()) {
            dump('No matches found');
        } else {
            //dump($books->toArray());
            foreach ($books as $book) {
                dump($book->title, $book->published_year);
            }
        }
    }
    
    public function practice10()
    {
        #Retrieve all the books in alphabetical order by title
        
        $books = Book::orderBy('title')->get();
        
        if ($books->isEmpty()) {
            dump('No matches found');
        } else {
            //dump($books->toArray());
            foreach ($books as $book) {
                dump($book->title);
            }
        }
        
    }

    public function practice11()
    {
        #Retrieve all the books in descending order according to published date
        
        $books = Book::orderByDesc('published_year')->get();
        
        if ($books->isEmpty()) {
            dump('No matches found');
        } else {
            //dump($books->toArray());
            foreach ($books as $book) {
                dump($book->title, $book->published_year);
            }
        }
    }
    
    public function practice12()
    {
        #Find any books by the author "J.K. Rowling" and update the author name to be "JK Rowling"
        $book = true;
        
        while($book){
            #retrieve books
            $book = Book::where('author', '=', 'J.K. Rowling')->first();

            #make sure there is a book retrieved
            if(!$book){
                dump('Book not found or all books have been updated.');
            }else{
                #book found and now correct the authors name
                $book->author = 'JK Rowling';

                #save changes
                $book->save();

                dump($book->title, "Updated Author to", $book->author);
            }
        }
        
    }
    
    public function practice13()
    {
        #Remove any/all books with an author name that includes the string "Rowling"
        $book = true;
        
        while($book){
            #retrieve book
            $book = Book::where('author', 'LIKE', '%Rowling%')->first();

            if(!$book){
                dump('All books have been deleted and/or book was not found.');
            }else{
                dump($book->title);
                $book->delete();
                dump('Deletion Complete');
            }
        }
    }
    
    
    //ANY (GET/POST/PUT/DELETE)
    
    public function index($n = null)
    {
        $methods = [];
        
        //Load the requested 'practiceN' method
        if (!is_null($n)){
            
            //ex: practice1
            $method = 'practice' . $n; 
            
            #Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this,$method)) ? $this->$method() : abort(404);
        } //if no 'n' is specified, show index of all available methods
        
        else{
            
            //Build an array of all methods in this class that start with 'practice'
            foreach(get_class_methods($this) as $method){
                if(strstr($method,'practice')){
                    $methods[] = $method;
                }
            }
            
            //Load the view and pass it the array of methods
            return view('practice')->with(['methods'=>$methods]);
        }
    }
        
}
