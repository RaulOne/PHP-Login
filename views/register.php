<?php

if(isset($newuser)){
	if($newuser->messages){
		foreach($newuser->messages as $message){
			echo $message;
		}
	}
	if($newuser->warnings){
		foreach($newuser->warnings as $warning){
			echo $warning;
		}
	}
}

?>

<form action="register.php" method="post">
	
	<label for="user_name">User:</label>
	<input type="text" name="user" id="user_name" required>
	<label for="user_email">Email:</label>
	<input type="email" name="email" id="user_email" required>
	<label for="user_password">Password</label>
	<input type="password" name="password" id="user_password" required>
	<label for="user_password_repeat">Repeat password:</label>
	<input type="password" name="password_repeat" id="user_password_repeat" required>
	<input type="submit" name="register" value="register">

</form>

<a href="index.php">Back to login</a>