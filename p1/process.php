<?php

session_start();

$inputString = $_POST['inputString'];

function isPalindrome($inputString){
    if(strcasecmp(strrev($inputString), $inputString)==0){
        return 'Yes';
    }else{
        return 'No';
    }
}

function isBigWord($inputString){
    
    if(strlen($inputString) > 7){
        return 'Yes';
    }else{
        return 'No';
    }
}

function vowelCount($inputString){
    
    $lowerInputString = strtolower($inputString);
    
    $aCount = substr_count($lowerInputString, 'a');
    $eCount = substr_count($lowerInputString, 'e');
    $iCount = substr_count($lowerInputString, 'i');
    $oCount = substr_count($lowerInputString, 'o');
    $uCount = substr_count($lowerInputString, 'u');
    
    $totalCount = $aCount + $eCount + $iCount + $oCount + $uCount;
    
    return $totalCount;
}
function letterShift($inputString){
    
    $stringArray = str_split($inputString);
    $stringShift = '';
    
    for($i=0; $i<strlen($inputString); $i++){
       $letterShift = $stringArray[$i];
       $letterShift++;
       $stringShift = $stringShift.$letterShift;
    }
    return $stringShift;   
}

function convertToBinary($inputString){
    $inputArray = str_split($inputString);
    $stringToBinary = '';
    
    for($i=0; $i < strlen($inputString); $i++){
      $charToBinary = decbin(ord($inputArray[$i]));
      $stringToBinary = $stringToBinary.' '.$charToBinary;
    }
    
    return $stringToBinary;
}

$_SESSION['results']= [
    'inputString' => $inputString,
    'isBigWord' => isBigWord($inputString),
    'isPalindrome' => isPalindrome($inputString),
    'vowelCount' => vowelCount($inputString),
    'letterShift' => letterShift($inputString),
    'convertToBinary' => convertToBinary($inputString),
    
];

header('Location: index.php');

//you can set multiple $_SESSION variables
//instead of creating the array on line 16
//like this:

//$_SESSION['isBigWord'] = $isBigWord;
//$_SESSION['isPalindrome'] = $isPalindrome;