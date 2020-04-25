@extends('layouts.master')

@section('title')
    All Books
@endsection

@section('head')
    <link href='/css/books/index.css' rel='stylesheet'>
@endsection

@section('content')

    <div class='alert-success'>
        <h2>Recently Added Books</h2>
        <ul style="list-style:none;">
        @foreach($newBooks as $book) 
            <li>{{ $book->title }}</li>
        @endforeach
        </ul>
    </div>
    
    
    <h1>All Books</h1>
    @if(count($books) == 0) 
        No books have been added yet...
    @else
    
        @foreach($books as $book)
        <a href='/books/{{ $book->slug }}'>
            <img class='cover' src='{{ $book->cover_url }}'>
        </a>
        @endforeach
    
    @endif

@endsection