<?php
//Reviews Model

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

function reviewsByUser($reviewInfo){
$db = phpmotorsConnect();
$sql = 'SELECT r.reviewText, r.reviewDate, r.clientId, c.clientFirstName, c.clientLastName, i.invId, i.invMake, i.invModel FROM reviews AS r inner JOIN clients AS c ON r.clientId = c.clientId inner JOIN inventory AS i ON r.invId = i.invId where c.clientId like :reviewInfo';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewInfo', $reviewInfo, PDO::PARAM_STR);
$stmt->execute();
$reviewArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $reviewArray;
}

function findReview($invId){
$db = phpmotorsConnect();
$sql = 'SELECT * FROM reviews WHERE invId = :invId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
$stmt->execute();
$reviewInfo = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $reviewInfo;
}
// function reviewbyVehicle($invId){
// $db = phpmotorsConnect();
// $sql = 'SELECT * FROM reviews WHERE invId = :invId';
// $stmt=$db->prepare($sql);
// $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
// $stmt->execute();
// $reviewInfo = $stmt->fetchAll(PDO::PARAM_INT);
// $stmt->closeCursor();
// return $reviewInfo;
// }
function updateReview($reviewId, $reviewDate, $reviewText){
$db = phpmotorsConnect();
$sql = 'UPDATE reviews SET reviewDate = :reviewDate, reviewText = :reviewText WHERE reviewId = :reviewId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
$stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
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
$reviewMatch = $stmt->fetch();
$stmt->closeCursor();
return $reviewMatch;
}

?>