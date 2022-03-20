<?php
if($_SESSION['loggedin']!=true){
    require __DIR__.'/../index.php'; 
    exit;}
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

            <nav>
                <?php echo $navList; ?>
            </nav>

            <main>
                <form action="/phpmotors/accounts/index.php" method="post">

                    <h1>Update Account</h1>

                    <label>First Name

                        <input type="text" name="clientFirstname" placeholder="First Name" id="First Name"
                            title="Can not be empty"
                            <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required></label><br>

                    <label>Last Name

                        <input type="text" name="clientLastname" placeholder="Last Name" id="Last Name"
                            title="Can not be empty"
                            <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required></label><br>

                    <label>Email Address

                        <input type="email" name="clientEmail" placeholder="Email Address" id="Email Address"
                            title="Can not be empty" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>
                            required></label><br>

                    <button type="submit" name="submit" id="regbtn" value="Update">Update</button>

                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updateUser">
                    <input type="hidden" name=$clientid value=$_SESSION[$clientData][$clientid]?>
                </form>
                <form action="/phpmotors/accounts/index.php" method="post">

                    <h1>Update Account Password</h1>

                    <label>Password
                        <span>must be at least 8 characters and contain at least 1 number, 1 capital letter and 1
                            special character</span><br>
                        <input type="password" name="clientPassword" placeholder="Password" title="Can not be empty"
                            required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                            <?php if(isset($clientPassword))?> required></label><br>

                    <button type="submit" name="submit" id="regbtn" value="updatePassword">Update Password</button>

                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updatePassword">
                    <input type="hidden" name=$clientid value=$_SESSION[$clientData][$clientid]?>


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