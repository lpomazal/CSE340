<?php
// ini_set('memory_limit', '1024M');
// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the functions library
require_once '../library/functions.php';


// Build a navigation bar using the $classifications array
// $navList = '<ul>';
// $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
// foreach ($classifications as $classification) {
//  $navList .= "<li><a href='/phpmotors/index.php?action=urlencode($classification[classificationName])' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
// }
// $navList .= '</ul>';
$navlist = displayNav($classification);

switch ($action){
    case 'template':
     include 'template.php';
     break;
    default:
     include 'index.php';
     break;
 
 case 'login':
 // Filter and store the data
   $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
   $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
 
   $clientEmail = checkEmail($clientEmail);
   $checkPassword = checkPassword($clientPassword);
 
 // Check for missing data
 if (empty($clientEmail) || empty($checkPassword)) {
   {
   $message = '<p>Please provide information for all empty form fields.</p>';
   include './views/registration.php';
   exit;
 }
 
// Hash the checked password
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

 // Send the data to the model
 $regOutcome = regClient($clientEmail, $hashedPassword);
 
 // Check and report the result
 if($regOutcome === 1){
   $message = "<p>Welcome $clientFirstname.</p>";
   include '../views/login.php';
   exit;
 } else {
   $message = "<p>Sorry $clientFirstname, but the login failed. Please try again.</p>";
   include '../views/login.php';
   exit;
 }
 break;
}
}