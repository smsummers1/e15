<?php
     
session_start();

$results = null;

//check to see if user entered data in the form
if(isset($_SESSION['results'])){
    $results=$_SESSION['results'];
    
    //$isBigWord = $results['isBigWord'];
    //$isPalindrome = $results['isPalindrome'];
    //the two lines above do the same thing as the line below 
    extract($results);
    //extract will extract all keys from a session
    //and assign the values to variables $isBigWord and $isPalindrome
    //again just like the two commented out lines above
    
    //clear out session results
    $_SESSION['results'] = null;
}

require 'index-view.php';