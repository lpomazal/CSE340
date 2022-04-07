<?php
//vehicles controller
session_start();
// Get the database connection file
require_once '../library/connections.php';
require_once '../model/vehicles-model.php';
 // Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
 // Get the functions library
require_once '../library/functions.php';
require_once '../model/reviews-model.php';

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
        $args->invImage = '/phpmotors/images/vehicles/no-image.php';
        $args->invThumbnail = '/phpmotors/images/vehicles/no-image-tn.php';
        $args->invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_STRING));
        $args->invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING));
        $args->invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $args->classificationId = filter_input(INPUT_POST, 'classificationId');        

      // Check for missing data
      if(empty($args->invMake)|| empty($args->invModel)|| empty($args->invDescription)|| empty($args->invImage)|| empty($args->invThumbnail)|| empty($args->invPrice)|| empty($args->invStock)|| empty($args->invColor)|| empty($args->classificationId)||empty($args->invImage)||empty($args->invThumbnail)){
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
     /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */ 
     case 'getInventoryItems': 
      // Get the classificationId 
         $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
      // Fetch the vehicles by classificationId from the DB 
         $inventoryArray = getInventoryByClassification($classificationId); 
      // Convert the array to a JSON object and send it back 
          echo json_encode($inventoryArray); 
          break;
     case 'mod':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if(count($invInfo)<1){
       $message = 'Sorry, no vehicle information could be found.';
      }
      include '../views/vehicle-update.php';
      exit;
      break;

      case 'updateVehicle':
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);


        if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($invImage) || empty($invThumbnail)) {
        $message = '<p>Please complete all information for the updated item! Double check the classification of the item.</p>';
        include '../views/vehicle-update.php';
        exit;
        }
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invPrice, $invStock, $invColor, $classificationId, $invId, $invImage, $invThumbnail);
        if ($updateResult) {
          $message = "<p>Congratulations, the $invMake $invModel was successfully updated.</p>";
          include '../views/vehicle-update.php';
          exit;
        } else {
          $message = "<p>Error. The new vehicle was not updated.</p>";
          include '../views/vehicle-update.php';
          exit;
        } break;
        case 'del':
          $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
          $invInfo = getInvItemInfo($invId);
          if(count($invInfo)<1){
           $message = 'Sorry, no vehicle information could be found.';
          }
          include '../views/vehicle-delete.php';
          exit;
        
        break;
        case 'deleteVehicle':
          $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
          $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
          $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
          
          $deleteResult = deleteVehicle($invId);
          if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
          } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not
          deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
          }		
        break;
        case 'classification':
          $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
          $vehicles = getVehiclesByClassification($classificationName);
          if(!count($vehicles)){
           $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
          } else {
           $vehicleDisplay = buildVehiclesDisplay($vehicles);
          }
          include '../views/classification.php';
          break;
        case 'vehicle-details':
         $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
         $vehicle =  getVehicleInfo($invId);
         $vehicle1 = getVehicleInfoThumb($invId);
        //  $reviewInfo = findReview($invId);

         if($vehicle){
           $vehicleDisplay = buildVehicleDisplay($vehicle, $vehicle1);
           $vehicleDisplay = reviewsbyId($invId);
          }else{
          $message = "<p class='notice'>Sorry, no vehicle could be found.</p>";
         }
         include '../views/vehicle-detail.php';

          break;
        default:
       $classificationList = buildClassificationList($classifications);
       echo $vehicleDisplay;
        exit;       
       include '../views/vehicleManagement.php';}
       ?>