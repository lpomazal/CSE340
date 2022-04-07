<img src="/phpmotors/images/site/logo.png" alt="PHP Motors" id="logo" />

<div class="headLog">
<?php if(isset($_SESSION['loggedin']) && $_SESSION['clientData']){
$clientIdNum = $_SESSION['clientData']['clientId'];
echo "<a href= '/phpmotors/accounts/index.php?action=admin&clientId=$clientIdNum'>".$_SESSION['clientData']['clientFristname']."Admin Account  </a>|<a href= '/phpmotors/accounts/index.php?action=logout'>  Log Out</a>";
}else{
    echo '<a href="/phpmotors/index.php?action=login">  My Account</a>';}?>
</div>
