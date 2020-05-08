@extends('layouts.master')

@section('adminPortal')
<br>
<h2 dusk="listVolunteer-heading">Report</h2>
<br>

<div class="alert alert-secondary" role="alert">
    <h6 class="floatLeft"><a href="/reports">Back</a></h6>
    <br>
    <h3>All Current Volunteers</h3>
    <br>

    @if(count($volunteers) == 0)
    No current volunteers are in the system......
    @else
    <p id="count">{{count($volunteers)}} current volunteers</p>
    @foreach($volunteers as $volunteer)

    <p id="list"> {{$volunteer->firstName}} {{$volunteer->lastName}}</p>

    @endforeach

    @endif
</div>

@endsection