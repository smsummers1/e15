@extends('layouts.master')

@section('adminPortal')
<br><br>
<h2 dusk="import-new-students-heading">Import New Students</h2>

<h4>Want to add new student data to the volunteer hours database?
    <br>
    Not a problem- you can add it here!</h4>
<br>
<div class="alert alert-secondary" dusk="back-to-admin-main-menu" role="alert">
    <h6 class="floatLeft"><a href="/">Back to Admin Main Menu</a></h6>
    <br>
    <form method='POST' action="{{ route('import') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class='details'>* Excel file required!!!</div>
        <br>
        <label for="fileUpload">* Choose new students file:</label>
        <input style="float:left;" type="file" id="fileUpload" name="file"><br><br>

        <button dusk="import-button" class="btn btn-primary">Import Student Data</button>
    </form>
</div>

@if(count($errors) > 0)
<br><br>
<ul dusk="import-error" class='alert alert-danger' style='list-style-type: none;'>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif

@endsection