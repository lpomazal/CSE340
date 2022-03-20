<?php
if(!($_SESSION['loggedin']==true && $_SESSION['clientData']['clientLevel'] >1)){
    header('location: /phpmotors'); 
    exit;}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
    <title><?php // Build the classifications option list
        $classifList = '<select name="classificationId" id="classificationId">';
        $classifList .= "<option>Choose a Car Classification</option>";
            foreach ($carClassifications as $classification) {
            $classifList .= "<option value='$classification[classificationId]'";
            if(isset($classificationId)){
            if($classification['classificationId'] === $classificationId){
            $classifList .= ' selected ';}
            } elseif(isset($invInfo['classificationId'])){
            if($classification['classificationId'] === $invInfo['classificationId']){
            $classifList .= ' selected ';}
            }
        $classifList .= ">$classification[classificationName]</option>";}
        $classifList .= '</select>';?></title>
</head>

<body>
    <div class="flexC">
        <div id="wrapper">
            <header>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
            </header>
            <nav>
                <?php echo $navList; ?>
            </nav>
            <main>
                <?php
                if (isset($message)) {
                echo $message;
                }
                ?>
                <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	            echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
                elseif(isset($invMake) && isset($invModel)) { 
	            echo "Modify$invMake $invModel"; }?></h1>
            </main>
            <form action="/phpmotors/vehicles/index.php" method="post">

                <h1>Modify Vehicle</h1>

                <label>Vehicle Make
                    <input type="text" name="invMake"
                        <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>
                        required></label><br>
                <label>Vehicle Model
                    <input type="text" name="invModel"
                        <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>
                        required></label><br>
                <label>Vehicle Description
                <textarea name="invDescription" id="invDescription" required>
                    <?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                    </label><br>
                <label>Vehicle Price
                    <input type="number" name="invPrice" pattern="[0-9]"
                        <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>
                        required></label><br>
                <label>Vehicle Stock
                    <input type="number" name="invStock" pattern="[0-9]"
                        <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>
                        required></label><br>
                <label>Vehicle Color
                    <input type="text" name="invColor"
                        <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>
                        required></label><br>
                <label>Vehicle Classification Type
                    <?=$classificationList?></label><br>

                <input type="hidden" name="action" value="updateVehicle">
                <input type="hidden" name="invId" value="
                <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                elseif(isset($invId)){ echo $invId; } ?>">

                <button type="submit" name="submit" value="Update Vehicle">Modify</button>

            </form>

            </main>
            <hr>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
            </footer>
        </div>
        <!-Wrapper ends->
    </div>
</body>

</html>