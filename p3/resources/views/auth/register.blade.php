@extends('layouts.master')

@section('content')
<br><br>
<h1>Register</h1>

Already have an account? <a href='/login'>Login here...</a>

<form method='POST' action='{{ route('register') }}'>
    {{ csrf_field() }}

    <label for='email'>E-Mail Address</label>
    <input id='email' type='email' name='email' value='{{ old('email') }}' required>
    @include('includes.error-field', ['fieldName' => 'email'])

    <label for='password'>Password (min: 8)</label>
    <input id='password' type='password' name='password' required>
    @include('includes.error-field', ['fieldName' => 'password'])

    <label for='password-confirm'>Confirm Password</label>
    <input id='password-confirm' type='password' name='password_confirmation' required>

    <label for='firstName'>First Name</label>
    <input id='firstName' type='text' name='firstName' value='{{ old('firstName') }}' required autofocus>
    @include('includes.error-field', ['fieldName' => 'firstName'])

    <label for='lastName'>Last Name</label>
    <input id='lastName' type='text' name='lastName' value='{{ old('lastName') }}' required autofocus>
    @include('includes.error-field', ['fieldName' => 'lastName'])

    <label for='phone'>Phone Number</label>
    <input id='phone' type='tel' name='phone' placeholder='333-333-4444' pattern='[0-9]{3}-0-9]{3}-0-9]{4}' value='{{ old('phone') }}' required>
    @include('includes.error-field', ['fieldName' => 'phone'])

    <label for='streetAddress'>Street Address</label>
    <input id='streetAddress' type='text' name='streetAddress' value='{{ old('streetAddress') }}' required autofocus>
    @include('includes.error-field', ['fieldName' => 'streetAddress'])

    <label for='city'>City</label>
    <input id='city' type='text' name='city' value='{{ old('city') }}' required autofocus>
    @include('includes.error-field', ['fieldName' => 'city'])

    <label for='state'>State</label>
    <input id='state' type='text' name='state' value='{{ old('state') }}' required autofocus>
    @include('includes.error-field', ['fieldName' => 'state'])

    <label for='zipcode'>Zipcode</label>
    <input id='zipcode' type='text' name='zipcode' value='{{ old('zipcode') }}' required autofocus>
    @include('includes.error-field', ['fieldName' => 'zipcode'])

    <!--All users are initially entered as users....will be manually changed in the database for those that are admin or both -->
    <input type="hidden" id="accountType" name="accountType" value="user">

    <button type='submit' class='btn btn-primary'>Register</button>
</form>
@endsection