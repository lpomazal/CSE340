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

  if(empty($reviewText) || empty($clientId) || empty($invId)){
    $message = "You can not create a review without Logging in. Please login to create.";
  include '../views/vehicle-detail.php';    
  exit;
  }

  $reviewDate = time();
  $addReview = insertReview($reviewText, $invId, $clientId);

  if ($addReview === 1){
    $message = "Review Succesfully Added.";
    include '../views/vehicle-details.php';
    exit;
  }else{
    $message = "Error. No review Created.";
    include '../views/vehicle-details.php';
    exit;
  }
  break;
  include '../views/vehicle-detail.php';
  break;

  case 'reviewDisplay':

    // Get the clientId 
       $clientId = filter_input(INPUT_GET, 'clientId', FILTER_SANITIZE_NUMBER_INT); 
    // Fetch the vehicles by classificationId from the DB 
        array_pop($clientReviews);

        $_SESSION['clientReviews'] = $clientReviews;


       $reviewArray = buildUserReviewList($clientReviews); 
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
  $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
  $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
  $reviewInfo = findReview($reviewId);
  if(count(array($reviewInfo))<1){
    $message='<p>Sorry no Revews Found</p>';
  }
  $reviewData = '<div>';
  foreach($reviewInfo as $review){
    $timestamp = $review['reviewDate'];
    $date = date("d F, Y", strtotime($timestamp));
    $reviewData .= "<h3>Reviewd on". $date ."</h3>";
  }
  $reviewData .="</div>";

  foreach($reviewInfo as $review){
    $rt = $review['reviewText'];
  }
  include '../views/review-update.php';
  break;

  case 'udpate-review':
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
    $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    if(empty($reviewText) || empty($reviewText) || empty($invId)){
      $message = "Please fill out all information";
      header('Location: /phpmotors/reviews/?action=edit-review=$reviewId');
      exit;
    }
   $updateReview = updateReview($reviewId, $reviewText);
   
   if($updateReview === 1){
     $message = "Your review has been Updated";
     $_SESSION['message'] = $message;
     include '../views/edit-review.php';
     exit;
    }else{
     $message = "Error updating reivew.";
     include '../views/edit-review.php';
     exit;
   }
    break;
  
  case 'default';
    include '/phpmotors/reviews/';
    break; 
    }
?>