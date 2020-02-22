<?php

class StringProcessor
{
    //Properties - the data or characteristics of the class
    private $inputString;
    
    //Methods - the action the class can take
    public function __construct($inputString){
        //define our inputString
        //this is how we set the property on line 6
        $this->inputString = $inputString;
        //test to see if this is working properly by
        //doing a var_dump of the inputString
        var_dump($this->inputString);
    }
    
    public function isPalindrome(){
        if(strcasecmp(strrev($this->inputString), $this->inputString)==0){
            return 'Yes';
        }else{
            return 'No';
        }
    }   

    public function isBigWord(){

        if(strlen($this->inputString) > 7){
            return 'Yes';
        }else{
            return 'No';
        }
    }

    public function vowelCount(){

        $lowerInputString = strtolower($this->inputString);

        $aCount = substr_count($lowerInputString, 'a');
        $eCount = substr_count($lowerInputString, 'e');
        $iCount = substr_count($lowerInputString, 'i');
        $oCount = substr_count($lowerInputString, 'o');
        $uCount = substr_count($lowerInputString, 'u');

        $totalCount = $aCount + $eCount + $iCount + $oCount + $uCount;

        return $totalCount;
    }
    
    public function letterShift(){

        $stringArray = str_split($this->inputString);
        $stringShift = '';

        for($i=0; $i<strlen($this->inputString); $i++){
           $letterShift = $stringArray[$i];
           $letterShift++;
           $stringShift = $stringShift.$letterShift;
        }
        return $stringShift;   
    }

    public function convertToBinary(){
        $inputArray = str_split($this->inputString);
        $stringToBinary = '';

        for($i=0; $i < strlen($this->inputString); $i++){
          $charToBinary = decbin(ord($inputArray[$i]));
          $stringToBinary = $stringToBinary.' '.$charToBinary;
        }

        return $stringToBinary;
    }

    
    
}