<?php

//var_dump($_POST);

//initiate the session
session_start();

$answer=$_POST['answer'];

if($answer == 'pumpkin'){
    $results = 'Correct!';
} else {
    $results = 'Incorrect!';
}

//store the session data
$_SESSION['results'] = $results;

//Redirect to the original page with the form
header('Location: index.php');
