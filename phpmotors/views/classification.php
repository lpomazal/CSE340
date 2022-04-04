<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
    <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>

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
            <h1 id="container"><?php echo $classificationName; ?> vehicles</h1>
                <?php if(isset($message)){
                echo $message; }?>
                <?php if(isset($vehicleDisplay)){
                echo $vehicleDisplay;} ?>
                
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