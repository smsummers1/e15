<?php

session_start();

//save data from the form
//this one with either be sampleOne or sampleTwo from the dropdown list
$inputFile = $_POST['inputFile'];
$studentFirstName = $_POST['studentFirstName'];
$studentLastName = $_POST['studentLastName'];

//check to see which display option the user wants the total number of volunteer hours to be displayed on the screen
//if neither radio button is selected then Minutes will be displayed
if (isset($_POST['timeDisplayHours'])){
    $timeDisplayHours = true;
    $timeDisplayMinutes = false;
}else{
    $timeDisplayHours = false;
    $timeDisplayMinutes = true;
}


if ($inputFile == 'sampleOne'){
    $filename = 'data/sampleVHours1.txt';
    
}else{
    $filename = 'data/sampleVHours2.csv';
}

function fileReadSize($filename){
    $file = fopen($filename, 'r');

    if($file == false){
        echo('Error in opening file');
        exit();
    }

    $filesize = filesize($filename);
    fclose($file);

    return $filesize;
}

function fileReadText($filename){
    $file = fopen($filename, 'r');

    if($file == false){
        echo('Error in opening file');
        exit();
    }

    $filesize = filesize($filename);
    $filetext = fread($file, $filesize);
    fclose($file);

    return $filetext;
}



function totalHours($inputFile, $firstName, $lastName){
    //open file to read
    //if $firstname on the same line as $lastName add minutes to the accumulator $totalMinutes
}

$_SESSION['results'] = [
    'inputFile' => $inputFile,
    'studentFirstName' => $studentFirstName,
    'studentLastName' => $studentLastName,
    'timeDisplayHours' => $timeDisplayHours,
    'timeDisplayMinutes' => $timeDisplayMinutes,
    'fileReadSize' => fileReadSize($filename),
    'fileReadText' => fileReadText($filename),

    
];

//you can set multiple $_SESSION variables
//instead of creating the array on line 16
//like this:

//$_SESSION['isBigWord'] = $isBigWord;
//$_SESSION['isPalindrome'] = $isPalindrome;

header('Location: index.php');