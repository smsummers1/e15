<!DOCTYPE html>
<html lang='en'>
<!-- This master page handles the head, header (logging in and out), and the footer-->

<head>
    <title>Volunteer Hours</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='/css/vhours.css' rel='stylesheet'>

    <!-- Favicon - White Heart  -->
    <link rel="icon" type="image/png" href="/images/icons/white-heart-icon.png" />
    @yield('head')

</head>

<body>

    <header>
        <div class="container">

            <!-- Top of Page -->
            <div class="row">

                <!-- Left Top of Page -->
                <div class="col-1">

                    <!-- If Not Logged In - Display Registration Link-->
                    @if(!Auth::user())
                    <a href='/register' dusk='register-link1'>Register</a>
                    @else
                    <!-- Logged In - Display Admin Portal Text-->
                    <a href='/'>Admin Portal</a>
                    @endif
                </div>

                <!-- Center Top of Page -->
                <div class="col-10">
                    <!-- Image and Volunteer Hours Link to Main Page -->
                    <a href='/' dusk='homepage-link'><img src='/images/heart.png' id='logo' alt='Volunteer Hours Logo'>
                        <h1>Volunteer Hours</h1>
                    </a>
                </div>

                <!-- Top Right -->
                <div class="col-1">

                    <!-- Logged In, display Hi and then user's first and last name-->
                    @if(Auth::user())
                    Hi, {{ $user->firstName }}

                    <!-- Logout Link -->
                    <form method='POST' id='logout' action='/logout'>
                        {{ csrf_field() }}
                        <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
                    </form>

                    <!-- Not Logged In, display login link -->
                    @else(!Auth::user())
                    <a href='/login'>Login</a>
                    @endif
                </div>
            </div>
        </div>
        <hr>
    </header>

    <section id='main'>
        <!-- Check to see if user is logged in -->
        <!-- For now everyone that logs in is an admin -->
        <!-- Logged In - show admin welcome page with options-->
        @if(Auth::user())
        @yield('adminPortal')
        @yield('editInfo')

        <!-- Not Logged In -->
        @else(!Auth::user())
        @yield('welcome')
        @yield('register')
        @yield('login')
        @yield('support')
        @endif

        @if(session('flash-alert'))
        <div class='flash-alert'>
            {{ session('flash-alert') }}
        </div>
        @endif
    </section>

    <!-- Bottom of Page -->
    <footer>
        <div class="container">
            <div class="row">
                <!-- Bottom Left -->
                <div class="col-2">
                    <a href="#"><img src="images/icons/bloomz-icon.png" style="width:40px; float:left;"></a>
                </div>
                <!-- Bottom Middle -->
                <div class="col-8">
                    <h5>Our School</h5>
                    <h6>123 Learning Drive</h6>
                    <h6>Winston Salem, NC 27100</h6>
                    <h6>336.333.4444</h6>
                </div>
                <!-- Bottom Right -->
                <div class="col-2">
                    <a href='/support' style="float:right;">Need Support?</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>