<?php
//Reviews Model

function insertReview($reviewText, $invId, $clientId){
$db = phpmotorsConnect();
$sql = 'INSERT INTO reviews (reviewText, reviewDate, invId, clientId) VALUES (:reviewText, :reviewDate, :invId, :clientId)';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
$stmt->execute();
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}

function reviewsByUser($clientId){
$db = phpmotorsConnect();
$sql = 'SELECT r.reviewId, r.reviewDate, r.invId, r.clientId, i.invMake, i.invModel
FROM reviews As r
JOIN inventory AS i
ON r.invId = i.invId
WHERE r.clientId = :clientId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
$stmt->execute();
$reviewList = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $reviewList;
}

function getReviewByClient($clientId) {
$db = phpmotorsConnect();
$sql = 'SELECT reviewText FROM reviews  AS r
JOIN clients AS c
ON r.clientId = c.clientId WHERE r.clientId = :clientId';
$stmt = $db->prepare($sql);
$stmt->bindValue('clientId', $clientId, PDO::PARAM_INT);
$stmt->execute();
$reviewList = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $reviewList;
}

function reviewsById($invId){
$db = phpmotorsConnect();
$sql = 'SELECT *
 FROM reviews AS r
 JOIN inventory AS i 
 ON r.invId=i.invId
 JOIN clients AS c
 ON r.clientId = c.clientId
 WHERE r.invId= :invId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
$stmt->execute();
$reviewList = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $reviewList;
}


function findReview($reviewId){
$db = phpmotorsConnect();
$sql = 'SELECT *
FROM reviews AS r
WHERE r.reviewId = :reviewId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
$stmt->execute();
$reviewList = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $reviewList;
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