<!doctype html>
<html lang='en'>
<head>
    <title>Mystery Word Scramble</title>
    <meta charset='utf-8'>
    <style>
        #results{
            background-color:darkblue;
            color:white;
            padding: 10px;
            margin: 10px;
        }
    </style>
    
</head>
<body>

<form method='POST' action='process.php'>
    <h1>Mystery Word Scramble</h1>

    <p>Mystery word: kiumppn</p>
    <p>Hint: Halloween’s favorite fruit</p>

    <label>Your guess:</label>
    <input type='text' name='answer' id='answer'>
    
    <button type='submit'>Check answer</button>
</form>

    
        <?php if($results){?>
            <div id='results'>
            <?php echo $results; }?>
            </div>
    
</body>
</html>