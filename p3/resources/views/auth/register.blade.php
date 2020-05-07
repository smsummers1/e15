@extends('layouts.master')

@section('register')
<br><br>
<h1 dusk="register-heading">Register</h1>

Already have an account? <a href='/login'>Login here...</a>
<br><br>
<h6>Remember to <a href='/https://www.wsfcsvolunteers.com/'> register </a> with the WSFCS to be allowed to volunteer at any school in the county.</h6>

<form method='POST' action='{{ route('register') }}'>
    {{ csrf_field() }}

    <label for='email'>E-Mail Address</label>
    <input id='email' dusk='email-input' type='email' name='email' value='{{ old('email') }}' required autofocus>
    @include('includes.error-field', ['fieldName' => 'email'])

    <label for='password'>Password (min: 8)</label>
    <input id='password' dusk='password-input' type='password' name='password' required>
    @include('includes.error-field', ['fieldName' => 'password'])

    <label for='password-confirm'>Confirm Password</label>
    <input id='password-confirm' dusk='confirm-password-input' type='password' name='password_confirmation' required>

    <label for='firstName'>First Name</label>
    <input id='firstName' dusk='first-name-input' type='text' name='firstName' value='{{ old('firstName') }}' required>
    @include('includes.error-field', ['fieldName' => 'firstName'])

    <label for='lastName'>Last Name</label>
    <input id='lastName' dusk='last-name-input' type='text' name='lastName' value='{{ old('lastName') }}' required>
    @include('includes.error-field', ['fieldName' => 'lastName'])

    <label for='phone'>Phone Number</label>
    <input id='phone' dusk='phone-input' type='tel' name='phone' placeholder='333-333-4444' pattern='[0-9]{3}-[0-9]{3}-[0-9]{4}' value='{{ old('phone') }}' required>
    @include('includes.error-field', ['fieldName' => 'phone'])

    <label for='streetAddress'>Street Address</label>
    <input id='streetAddress' dusk='street-address-input' type='text' name='streetAddress' value='{{ old('streetAddress') }}' required>
    @include('includes.error-field', ['fieldName' => 'streetAddress'])

    <input type="hidden" id="accountType" name="accountType" value="volunteer">

    <button type='submit' dusk='register-submit-button' class='btn btn-primary'>Register</button>
</form>
@endsection