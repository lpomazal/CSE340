<?php
if(!($_SESSION['loggedin']==true && $_SESSION['clientData']['clientLevel'] >1)){
    header('location: /phpmotors'); 
    exit;
    }if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
    <title>Content Title | PHP Motors</title>
</head>

<body>
    <div class="flexC">
        <div id="wrapper">
            <header>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
            </header>
            <?php
                if (isset($message)) {
                echo $message;
                }
            ?>
            <nav>
                <?php echo $navList; ?>
            </nav>

            <main>
                <ul>
                    <li><a href="/phpmotors/vehicles/index.php?action=addClassification">Add Vehicle Classification</a>
                    </li>
                    <li><a href="/phpmotors/vehicles/index.php?action=addVehicle">Add New Vehicle</a></li>
                </ul>

                <?php
                    if (isset($message)) { 
                    echo $message; 
                } 
                    if (isset($classificationList)) { 
                    echo '<h2>Vehicles By Classification</h2>'; 
                    echo '<p>Choose a classification to see those vehicles</p>'; 
                    echo $classificationList; 
                }
                ?>
                <noscript>
                    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>
                <table id="inventoryDisplay"></table>

            </main>
            <hr>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
            </footer>
        </div>
        <!-Wrapper ends->
    </div>
    <script src="../js/inventory.js"></script>
</body>

</html>