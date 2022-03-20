<?php
if($_SESSION['loggedin']!=true){
    require __DIR__.'/../index.php'; 
    exit;}
?><!DOCTYPE html>
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

            <nav>
                <?php echo $navList; ?>
            </nav>

            <main>
                <h1>Welcome <?=$_SESSION['clientData']['clientFirstname']; ?></h1>
                    <ul>
                        <li>Email Address: <?=$_SESSION['clientData']['clientEmail']; ?></li>
                        <li>First Name: <?=$_SESSION['clientData']['clientFirstname'];  ?></li>
                        <li>Last Name: <?=$_SESSION['clientData']['clientLastname'];  ?></li>
                    </ul>
                    <?=$_SESSION['clientData']['clientLevel'] >1 ? '<p><a href="/phpmotors/vehicles/index.php">Go to Vehicle Conrols</a></p>' : ''; ?>
                    <?=$_SESSION['loggedin']=true ? '<p><a href="/phpmotors/views/client-update.php">Update Information</a></p>' : ''; ?> 
 
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