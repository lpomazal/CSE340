<?php
/*
*Proxy connection to phpmotors databse
*/
function phpmotorsConnect(){
$server= 'mysql:3306';
$dbname= 'phpmotors';
$username = 'dbuser';
$password = 'dbpass';
$dsn = "mysql:host=$server;dbname=$dbname";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try{
    $link = new PDO($dsn, $username, $password, $options);
    return $link;
} catch (PDOException $e){
   header('Location: /phpmotors/views/500.php');
}
}
// phpmotorsConnect();
?>