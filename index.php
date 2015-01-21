<?php

include('config/db.php');

include('includes/Login.php');

$login = new Login();

if($login->getPrivileges()=== 1){
 		include "views/user.php";
	}
else if($login->getPrivileges()===2){
 		include "views/admin.php";
	}
else{
	include "views/guest.php";
	}

?>