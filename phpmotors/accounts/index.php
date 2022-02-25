<?php
// accounts controller
// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the functions library
require_once '../library/functions.php';

$classArray = getClassifications();
$navList = displayNav($classArray);

// Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action');
}
switch ($action){
    case 'template':
     break;
     case 'login':
      include '../views/login.php';
      break;
    default:
     break;
 
 case 'loginB':
 // Filter and store the data
   $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
   $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
 
   $clientEmail = checkEmail($clientEmail);
   $checkPassword = checkPassword($clientPassword);
 
 // Check for missing data
 if (empty($clientEmail) || empty($checkPassword)) {
   {
   $message = '<p>Please provide information for all empty form fields.</p>';
   include '../views/registration.php';
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