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

            <nav>
                <?php echo $navList; ?>
            </nav>

            <main>
                <?php if(isset($vehicleDisplay)){
                echo $vehicleDisplay;} ?>
            </main>
            <div>
                    <?php
                    if(isset($buildFormReviewDisplay)){
                        echo $buildFormReviewDisplay;
                        echo '<h2>Comments</h2>';
                        echo $buildCommentsDisplay;
                    }
                    if(isset($mesage)){
                        echo $message;
                    }
                    ?>
            </div>
            <hr>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
            </footer>
        </div>
        <!-Wrapper ends->
    </div>
</body>

</html>