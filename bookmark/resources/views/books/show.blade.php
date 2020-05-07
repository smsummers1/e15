  @extends('layouts.master')

  @section('title')
  {{ $book ? $book->title : 'Book not found' }}
  @endsection

  @section('head')
  <link href='/css/books/show.css' rel='stylesheet'>
  @endsection

  @section('content')

  @if(!$book)
  Book not found, <a href='/books'>Check out the other books in our library....</a>

  @else

  <!-- {{--
    (array notation)
    <img class='cover' src='{{ $book["cover_url"] }}' alt='Cover photo for {{ $book["title"] }}'>

    --}} -->

  <!-- (object notation....either array or object notation will work) -->
  <img class='cover' src='{{ $book->cover_url }}' alt='Cover photo for {{ $book->title }}'>



  <h1>{{ $book->title }}</h1>

  @if($book->author)
  <p dusk="author-info">By {{ $book->author->first_name. " ".$book->author->last_name }}</p>
  @endif

  <p>({{$book->published_year}})</p>

  <p class='description'>
    {{ $book->description }}
    <a href='{{$book->info_url}}'>Learn more...</a>
  </p>

  <a href='{{$book->purchase_url}}'>Purchase...</a>
  <br><br>
  <ul class='bookActions'>
    <li> <a href='/list/{{ $book->slug }}/add'><i class="fa fa-plus"></i>Add to your list</a></li>
    <li> <a href='/books/{{ $book->slug }}/edit'><i class="fa fa-edit"></i>Edit</a></li>
    <li> <a href='/books/{{ $book->slug }}/delete'><i class="fa fa-trash"></i>Delete</a></li>
  </ul>
  <br><br>

  @endif

  @endsection