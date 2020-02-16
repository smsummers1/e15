<!DOCTYPE html>
<html lang='en'>
<head>
    <title>e15 Project 1</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!-- My CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <br><br>
    <h1>e15 Project 1</h1>
    <br>
    <form method='POST' action='process.php'>
        <fieldset>
            <label for='inputString'>Enter a string: </label><br>
            <input type='text' name='inputString' id='inputString'><br><br>
            <button type='submit'>Process</button>
        </fieldset>
    </form>
    
    <?php if(isset($results)) : ?>
        <br><br>
        <div id='processedStringData'>
            <br><br>
            
            <!--Display the String Being Processed -->
            <h1 id='processedString' class="glow"><?=$inputString ?></h1>

            <br><br>
            <h2>Big Word</h2>
            <!-- the two lines below do the same thing
                the second line is requesting the variable created
                from the extract() function -->
            <?php //=$results['isBigWord'] ?>
            <?=$isBigWord ?>
            <br><br>
            
            <h2>Palindrome</h2>
            <?php //$results['isPalindrome'] ?>
            <?=$isPalindrome ?>
            <br><br>
            
            <h2>Vowel Count</h2>
            <?=$vowelCount ?>
            <br><br>
            
            <h2>Letter Shift</h2>
            <?=$letterShift ?>
            <br><br>
            
            <h2>Convert To Binary</h2>
            <?=$convertToBinary ?>
            <br><br>
            
        
        </div>
        <br><br><br>
    
    <?php endif ?>
    
</body>
</html>