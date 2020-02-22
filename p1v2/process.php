<?php

//includes the StringProcess class file
require 'StringProcessor.php';

session_start();

$inputString = $_POST['inputString'];

//creating a new object called $stringProcessor by instantiating 
//the StringProcessor() class and pass it the $inputString
$stringProcessor = new StringProcessor($inputString);


//Store all our results in one array in the session    
$_SESSION['results']= [
    'inputString' => $inputString,
    'isBigWord' => $stringProcessor->isBigWord(),
    'isPalindrome' => $stringProcessor->isPalindrome(),
    'vowelCount' => $stringProcessor->vowelCount(),
    'letterShift' => $stringProcessor->letterShift(),
    'convertToBinary' => $stringProcessor->convertToBinary(),
    
];

header('Location: index.php');

//you can set multiple $_SESSION variables
//instead of creating the array on line 16
//like this:

//$_SESSION['isBigWord'] = $isBigWord;
//$_SESSION['isPalindrome'] = $isPalindrome;