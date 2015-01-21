<?php

if(isset($login)){
	
	if($login->messages){
		foreach($login->messages as $message){
			echo $message;
		}
	}

	if($login->warnings){
		foreach($login->warnings as $warning){
			echo $warning;
		}
	}
}

?>

Welcome, <?php echo $_SESSION['user']; ?>, to login-php!<br /><a href='index.php?logout'>Logout</a>

User area

