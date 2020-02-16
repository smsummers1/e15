<?php

session_start();

//deletes any lingering result data
$results = null;

//checks to see if the form has been submitted
if(isset($_SESSION['results'])){
    $results=$_SESSION['results'];
    
    $_SESSION['results'] = null;
}


require 'index-view.php';
