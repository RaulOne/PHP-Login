<?php
//Including DB data
include('config/db.php');
//Including class Login
include('includes/Login.php');
//Creating new instance of Login class
$login = new Login();
//Depending on privileges we will go to one or another page
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