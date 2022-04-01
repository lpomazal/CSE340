<?php
if($_SESSION['clientData']['clientLevel'] < 2){
 header('location: /phpmotors/');
 exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
    <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
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
                <h1><?php if(isset($invInfo['invMake'])){ 
	            echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
            </main>
            <form action="/phpmotors/vehicles/index.php" method="post">

                <h1>Delete Vehicle</h1>

                <form method="post" action="/phpmotors/vehicles/">
                    <fieldset>
                        <label for="invMake">Vehicle Make</label>
                        <input type="text" readonly name="invMake" id="invMake" <?php
                        if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>

                        <label for="invModel">Vehicle Model</label>
                        <input type="text" readonly name="invModel" id="invModel" <?php
                        if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>

                        <label for="invDescription">Vehicle Description</label>
                        <textarea name="invDescription" readonly id="invDescription"><?php
                        if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
                        ?></textarea>

                        <input type="submit" class="regbtn" name="submit" value="Delete Vehicle">

                        <input type="hidden" name="action" value="deleteVehicle">
                        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){
                        echo $invInfo['invId'];} ?>">

                    </fieldset>
                </form>
                <p>Confirm Vehicle Deletion. The delete is permanent.</p>
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