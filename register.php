<?php

include 'config/db.php';

include 'includes/Newuser.php';

$newuser = new Newuser();

include 'views/register.php';

?>