<?php
//Reviews Model
// Get Review Information from review table
function getReviews() {
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewId, reviewDate, reviewText, i.invId, c.clientId 
    FROM reviews AS r 
    JOIN inventory As i ON  r.invId = i.invId
    JOIN clients AS c on r.clientId = c.clientId';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $reviewArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewArray;
   }
function insertReview($reviewText,$reviewDate, $invId, $clientId){
$db = phpmotorsConnect();
$sql = 'INSERT INTO reviews(reviewText, reviewDate, invId, clientId) VALUES (:reviewText, :reviewDate, :invId, :clientId)';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
$stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
$stmt->bindValue('clientId', $clientId, PDO::PARAM_INT);
$stmt->execute();
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}

function reviewsByUser($clientId){
$db = phpmotorsConnect();
$sql = 'SELECT r.reviewId, r.reviewDate, i.invMake, i.invModel 
 FROM reviews AS r 
 INNER JOIN inventory AS i ON r.invId = i.invId 
 WHERE r.clientId = :clientId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
$stmt->execute();
$reviewClient = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $reviewClient;
}
function reviewsById($invId){
$db = phpmotorsConnect();
$sql = 'SELECT i.invMake, i.invModel, r.reviewId, r.reviewText, r.reviewDate, c.clientFirstName, c.clientLastName, c.clientId
 FROM reviews AS r
 INNER JOIN inventory AS i 
 ON r.invId=i.invId
 INNER JOIN clients AS c
 ON r.clientId = c.clientId
 WHERE r.invId= :invId
 ORDER BY r.reviewDate';
$stmt = $db->prepare($sql);
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $reviews;
}

function findReview($reviewId){
$db = phpmotorsConnect();
$sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, i.invMake, i.invModel
 FROM reviews AS r
 INNER JOIN inventory AS i
 ON r.invId=i.invId
 WHERE r.reviewId = :reviewId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
$stmt->execute();
$reviewInfo = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $reviewInfo;
}

function updateReview($reviewId, $reviewText){
$db = phpmotorsConnect();
$sql = 'UPDATE reviews 
 SET reviewText = :reviewText 
 WHERE reviewId = :reviewId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
$stmt->execute();
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}

function deleteReview($reviewId){
$db = phpmotorsConnect();
$sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reivewId', $reviewId, PDO::PARAM_INT);
$stmt->execute();
$rowsChanged = $stmt->fetch();
$stmt->closeCursor();
return $rowsChanged;
}

?>