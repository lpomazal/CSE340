<?php
//Reviews Model

function insertReview($reviewText, $invId, $clientId){
$db = phpmotorsConnect();
$sql = 'INSERT INTO reviews (reviewText, reviewDate, invId, clientId) VALUES (:reviewText, :reviewDate, :invId, :clientId)';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
$stmt->bindValue('clientId', $clientId, PDO::PARAM_INT);
$stmt->execute();
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}

function reviewsByUser($clientId){
$db = phpmotorsConnect();
$sql = 'SELECT reviewId, reviewText, reviewDate, invId, clientId
FROM reviews
WHERE clientId = :clientId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
$stmt->execute();
$reviewList = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $reviewList;
}
function reviewsById($invId){
$db = phpmotorsConnect();
$sql = 'SELECT i.invMake, i.invModel, r.reviewId, r.reviewText, r.reviewDate, r.clientId, c.clientFirstName, c.clientLastName, c.clientId
 FROM reviews AS r
 INNER JOIN inventory AS i 
 ON r.invId=i.invId
 INNER JOIN clients AS c
 ON r.clientId = c.clientId
 WHERE r.invId= :invId
 ORDER BY r.reviewDate';
$stmt = $db->prepare($sql);
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
$reviewList = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $reviewList;
}

function findReview($reviewId){
$db = phpmotorsConnect();
$sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, r.invId, r.clientId, c.clientFirstname, c.clientLastname
FROM reviews AS r
INNER JOIN clients AS c
ON c.invId = r.invId
WHERE r.reviewId = :reviewId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
$stmt->execute();
$review = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $review;
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