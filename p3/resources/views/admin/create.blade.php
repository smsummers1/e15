@extends('layouts.master')

@section('portal')
Admin Portal
@endsection

@section('user')
Hi, User
@endsection

@section('adminPortal')
<br><br>
<h2>Upload New Data Files</h2>

<h4>Want to add new data to the volunteer hours database? Not a problem- you can add it here!</h4>
<br><br>

<div class="alert alert-secondary" role="alert">
    <form method='POST' action='/admin'>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}

        <label for='fileType' class="col-form-label-lg">* Select File Type</label>
        <select id='fileType' name="fileType">
            <option value="Students" {{ (old('fileType') == 'Students') ? 'selected="selected"' : ''}}> Students </option>

            <option value="IDK" {{ (old('fileType') == 'IDK') ? 'selected="selected"' : ''}}> Indent-a-Kid </option>

            <option value="PTA" {{ (old('fileType') == 'PTA') ? 'selected="selected"' : ''}}> PTA </option>

            <option value="Off-Site" {{ (old('fileType') == 'Off-Site') ? 'selected="selected"' : ''}}> Off-Site </option>
        </select>

        <br>

        <label for="fileUpload">* Select a file to upload:</label>
        <input style="float:left;" type="file" id="fileUpload" name="fileUpload"><br><br>

        <br>

        <label for='description'>* Description</label>
        <textarea name='description'>{{ old("description") }}</textarea>

        <br>

        <input type='submit' class="btn btn-primary" value='Upload'>

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