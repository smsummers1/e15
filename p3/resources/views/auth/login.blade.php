@extends('layouts.master')

@section('login')
<br><br>
<h1 dusk='login-heading'>Login</h1>

<p>Don’t have an account? <a href='/register'>Register here...</a></p>

<form method='POST' action='{{ route('login') }}'>

    {{ csrf_field() }}

    <label for='email'>E-Mail Address</label>
    <input id='email' dusk="email-input" type='email' name='email' value='{{ old('email') }}' required autofocus>
    @include('includes.error-field', ['fieldName' => 'email'])

    <label for='password'>Password</label>
    <input id='password' dusk="password-input" type='password' name='password' required>
    @include('includes.error-field', ['fieldName' => 'password'])

    <label>
        <input type='checkbox' name='remember' {{ old('remember') ? 'checked' : '' }}> Remember Me
    </label>

    <button type='submit' dusk="login-button" class='btn btn-primary'>Login</button>

</form>

@endsection