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
	
	<label for="user_name">User - Between 6 and 50 alphanumeric characters</label>
	<input type="text" name="user" id="user_name" pattern="[a-zA-z0-9_.-]{6,50}" required><br />
	<label for="user_email">Email</label>
	<input type="email" name="email" id="user_email" required><br />
	<label for="user_password">Password - Between 6 and 50 characters</label>
	<input type="password" name="password" id="user_password" pattern="[^>]*{6,50}" required><br />
	<label for="user_password_repeat">Repeat password:</label>
	<input type="password" name="password_repeat" id="user_password_repeat" pattern="[^>]*{6,50}" required><br />
	<input type="submit" name="register" value="register">

</form>

<a href="index.php">Back to login</a>