@extends('layouts.master')

@section('adminPortal')
<br><br>
<h2>Upload Student Data Excel File</h2>

<h4>Want to add new student data to the volunteer hours database? Not a problem- you can add it here!</h4>
<br><br>

<div class="alert alert-secondary" role="alert">
    <h6 class="floatLeft"><a href="/">Back</a></h6>
    <br>
    <form method='POST' action="{{ route('import') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class='details'>* Required fields</div>
        <br>
        <label for="fileUpload">* Select a student excel data file to upload:</label>
        <input style="float:left;" type="file" id="fileUpload" name="file"><br><br>
        <br>
        <button class="btn btn-primary">Import Student Data</button>
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