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
                <div id="boxMain">
                    <div class="container">
                        <img src="/phpmotors/images/delorean.jpg" alt="delorian" style="width:100%;" />
                        <div class="toptext">
                            <h1>Welcome to PHP Motors!</h1>
                            <p class="b"><br><br>DMC Delorian<br>3 Cup Holders<br>Superman Doors<br>Fuzzy Dice!</p>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <div id="inner-grid">
                        <div class="box-container">
                            <div class="box">
                                <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor" />
                            </div>
                            <a href=".">Flux Capacitor</a>
                        </div>
                        <div class="box-container">
                            <div class="box">
                                <img src="/phpmotors/images/upgrades/flame.jpg" alt="Flame Decals" />
                            </div>
                            <a href=".">Flame Decals</a>
                        </div>
                        <div class="box-container">
                            <div class="box">
                                <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers" />
                            </div>
                            <a href=".">Bumper Stickers</a>
                        </div>
                        <div class="box-container">
                            <div class="box">
                                <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Caps" />
                            </div>
                            <a href=".">Hub Caps</a>
                        </div>
                    </div>
                    <div class="grid-container-right">
                        <ul id="review-List">
                            <h2>DMC Delorian Reviews</h2>
                            <li>
                                <p> "So fast it's almost like traveling in time." (4/5)</p>
                            </li>
                            <li>
                                <p> "Coolest ride on the Road" (4/5)</p>
                            </li>
                            <li>
                                <p> "I'm feeling Marty McFly" (5/5)</p>
                            </li>
                            <li>
                                <p> "The most futuristic ride on the road." (4.5/5)</p>
                            </li>
                            <li>
                                <p> "80's living and I love it" (5/5)</p>
                            </li>
                        </ul>
                    </div>
                </div>

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