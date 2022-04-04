<?php
// Accounts Model

class NewInventoryArgs{public $invMake; public $invModel; public $invDescription; public $invImage; public $invThumbnail; public $invPrice; public $invStock; public $invColor; public $classificationId;};
// Function for adding Car classification

function newClassification($classificationName){
 // Create a connection object using the phpmotors connection function
 $db = phpmotorsConnect();
 // The SQL statement
 $sql = 'INSERT INTO carclassification (classificationName)
     VALUES (:classificationName)';
 // Create the prepared statement using the phpmotors connection
 $stmt = $db->prepare($sql);
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tells the database the type of data it is
 $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Close the database interaction
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

function newInventory(NewInventoryArgs $newInventory){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription , invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
        VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invMake', $newInventory->invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $newInventory->invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $newInventory->invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $newInventory->invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $newInventory->invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $newInventory->invPrice, PDO::PARAM_INT);
    $stmt->bindValue(':invStock', $newInventory->invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $newInventory->invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $newInventory->classificationId, PDO::PARAM_INT);

    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
   }
// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
   }

// Get vehicle information by invId
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
   }
// Update a vehicle
function updateVehicle($invMake, $invModel, $invDescription, $invPrice, $invStock, $invColor, $classificationId,$invImage,$invThumbnail, $invId) {
        $db = phpmotorsConnect();
        $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription,invImage =:invImage, invThumbnail = :invThumnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
      }

// Update a vehicle
function deleteVehicle($invId) {    $db = phpmotorsConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
  }

// Get vehicles by Classification
function getVehiclesByClassification($classificationName){
    $db = phpmotorsConnect();
    // $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
    $sql = "SELECT * FROM inventory INNER JOIN images ON inventory.invId = images.invId
    WHERE classificationId IN(SELECT classificationId FROM carclassification WHERE classificationName = :classificationName) AND imgPrimary = '1' AND images.imgName NOT LIKE '%-tn%'";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
   }

   // Get information for all vehicles
function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}

function getVehicleInfo($invId){
    $db = phpmotorsConnect();
    $sql = "SELECT i.invId, invMake, invModel, invDescription, invStock, invPrice, invColor, imgPath  FROM inventory AS i left  join images ON i.invId = images.invId WHERE i.invId = :invId AND imgPath NOT LIKE '%-tn%'";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId,PDO::PARAM_INT);
    $stmt->execute();
    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicle; 
} //(select imgPath from images where invId = :invId and imgPath LIKE '%-tn%') as imgThumb
function getVehicleInfoThumb($invId){
    $db = phpmotorsConnect();
    $sql = "SELECT i.invId, invMake, invModel, invDescription, invStock, invPrice, invColor, imgPath, imgPrimary  FROM inventory AS i inner join images ON i.invId = images.invId WHERE i.invId = :invId AND imgPath LIKE '%-tn%' AND imgPrimary = '0'";    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId,PDO::PARAM_INT);
    $stmt->execute();
    $vehicle1 = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicle1; 
}
?>