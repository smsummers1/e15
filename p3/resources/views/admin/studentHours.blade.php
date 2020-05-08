@extends('layouts.master')

@section('adminPortal')
<br>
<h2>Report</h2>
<br>

<div class="alert alert-secondary" role="alert">
    <h6 class="floatLeft"><a href="/reports">Back</a></h6>
    <br>
    <h3 dusk="student-hours-heading">Volunteer Hours Per Student</h3>
    <br>

    @if(count($students) == 0)
    No students in the system......
    @else
    <p id="count">{{$students->count()}} current students</p>

    @foreach($students as $student)

    <p id="list"> {{$student->firstName}} {{$student->lastName}}</p>

    @endforeach

    @endif
</div>

@endsection