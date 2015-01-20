<?php

include('config/db.php');

include('includes/Login.php');

$login = new login();

if($login->logged() === true){
 if($privileges===1)include "views/user.php";
 else include "views/admin.php";
}
else include "views/guest.php";

?>