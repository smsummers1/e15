@extends('layouts.master')

@section('title')
Reports
@endsection

@section('portal')
Admin Portal
@endsection

@section('user')
Hi, User
@endsection

@section('adminPortal')
<br><br>
<h2>Generate Reports</h2>

<h4>Want to generate a volunteer report? Not a problem - you can do it here!</h4>
<br><br>
<div class="alert alert-secondary" role="alert">

    <form method='POST' action=''>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}

        <label for='fileType' class="col-form-label-lg">* Select Report to Generate: </label>
        <select id='underHours' name="underHours">
            <option value="underHours" {{ (old('underHours') == 'Too Few Hours') ? 'selected="selected"' : ''}}> Families Under Hours </option>

            <option hidden value="specificStudent" {{ (old('specificStudent') == 'Specific Student Data') ? 'selected="selected"' : ''}}> Specific Student Data </option>

            <option value="allVolunteers" {{ (old('allVolunteers') == 'All Volunteers') ? 'selected="selected"' : ''}}> All Volunteer Report </option>

            <option value="familyVolunteerReport" {{ (old('familyVolunteerReport') == 'Family Volunteer Report') ? 'selected="selected"' : ''}}> Family Volunteer Report </option>

        </select>

        <br>

        <input type='submit' class="btn btn-primary" value='Generate'>

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