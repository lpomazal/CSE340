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
                if (isset ($message)) {
                    echo $message;
                   }
                ?>
                <form action="/phpmotors/index.php" method="post">

                    <h1>LOGIN</h1>

                    <label>Email Address

                        <input type="email" name="clientEmail" id="clientEmail" title="Can not be empty"
                        <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required></label><br>

                    <label>Password
                        <span>must be at least 8 characters and contain at least 1 number, 1 capital letter and 1
                            special character</span><br>
                        <input type="password" name="clientPassword" id="clientPassword" placeholder="Password" title="Can not be empty"
                            required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                            required></label><br>
                    <button type="submit" name="submit" id="loginbtn" value="login">Login</button>

                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="login">

                </form>

                <p>No Account?</p><a href="/phpmotors/index.php?action=register">Sign UP!</a>

            </main>
            <hr>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
            </footer>
        </div>
        <!--Wrapper ends-->
    </div>
</body>

</html>