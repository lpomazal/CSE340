<?php
// accounts controller
// Get the accounts model
require_once '../model/accounts-model.php';
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
switch ($action) {
     case 'login':
     include '../views/login.php';
      // Filter and store the data
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        echo $clientEmail;
        exit;      
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
      
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
      
      // Check for missing data
      if (empty($clientEmail) || empty($checkPassword)) {
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../views/registration.php';
        exit;
      }
      
      // Send the data to the model
      $regOutcome = regClient($clientEmail, $clientPassword);
      
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
      
   
 
  case 'register':
    
  // Filter and store the data
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

    $checkPassword = checkPassword($clientPassword);
    $clientEmail = checkEmail($clientEmail);
    $existingEmail = checkExistingEmail($clientEmail);
  // Check for existing email address in the table
  if($existingEmail){
  $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
  include '../view/login.php';
  exit;
  }

  // Check for missing data
  if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
    
    $message = '<p>Please provide information for all empty form fields.</p>';
    include '../views/registration.php';
    exit;
  }
  // Hash the checked password
  $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

  // Send the data to the model
  $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

  // Check and report the result
  if($regOutcome === 1){
    setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
    $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
    include header('Location: /phpmotors/accounts/?action=login');

    exit;
  } else {
    $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
    include '../views/registration.php';
    exit;
  }
  break;
}


// Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action');
}
?>