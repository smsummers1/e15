<!doctype html>
<html lang='en'>
    
<head>
    <title>@yield('title', 'Volunteer Hours')</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!-- My CSS -->
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    
    @yield('head')
    
</head>
    
    
<body>

<header>
    @yield('header')
</header>

<section>
    @yield('form')
</section>
    
<br><br>
<footer>
    &copy; {{ date('Y') }}
</footer>

</body>
    
    
</html>