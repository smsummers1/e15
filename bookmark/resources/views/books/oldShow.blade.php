<!doctype html>
<html lang='en'>
<head>
    <title>{{ $title }}</title>
    <meta charset='utf-8'>
    <link href='/css/bookmark.css' type='text/css' rel='stylesheet'>
</head>
<body>

    <header>
        <a href='/'><img src='/images/bookmark-logo@2x.png' id='logo' alt='Bookmark Logo'></a>
    </header>

    <section>
        <!--  FIRST APPROACH
        
        One way to write this code
        But you end up with code islands that make it hard to be sure 
        that the curly brackets are matching up properly
        so we do something more like the second approach.
        
        <?php #if($bookFound) { ?>
            <h1>{{ $title }}</h1>
            <p>Details about this book will go here...</p>
        <?php #} else {?>
            Book <b>{{ $title }}</b> not found.....
        <?php #} ?>

        OR
        -->
        
        <!--SECOND APPROACH 
        
        <?php #if($bookFound): ?>
            <h1>{{$title}}</h1>
            <p>Details about this book will go here.....</p>
        <?php #else: ?>
            Book <b>{{ $title }}</b> not found.......
        <?php #endif ?>
        
        -->
        
        
        <!-- THIRD APPROACH 
        utilizing blade directives
        -->
        @if($bookFound)
            <h1>{{$title}}</h1>
            <p>Details about this book will go here.....</p>
        @else
            Book {{$title}} not found....
        @endif
        
        
    </section>

    <footer>
        &copy; {{ date('Y') }}
    </footer>

</body>
</html>