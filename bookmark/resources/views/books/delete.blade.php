  
@extends('layouts.master')

@section('title')
{{ $book ? $book->title : 'Book not found' }}
@endsection

@section('head')
{{-- Page specific CSS includes should be defined here; this .css file does not exist yet, but we can create it --}}
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

    <p>By {{ $book->author }} ({{$book->published_year}})</p>

    <p class='description'>
        {{ $book->description }}
    </p>

    <div class="alert-danger">
        <!--the action url is envoking the destory method-->
        <form method="post" action='/books/{{ $book->slug }}' >
            <!-- security token used to make sure data isn't coming from another site -->
            {{ csrf_field() }}

            <!-- form method spoofing so we can utilize put -->
            {{ method_field('delete') }}

            <h3>Are you sure you want to delete this book?</h3>

            <input type="radio" id="yes" name="deleteChoice" value="YES">
            <label for"yes">YES</label><br>

            <input type="radio" id="no" name="deleteChoice" value="NO">
            <label for"no">NO</label><br>

            <input type="submit" value="Submit">

        </form>
        
        @if(count($errors) > 0)
        <br><br>
        <ul class='alert alert-danger' style='list-style-type: none;'>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        
    @endif
    </div>  

    @endif

@endsection