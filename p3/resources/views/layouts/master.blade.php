<!DOCTYPE html>
<html lang='en'>

<head>
    <title>@yield('title', 'Volunteer Hours')</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='/css/vhours.css' rel='stylesheet'>

    @yield('head')
</head>

<body>

    @if(session('flash-alert'))
    <div class='flash-alert'>
        {{ session('flash-alert') }}
    </div>
    @endif

    <header>
        <div class="container">
            <div class="row">
                <div class="col-1">
                    @if(!Auth::user())
                    @yield('register')
                    @else
                    @yield('portal')
                    @endif
                </div>
                <div class="col-10">
                    <a href='/'><img src='/images/heart.png' id='logo' alt='Volunteer Hours Logo'>
                        <h1>Volunteer Hours</h1>
                    </a>
                </div>
                <div class="col-1">
                    <!-- User logged in, display user's first and last name-->
                    @if(Auth::user())
                    Hi, {{ $user->firstName }}
                    @endif

                    @if(!Auth::user())
                    @yield('login')
                    @else
                    <form method='POST' id='logout' action='/logout'>
                        {{ csrf_field() }}
                        <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <hr>
    </header>

    <section id='main'>
        <!-- Check to see if user is logged in -->
        <!-- For now everyone that logs in is an admin -->
        @if(Auth::user())
        @yield('adminPortal')
        @else
        @yield('content')
        @endif

    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-2">

                </div>
                <div class="col-8">
                    <a href='/support'>Need Support?</a>
                </div>
                <div class="col-2">

                </div>
            </div>
        </div>
    </footer>

</body>

</html>