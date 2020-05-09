@extends('layouts.master')

@section('editInfo')
<br><br>
<h2 dusk="edit-student-information-heading">Edit Student Information</h2>

<div class="alert alert-secondary" role="alert">

    <form method='POST' action='/editStudent/{{$student->id}}/update'>
        <h6 class="floatLeft"><a href="/editInfo">Back to Edit Information Menu</a></h6>
        <br>
        <div class='details'>* Required fields</div>

        <!-- security token used to make sure data isn't coming from another site -->
        {{ csrf_field() }}

        <!-- form method spoofing so we can utilize put -->
        {{ method_field('put') }}

        <label for='firstName'>* First Name</label>
        <div class='details' style="float:left;"></div>
        <input dusk='firstName-input' type='text' name='firstName' id='firstName' value='{{ old('firstName', $student->firstName) }}'>
        @include('includes.error-field', ['fieldName'=>'firstName'])

        <label for='lastName'>* Last Name</label>
        <div class='details' style="float:left;"></div>
        <input dusk='lastName-input' type='text' name='lastName' id='lastName' value='{{ old("lastName", $student->lastName) }}'>
        @include('includes.error-field', ['fieldName'=>'lastName'])

        <label for='homeroom'>* Homeroom</label>
        <div class='details' style="float:left;"></div>
        <input dusk='homeroom-input' type='text' name='homeroom' id='homeroom' value='{{ old("homeroom", $student->homeroom) }}'>
        @include('includes.error-field', ['fieldName'=>'homeroom'])

        <label for='streetAddress'>* Street Address</label>
        <input dusk='streetAddress-input' type='text' name='streetAddress' id='streetAddress' value='{{ old("streetAddress", $student->streetAddress) }}'>
        @include('includes.error-field', ['fieldName'=>'streetAddress'])

        <br>
        <input dusk='update-button' type='submit' class="btn btn-primary" value='Update'>

    </form>
</div>
@endsection