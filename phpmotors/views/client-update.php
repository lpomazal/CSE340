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
            <?php
                if (isset($message)) {
                echo $message;
                }
                ?>

                <form action="/phpmotors/accounts/index.php" method="post">

                    <h1>Update Account</h1>

                    <label>First Name
                        <input <?php if (isset($clientFirstname)) {echo "value='$clientFirstname'";
                        } elseif (isset($_SESSION['clientData']['clientFirstname'])) {
                        echo "value='" . $_SESSION['clientData']['clientFirstname'] . "'";
                        } ?> type="text" id="clientFirstname" name="clientFirstname" placeholder="first name" required>
                     </label><br>
                    
                     <label>Last Name
                    <input <?php if (isset($clientLastname)) {echo "value='$clientLastname'";
                    } elseif (isset($_SESSION['clientData']['clientLastname'])) {
                    echo "value='" . $_SESSION['clientData']['clientLastname'] . "'";
                    } ?> type="text" id="clientLastname" name="clientLastname" placeholder="last name" required><br>

                    <label>Email Address
                    <input <?php if (isset($clientEmail)) {echo "value='$clientEmail'";
                    } elseif (isset($_SESSION['clientData']['clientEmail'])) {
                    echo "value='" . $_SESSION['clientData']['clientEmail'] . "'";
                    } ?> type="text" id="clientEmail" name="clientEmail" placeholder="email" required><br>
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updateUser">
                    <input type="hidden" name="clientId"
                        value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo ($_SESSION['clientData']['clientId']);}?>">
                    <button type="submit" name="submit" value="updateUser" consolelog='worked'>Update</button>
                </form>
                <form action="/phpmotors/accounts/index.php" method="post">

                    <h1>Update Account Password</h1>

                    <label>Password
                        <span>must be at least 8 characters and contain at least 1 number, 1 capital letter and 1
                            special character</span><br>
                        <input type="password" id="clientPassword" name="clientPassword" placeholder="password"  
                        required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>
                            

                    <button type="submit" name="submit" value="updatePassword">Update Password</button>

                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updatePassword">
                    <input type="hidden" name="clientId"
                        value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo ($_SESSION['clientData']['clientId']);}?>">


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