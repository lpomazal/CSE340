<?php
/*
*Main Index
*/
// Get the database connection file
   require_once './library/connections.php';
// Get the phpmotors model for use as needed
   require_once './model/main-model.php';
// Get the accounts model
   require_once './model/accounts-model.php';
// Get the functions library
   require_once './library/functions.php';

   $classArray = getClassifications();
   $navList = displayNav($classArray);

// Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action');
}
switch ($action){
   case 'template':
    include 'template.php';
    break;
   case 'register':
    include 'views/registration.php';
    break;
   }
   ?>