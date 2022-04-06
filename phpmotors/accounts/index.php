<?php
// accounts controller
session_start();
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the functions library
require_once '../library/functions.php';
require_once '../model/reviews-model.php';

$classArray = getClassifications();
$navList = displayNav($classArray);

// Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action');
}
switch ($action) {
     case 'login':
    //  include '../views/login.php';
      // Filter and store the data
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));   
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
      
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
      
      // Check for missing data
      if (empty($clientEmail) || empty($checkPassword)) {
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../views/login.php';
        exit;
      }

      $clientData = getClient($clientEmail);

      $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
      
      // Send the data to the model
      //$regOutcome = regClient($clientEmail, $clientPassword);

      if (!$hashCheck) {
        $message = "<p>Sorry $clientFirstname, but the login failed. Please try again.</p>";
        include '../views/login.php';
        exit;
      }

      $_SESSION['loggedin'] = true;

      array_pop($clientData);

      $_SESSION['clientData'] = $clientData;

      include '../views/admin.php';
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
    include '../views/login.php';
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
    header('Location: /phpmotors/accounts/?action=login');

    exit;
    } else {
    $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
    include '../views/registration.php';
    exit;
    }
  case 'getUpdateUser':
    include '../views/client-update.php';
    break;

  case 'updateUser':
    
    // Filter and store the data
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      
      if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
        //check that values are the correct format
        $clientEmail = checkEmail($clientEmail);

        //check if email exists
        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if ($existingEmail) {
            $_SESSION['message'] = '<p class="notice">That email address already exists. Please chose another.</p>';
            include '../view/client-update.php';
            exit;
        }
    }


      if (empty($clientEmail) || empty($clientFirstname) || empty($clientLastname)){
        $message = '<p>Please complete all information for the updated user!</p>';
        include '../views/client-update.php';
        exit;
        }
        // 
        //  // Hash the checked password
        // $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        $updateClient = updateUser($clientId, $clientEmail, $clientFirstname, $clientLastname);
       
        if ($updateClient) {
          //get client id from database and reset session 
          $_SESSION['clientData'] = getClientInfo($clientId);
          $message = "<p>Congratulations $clientFirstname, the User Information was successfully updated.</p>";
          header('Location: /phpmotors/accounts/');
          exit;
        } else {
          $message = "<p>Error. The client was not updated.</p>";
          include '../views/client-update.php';
          exit;
        }
        break;
  case 'updatePassword':
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
    $checkPassword = checkPassword($clientPassword);

  // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    $updatePas = updatePassword($clientId, $hashedPassword);
    if($updatePas) {
      $message = "<p>Contratulations $clientFirstname, your password was sucessfully updated.<p>"; 
      header('Location: /phpmotors/accounts/');
      exit;
      } else {
      $message = "<p> Error. The password was not updated. </p>";
      include '../views/client-update.php';
      exit;
      }
    break;
  case "logout":
    unset($_SESSION['clientData']);
    unset($_SESSION['loggedin']);
    session_destroy();
    header('Location: /phpmotors/index.php');
    exit;
    break;

  default: 
    include '../views/admin.php';
    exit;
  }

// Get the value from the action name - value pair

?>