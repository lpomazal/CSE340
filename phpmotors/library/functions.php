<?php

function checkEmail($clientEmail){
 $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
 function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
   }
// Get the array of classifications
$classArray = getClassifications();

function displayNav($classArray){
   $navList = '<ul>';
   $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>"; 
   foreach($classArray as $singleClass) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($singleClass['classificationName'])."'
    title='View our $singleClass[classificationName] product line'>$singleClass[classificationName]</a></li>";
   }
   $navList .= '</ul>';
   return $navList;
}

$navList = displayNav($classArray);