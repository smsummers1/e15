@extends('layouts.master')

@section('head')
<link href='/css/pages/vhours.css' rel='stylesheet'>
@endsection

@section('portal')
Admin Portal
@endsection

@section('user')
Hi, User
@endsection

@section('adminPortal')
<br><br>

<h2 dusk='edit-info-heading'>Edit Information</h2>

<h4>This is where you can add, update, remove, and delete information in the volunteer database. Choose from one of the options below.</h4>

<br><br>

<!--https://getbootstrap.com/docs/4.1/utilities/spacing/#horizontal-centering -->
<div class="alert alert-dark" role="alert">
    <h6 class="floatLeft"><a href="/">Back</a></h6>
    <br>
    <ul class='mx-auto' style="width:500; list-style:none;">
        <li><a href='#' hidden style="font-size:25px;">Add New Student</a></li>

        <li><a href='#' hidden style="font-size:25px;">Add New Account</a></li>

        <li><a href='/students' dusk="edit-student-link" style="font-size:25px;">Edit Student</a></li>

        <li><a href='/deleteStudent' dusk="remove-student-link" style="font-size:25px;">Remove Student</a></li>

        <li><a href='#' hidden style="font-size:25px;">Edit User Account</a></li>

        <li><a href='#' hidden style="font-size:25px;">Edit Volunteer Hours</a></li>

        <li><a href='#' hidden style="font-size:25px;">Reset Username and/or Password</a></li>

    </ul>
</div>

@endsection