<?php
//reviews controller
session_start();
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';

$classArray = getClassifications();
$navList = displayNav($classArray);

$action = filter_input(INPUT_POST, 'action');
 if($action == NULL){
     $action = filter_input(INPUT_GET, 'action');
 }

switch($action){
  case 'addReview':
  //Store the review id and Text 
  $clientId = filter_input(INPUT_POST, 'clientId', FILTER_VALIDATE_INT);
  $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

  if(empty($reviewText)){
    $message = "Review Text can not be Empty";
    header('Location:/phpmotors/vehicles/?action=vehicle&invId=$invId');
    exit;
  }

  $reviewDate = time();
  $addReview = insertReview($reviewText, $reviewDate, $invId, $clientId);

  if ($addReview === 1){
    $message = "Review Succesfully Added.";
    header('Location:/phpmotors/vehicles/?action=vehicle&invId=$invId');
    exit;
  }
  break;

  case 'reviewDisplay':

    // Get the clientId 
       $clientId = filter_input(INPUT_GET, 'clientId', FILTER_SANITIZE_NUMBER_INT); 
    // Fetch the vehicles by classificationId from the DB 
       $reviewArray = buildUserReviewList($clientReviews); 
    // Convert the array to a JSON object and send it back 
        echo json_encode($reviewArray); 
        break;

  case 'deleteReview':
  $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
  $review = reviewsById($invId);
  include '../views/review-delete.php';
  break;
  
  case 'confirmReviewDelete':
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
    $reviewDelete = deleteReview($reviewId);

    if($reviewDelete ===1){
      $message = 'Review deleted successfully';
      header('Location: /phpmotors/accounts');
    }else{
      $message = 'Delete failed. Try Again';
      header('Location: /phpmotors/accounts/');
      exit;
    }
    break;

  case 'editReview':
  $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
  $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

  if(empty($reviewText)){
    $message = "Can not Leave Text Empty";
    header('Location: /phpmotors/reviews/?action=edit-review&reviewId=$reviewId');
    exit;
  }
  $review = reviewsById($invId);
  include '../views/review-update.php';
  break;

  case 'udpate-review':
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
    $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

    if(empty($reviewText)){
      $message = "Can not Leave TExt Empty";
      header('Location: /phpmotors/reviews/?action=edit-review=$reviewId');
      exit;
    }
   $updateReview = updateReview($reviewId, $reviewDate, $reviewText);
   
   if($updateReview === 1){
     $message = "Your review has been Updated";
     header('Location: /phpmotors/accounts');
   }else{
     $message = "Error updating reivew.";
     header('Location: /phpmotors/reviews/?action=edit-review&reviewId=$reviewId');
     exit;
   }
    break;
  
  case 'default';
    include '/phpmotors/reviews/';
    break; 
    }
?>