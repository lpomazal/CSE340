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
                <?php
                if (isset($message)) {
                echo $message;
                }
                ?>
                <main>
                    <form action="/phpmotors/vehicles/index.php" method="post">

                        <h1>New Vehicle</h1>

                        <label>Vehicle Make
                            <input type="text" name="invMake" placeholder="Vehicle Make" title="Can not be empty"
                                <?php if(isset($invMake)){echo "value='$invMake'";} ?> required></label><br>
                        <label>Vehicle Model
                            <input type="text" name="invModel" placeholder="Vehicle Model" title="Can not be empty"
                                <?php if(isset($invModel)){echo "value='$invModel'";} ?> required></label><br>
                        <label>Vehicle Description
                            <input type="text" name="invDescription" placeholder="Vehicle Description"
                                title="Can not be empty"
                                <?php if(isset($invDescription)){echo "value='$invDescription'";} ?>
                                required></label><br>
                        <label>Vehicle Price
                            <input type="number" name="invPrice" placeholder="Vehicle Price No Symbols"
                                title="Can not be empty" pattern="[0-9]"
                                <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required></label><br>
                        <label>Vehicle Stock
                            <input type="number" name="invStock" placeholder="Number of Vehicles" pattern="[0-9]"
                                title="Can not be empty" <?php if(isset($invStock)){echo "value='$invStock'";} ?>
                                required></label><br>
                        <label>Vehicle Color
                            <input type="text" name="invColor" placeholder="Vehicle Color" title="Can not be empty"
                                <?php if(isset($invColor)){echo "value='$invColor'";} ?> required></label><br>
                        <label>Vehicle Classification Type
                            <?=$classificationList?></label><br>

                        <input type="hidden" name="action" value="newVehicle">

                        <button type="submit">Add</button>

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