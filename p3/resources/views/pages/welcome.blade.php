<!-- 
Administrators Portal Welcome page with Main Menu

Once registered and logged in the administrators can choose to:

Upload New Data Files - Each year they upload new excel files to quickly populate the student table (this may need to change in that when  new file is loaded old students get marked as 'Moved' or 'Graduated' in the database rather than just deleted.) [CRUD - Creating]

Generage Reports - Under Hours, reports to send home to parents via email or paper printed (would like to move away from paper printed reports), [CRUD - Read Database]

Edit Student & Volunteer Information - Edit student information, Edit volunteer Information, Add hours, Remove hours,  - [CRUD - Create, Update, Delete]

Get Support - Give contact information to the assistant principal, Jen Rimes, Me, and anyone else who might need assistance.  There will be a form they can submit that will email the correct person with their issue.  Or they can just call the numbers listed on the site.  Might put a map and directions to school for those who may not have that info.

-->

@extends('layouts.master')

<!-- Logged In  - Master checks for Logged In status-->
@section('adminPortal')
<br><br>

<h2 dusk="welcome-administrator-heading">Welcome Administrator!</h2>

<h4>This portal for you to update files, generage reports, edit information, and much more. Choose from one of the options below.</h4>

<br><br>

<!--https://getbootstrap.com/docs/4.1/utilities/spacing/#horizontal-centering -->
<div class="alert alert-dark" role="alert">
    <ul class='mx-auto' style="width:500; list-style:none;">
        <li><a href='/import' style="font-size:25px;">Import New Students</a></li>

        <li><a href='/reports' dusk="reports-link" style="font-size:25px;">Generate Reports</a></li>

        <li><a href='/editInfo' dusk="edit-info-link" style="font-size:25px;">Edit Information</a></li>

    </ul>
</div>
@endsection

<!-- Not Logged In - Master checks for logged in status-->
@section('login')

@endsection


@section('welcome')
<!-- Not Logged In - Master checks for logged in status-->

<h2 dusk='welcome-heading'>Welcome!</h2>
<br><br>
<h3>This is the administrator side of the volunteer hour application. Once logged in, you will be able to upload new data files, generate reports, and edit information in the database.</h3>
<br>
<h5>First time here? Be sure to <a href="/register" dusk='register-link2'>register</a> as a new user and then you can <a href="/login">login</a> immediately after to start working with this application.</h5>

@endsection