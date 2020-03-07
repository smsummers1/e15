@extends('layouts.master')

@section('title')
    Book library list.....
@endsection

@section('content')
    @if(count($books) == 0)
        No books have been added yet....
    @else
        @foreach($books as $book)
            {{ $book['title'] }}
            <br>
        @endforeach
    @endif

@endsection