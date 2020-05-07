@extends('layouts.master')

@section('editInfo')
<h2 dusk="edit-student-information-heading">Edit Student Information</h2>

<form method='POST' action='/editStudent/{{$student->id}}/update'>
    <div class='details'>* Required fields</div>

    <!-- security token used to make sure data isn't coming from another site -->
    {{ csrf_field() }}

    <!-- form method spoofing so we can utilize put -->
    {{ method_field('put') }}

    <label for='firstName'>* First Name</label>
    <div class='details' style="float:left;">The first name may only contain letters.</div>
    <input type='text' name='firstName' id='firstName' value='{{ old("firstName", $student->firstName) }}'>
    @include('includes.error-field', ['fieldName'=>'firstName'])

    <label for='lastName'>* Last Name</label>
    <div class='details' style="float:left;">The last name may only contain letters and hyphens.</div>
    <input type='text' name='lastName' id='lastName' value='{{ old("lastName", $student->lastName) }}'>
    @include('includes.error-field', ['fieldName'=>'lastName'])

    <label for='homeroom'>* Homeroom</label>
    <div class='details' style="float:left;">The homeroom name may only contain letters, numbers, spaces and underscores.</div>
    <input type='text' name='homeroom' id='homeroom' value='{{ old("homeroom", $student->homeroom) }}'>
    @include('includes.error-field', ['fieldName'=>'homeroom'])

    <label for='streetAddress'>* Street Address</label>
    <input type='text' name='streetAddress' id='streetAddress' value='{{ old("streetAddress", $student->streetAddress) }}'>
    @include('includes.error-field', ['fieldName'=>'streetAddress'])

    <br>
    <input type='submit' value='Update'>

</form>
@endsection