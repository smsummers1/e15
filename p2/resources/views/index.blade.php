@extends('layouts.master')

@section('header')
    <h1>Volunteer Hour Calculator</h1>
    <p id="subtitle">Calculates the total number of volunteer hours recorded for the specified student</p>
    <br>
@endsection

@section('form')
 <!--
INPUT
-->
<div id="vHourInput">
    <form method='POST' action=''>
        <fieldset>
            <label for='inputFile' id="headerMedium">Choose a Data Set: </label>
            <!-- Create two files for the user to select from a drop down list and then have that file upload to be read and processed then output the users requested data-->
            <br>
            <select id="inputFile" name="inputFile">
              <option value="sampleOne">Sample 1</option>
              <option value="sampleTwo">Sample 2</option>
            </select>
            <br><br><br>

            <p id="headerMedium">Student Name:</p>
            <label for='studentFirstName'> </label>
            <input type='text' name='studentFirstName' id='studentFirstName' placeholder="First" required>
            <br>
            <label for='studentLastName'></label>
            <input type='text' name='studentLastName' id='studentLastName' placeholder="Last" required>
            <br><br><br>

            <p id="headerMedium">Display Total Time As:</p>
            <label for='hours'>Hours</label>
            <input type="radio" id='hours' name='timeDisplayHours' value='hours'><br>
            <label for='minutes'>Minutes</label>
            <input type="radio" id='minutes' name='timeDisplayMinutes' value='minutes'>

            <br><br><br>

            <button type='submit'>Process</button>
        </fieldset>
    </form>
</div>
@endsection


