  @extends('layouts.master')

  @section('title')
  My List
  @endsection

  @section('head')
  <link href='/css/books/show.css' rel='stylesheet'>
  @endsection

  @section('content')

  @if($books->count() == 0)
  <p>You have not added any books to your list yet.</p>
  <p><a href='/books'>Find books to add in our library...</a></p>
  @else

  @foreach($books as $book)
  <br><br>
  <div class='book' style="border: 1px solid black;">
      <br>
      <a href='/books/{{ $book->slug }}'>
          <h2>{{ $book->title }}</h2>
      </a>
      @if($book->author)
      <p>By {{ $book->author->first_name. ' ' . $book->author->last_name }}</p>
      @endif

      <form method='POST' action='#'>
          <textarea class='notes'>{{$book->pivot->notes}}</textarea>
          <input type="submit" class="btn btn-primary" value="Update Notes">
      </form>

      <p class='added'>
          Added to your list {{ $book->pivot->created_at->diffForHumans() }}
      </p>

      <a href="#"><i class="fa fa-minus-circle"></i> Remove from your list</a>
      <br>
  </div>
  @endforeach

  @endif

  @endsection