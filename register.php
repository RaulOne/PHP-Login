<?php
//Calling DB data
include 'config/db.php';
//Calling class newuser
include 'includes/Newuser.php';
//Creating class - which handles registration
$newuser = new Newuser();
//We call the register vies/form
include 'views/register.php';

?>