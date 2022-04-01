<img src="/phpmotors/images/site/logo.png" alt="PHP Motors" id="logo" />

<div class="headLog"><?php if ($_SESSION['loggedin']==true) {echo '<a href= "/phpmotors/accounts/index.php?action=logout"><button>Log Out</button></a>';}
else {echo '<a href="/phpmotors/index.php?action=login"><button>My Account</button></a>';}?></div>
