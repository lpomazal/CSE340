<?php
// Get the database connection file
require_once '../library/connections.php';
require_once '../model/vehicles-model.php';
 // Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
 // Get the functions library
require_once '../library/functions.php';

$classArray = getClassifications();
$navList = displayNav($classArray);

$classificationList = '<select name= "classificationId">';
foreach ($classifications as $classification) {
  $classificationList .= "<option value= '".urlencode($classification['classificationId'])."'>".urlencode($classification['classificationName'])."</option>";
  } 
  $classificationList .= '</select>';

$action = filter_input(INPUT_POST, 'action');
  if ($action == NULL){
     $action = filter_input(INPUT_GET, 'action');
  }
switch($action){
    case 'addVehicle':
         include '../views/addVehicle.php';
          break;
    case 'newClassification':
      $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));
      // Check for missing data
    if(empty($classificationName)){
       $message = '<p>Please provide information for all empty form fields.</p>';
         include '../views/addClassification.php';
          exit;
      }
      
      // Send the data to the model
      $newClassification = newClassification($classificationName);
      
      // Check and report the result
      if($newClassification === 1){
        header('Location: /phpmotors/vehicles/');    
         exit;
      } else {
        $message = "<p>Sorry but the ADD failed. Please try again.</p>";
           include '../views/addClassification.php';
            exit;
      }
        break;

    case 'newVehicle':
        $args= new NewInventoryArgs();
        $args->invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $args->invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $args->invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $args->invImage = '/phpmotors/images/no-image.php';
        $args->invThumbnail = '/phpmotors/images/no-image.php';
        $args->invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_STRING));
        $args->invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING));
        $args->invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $args->classificationId = filter_input(INPUT_POST, 'classificationId');        

      // Check for missing data
      if(empty($args->invMake)|| empty($args->invModel)|| empty($args->invDescription)|| empty($args->invImage)|| empty($args->invThumbnail)|| empty($args->invPrice)|| empty($args->invStock)|| empty($args->invColor)|| empty($args->classificationId)){
        $message = '<p>Please provide information for all empty form fields.</p>';
          include '../views/addVehicle.php';
            exit;
      }
      
      // Send the data to the model
      $newInventory = newInventory($args);
      
      // Check and report the result
      if($newInventory === 1){
         header('Location: /phpmotors/vehicles/');    
           exit;
      } else {
         $message = "<p>Sorry but the ADD failed. Please try again.</p>";
           include '../views/addClassification.php';
            exit;
      }
        break;
     case 'addClassification';
       include '../views/addClassification.php';
         break;
     default:
       include '../views/vehicleManagement.php';}
