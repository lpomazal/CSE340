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

