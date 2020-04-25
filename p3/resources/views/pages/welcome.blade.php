<!-- 
Administrators Portal Welcome page with Main Menu

Here administrators can choose to:

Upload New Data Files - Each year they upload new excel files to quickly populate the student table (this may need to change in that when  new file is loaded old students get marked as 'Moved' or 'Graduated' in the database rather than just deleted.) [CRUD - Creating]

Generage Reports - Under Hours, reports to send home to parents via email or paper printed (would like to move away from paper printed reports), [CRUD - Read Database]

Edit Student & Volunteer Information - Edit student information, Edit volunteer Information, Add hours, Remove hours,  - [CRUD - Create, Update, Delete]

Get Support - Give contact information to the assistant principal, Jen Rimes, Me, and anyone else who might need assistance.  There will be a form they can submit that will email the correct person with their issue.  Or they can just call the numbers listed on the site.  Might put a map and directions to school for those who may not have that info.

-->

@extends('layouts.master')

@section('head')
<link href='/css/pages/vhours.css' rel='stylesheet'>
@endsection

@if(!Auth::user())
@section('register')
<a href='/register'>Register</a>
@endsection
@else
@section('portal')
Admin Portal
@endsection
@endif

@if(!Auth::user())
@section('login')
<a href='/login'>Login</a>
@endsection
@endif

@section('adminPortal')
<br><br>

@if(Auth::user())
<h2>Welcome!</h2>

<h4>This is the administrative portal for you to update files, generage reports, edit information, and much more. Choose from one of the options below.</h4>

<br><br>

<!--https://getbootstrap.com/docs/4.1/utilities/spacing/#horizontal-centering -->
<div class="alert alert-dark" role="alert">
    <ul class='mx-auto' style="width:500; list-style:none;">
        <li><a href='/admin/create' style="font-size:25px;">Upload New Data Files</a></li>

        <li><a href='/reports' style="font-size:25px;">Generate Reports</a></li>

        <li><a href='/editInfo' style="font-size:25px;">Edit Information</a></li>

    </ul>
</div>

<!-- Not Logged In -->
@else
<h2>Welcome!</h2>
<br><br><br>


@endif

@endsection