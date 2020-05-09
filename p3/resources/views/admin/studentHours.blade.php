@extends('layouts.master')

@section('adminPortal')
<br>
<h2>Report</h2>
<br>

<div class="alert alert-secondary" role="alert">
    <h6 class="floatLeft"><a href="/reports">Back to Reports Menu</a></h6>
    <br>
    <h3 dusk="student-hours-heading">Volunteer Hours Per Student</h3>
    <br>

    @if($students->count() == 0)
    <p dusk="no-students-in-database">No students in the system......</p>
    <p> Add students by importing them via <a href="/import"> Excel file here</a>....</p>

    @else
    <p id="count">{{$students->count()}} current students</p>

    @foreach($students as $student)

    <p id="list"> {{$student->firstName}} {{$student->lastName}} --- {{$student->totalTimeVolunteered}}</p>

    @endforeach

    @endif
</div>

@endsection