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

$reviewID = $_SESSION['clientId'];
$reviews = reviewsByUser($reviewId);
$reviewList = '<select name= "reviewId">';
foreach ($reviews as $review) {
  $reviewList .= "<option value= '".urlencode($review['reviewId'])."'>".urlencode($review['firstName'])."</option>";
  } 
$reviewList .= '</select>';

$action = filter_input(INPUT_POST, 'action');
 if($action == NULL){
     $action = filter_input(INPUT_GET, 'action');
 }

switch($action){
  case 'addReview';
  //Store the review id and Text 
  $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_VALIDATE_INT);

  array_pop($clientData);
  $_SESSION['clientData'] = $clientData;

  $addReview = insertReview($reviewText,$reviewDate, $invId, $clientId);
  $_SESSION['message'] = $message;
  header('location: .');
  break;
  
  case 'getreviewsByUser';
  $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
  $reviewInfo = reviewsByUser($reviewId);
  if(count($reviewInfo)<1){
  $message = 'Sorry, no vehicle information could be found.';
      }
  include '../views/reviewsView.php';
  break;
  
  // case 'getreviewByVehicle';
  // $reviewInfo = reviewbyVehicle($invId);
  // include '../views/vehicle-detail.php';
  // break;

  case 'deleteReview';
  
  include '../views/admin.php';
  break;
  case 'confirmReviewDelete';
    include '';
    break;
  case 'updateReview';
  $updateReview = updateReview($reviewId, $reviewDate, $reviewText);
    include '../views/admin.php';
    break;
  case 'default';
    include '';
    exit; 
    ;}
?>