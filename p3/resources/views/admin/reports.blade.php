@extends('layouts.master')

@section('adminPortal')
<br><br>
<h2>Generate Reports</h2>

<h4>Want to generate a volunteer report? Not a problem - you can do it here!</h4>
<br><br>
<div class="alert alert-secondary" role="alert">

    <form method='POST' action=''>
        {{ csrf_field() }}
        <h6 class="floatLeft"><a href="/">Back to Admin Main Menu</a></h6>
        <br>

        <label for='fileType' class="col-form-label-lg">Select Report to Generate: </label>
        <select id='report' name="report" onchange="location = this.value;">
            <option value="/reports"> Click here to choose a report..... </option>

            <option dusk="list-all-volunteers-link" value="/reports/listVolunteers"> List All Volunteers </option>

            <option dusk="hours-per-student-link" value="/reports/studentHours">Hours per Student</option>

        </select>
    </form>
</div>

@if(count($errors) > 0)
<br><br>
<ul class='alert alert-danger' style='list-style-type: none;'>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif

@endsection