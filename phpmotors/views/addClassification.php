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
                    <form action="/phpmotors/vehicles/index.php?action=newClassification" method="post">

                        <h1>New Classification</h1>

                        <label>Vehicle Classification Type
                            <input type="text" name="classificationName" placeholder="Vehicle Classifcation Type"
                                title="Can not be empty" required></label><br>

                        <button type="submit">Add</button>
                        <input type="hidden" name="action" value="newClassification">

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