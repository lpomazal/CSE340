<?php
if($_SESSION['loggedin'] = FALSE;){
    require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/index.php';}
    exit;
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
                <h1>Welcome <?php echo $clientFirstname ?></h1>
                    <ul>
                        <li>Email Address: <?php echo $clientEmail ?></li>
                        <li>First Name: <?php echo $clientFirstname ?></li>
                        <li>Last Name: <?php echo $clientLastname ?></li>
                    </ul>
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