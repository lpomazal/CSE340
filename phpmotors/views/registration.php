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

                <form action="/phpmotors/index.php" method="post">

                    <h1>Create Account</h1>

                    <label>First Name

                        <input type="text" name="clientFirstname" id="clientFirstname" title="Can not be empty"
                            <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required></label><br>

                    <label>Last Name

                        <input type="text" name="clientLasttname" id="Last Name" title="Can not be empty"
                            <?php if(isset($clientLasttname)){echo "value='$clientLasttname'";} ?> required></label><br>

                    <label>Email Address

                        <input type="email" name="clientEmail" id="Email Address" title="Can not be empty"
                            <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required></label><br>

                    <label>Password
                        <span>must be at least 8 characters and contain at least 1 number, 1 capital letter and 1
                            special character</span><br>
                        <input type="password" name="clientPassword" placeholder="Password" title="Can not be empty"
                            required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                            required></label><br>

                    <button type="submit">Registration</button>

                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="register">

                </form>


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