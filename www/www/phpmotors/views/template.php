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
    <div id="wrapper">
        <header>
            <?php requre $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>
        <nav>
            <?php requre $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php'; ?>

        </nav>
        <main>
            <h1>Content Title Here</h1>
        </main>
        <hr>
        <footer>
            <?php requre $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>

        </footer>
    </div>
    <!-Wrapper ends->
</body>

</html>