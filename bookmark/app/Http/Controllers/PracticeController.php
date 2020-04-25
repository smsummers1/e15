<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Author;
use Str;

class PracticeController extends Controller
{

    public function practice1()
    {
        # The following queries return a Book object
        //$results = Book::find(1);  
        //dump($results);

        //$results = Book::orderBy('title')->first(); 
        //dump($results);

        # Yields a collection of multiple books
        //$results = Book::all(); 
        //$results = Book::orderBy('title')->get(); 

        # Should match 1 book; yields a Collection of 1 Book
        //$results = Book::where('author', 'F. Scott Fitzgerald')->get();

        //to change or update data in a collection you have to iterate through it like se
        //foreach($results as $book){
        //  $book->title='ABC';
        //$book->save();
        //}

        # Should match 0 books; yields an empty Collection
        //$results = Book::where('author', 'Virginia Wolf')->get();

        # Even though we limit it to 1 book, we're using the `get` fetch method so we get a Collection (of 1 Book)
        //$results = Book::limit(1)->get();

        #Question 7 on quiz
        //$books = Book::orderBy('id', 'desc')->get();
        //$book = $books->first();

        #Question 8 on quiz
        //$books = Book::all();
        //echo $books;

        #using collection methods to filter and drill down through the collection
        $books = Book::where('author', 'F. Scott Fitzgerald')->get();
        #displays the collection
        dump($books);
        #displays the object
        dump($books->first());
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

        $books = Book::where('id', '=', Book::max('id'))->orWhere('id', '=', (Book::max('id') - 1))->get();

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

        while ($book) {
            #retrieve books
            $book = Book::where('author', '=', 'J.K. Rowling')->first();

            #make sure there is a book retrieved
            if (!$book) {
                dump('Book not found or all books have been updated.');
            } else {
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

        while ($book) {
            #retrieve book
            $book = Book::where('author', 'LIKE', '%Rowling%')->first();

            if (!$book) {
                dump('All books have been deleted and/or book was not found.');
            } else {
                dump($book->title, $book->author);
                $book->delete();
                dump('Deletion Complete');
            }
        }
    }

    public function practice14()
    {
        $book = Book::where('author', '=', 'Dr. Seuss')->get();
        $book->delete();
        dump('Book deleted.');
    }

    public function practice15()
    {
        $author = Author::where('first_name', '=', 'J.K.')->first();

        $book = new Book;
        $book->slug = 'fantastic-beasts-and-where-to-find-them';
        $book->title = "Fantastic Beasts and Where to Find Them";
        $book->published_year = 2001;
        $book->cover_url = 'https://hes-bookmark.s3.amazonaws.com/cover-placeholder.png';
        $book->info_url = 'https://en.wikipedia.org/wiki/Fantastic_Beasts_and_Where_to_Find_Them';
        $book->purchase_url = 'http://www.barnesandnoble.com/w/fantastic-beasts-and-where-to-find-them-j-k-rowling/1004478855';
        $book->author()->associate($author); # <--- Associate the author with this book
        //we could have just hard coded the id like this
        //$book->author_id = $author->id;
        $book->description = 'Fantastic Beasts and Where to Find Them is a 2001 guide book written by British author J. K. Rowling (under the pen name of the fictitious author Newt Scamander) about the magical creatures in the Harry Potter universe. The original version, illustrated by the author herself, purports to be Harry Potter’s copy of the textbook of the same name mentioned in Harry Potter and the Philosopher’s Stone (or Harry Potter and the Sorcerer’s Stone in the US), the first novel of the Harry Potter series. It includes several notes inside it supposedly handwritten by Harry, Ron Weasley, and Hermione Granger, detailing their own experiences with some of the beasts described, and including in-jokes relating to the original series.';
        $book->save();
        dump($book->toArray());
    }

    public function practice16()
    {
        # Get an example book
        $book = Book::whereNotNull('author_id')->first();

        # Get the author from this book using the "author" dynamic property
        # "author" corresponds to the the relationship method defined in the Book model
        $author = $book->author;

        # Output
        dump($book->title . ' was written by ' . $author->first_name . ' ' . $author->last_name);
        dump($book->toArray());
    }

    public function practice17()
    {
        # Eager load the author with the book
        //much more efficient and helps speed up performance
        //fewer queries to the database
        $books = Book::with('author')->get();

        foreach ($books as $book) {
            if ($book->author) {
                dump($book->author->first_name . ' ' . $book->author->last_name . ' wrote ' . $book->title);
            } else {
                dump($book->title . ' has no author associated with it.');
            }
        }

        dump($books->toArray());
    }

    public function practice18()
    {
        $user = User::where('email', '=', 'jill@harvard.edu')->first();
        dump($user->books->toArray());
    }

    public function practice19()
    {
        $books = Book::with('users')->get();

        foreach ($books as $book) {
            dump($book->title);
            dump($book->users->toArray());
        }
    }

    //REMOVE BOOK FROM USERS LIST
    public function practice20()
    {
        # As an example, grab a user we know has books on their list
        $user = User::where('email', '=', 'jamal@harvard.edu')->first();

        # Grab the first book on their list
        $book = $user->books()->first();

        if ($book) {
            # Delete the relationship
            $book->pivot->delete();
        } else {
            return 'No books available in list to delete';
        }

        dump($book->toArray());

        return 'Delete complete';
    }

    //UPDATE NOTES IN USERS LIST OF BOOKS
    public function practice21()
    {
        # As an example, grab a user we know has books on their list
        $user = User::where('email', '=', 'jill@harvard.edu')->first();

        # Grab the first book on their list
        $book = $user->books()->first();

        # Update and save the notes for this relationship
        $book->pivot->notes = "New note...";
        $book->pivot->save();

        dump($book->toArray());

        return 'Update complete';
    }

    //ANY (GET/POST/PUT/DELETE)

    public function index($n = null)
    {
        $methods = [];

        //Load the requested 'practiceN' method
        if (!is_null($n)) {

            //ex: practice1
            $method = 'practice' . $n;

            #Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method() : abort(404);
        } //if no 'n' is specified, show index of all available methods

        else {

            //Build an array of all methods in this class that start with 'practice'
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }

            //Load the view and pass it the array of methods
            return view('practice')->with(['methods' => $methods]);
        }
    }
}
