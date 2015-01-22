<?php

class Newuser{

	private $db = null;

	public $warnings = array();

	public $messages = array();

	public function __construct(){
		if(isset($_POST['register'])){
			$this->doUser();
		}
	}
	
	private function doUser(){
		
		if(empty($_POST['user'])){
			$this->messages[]='Empty user. Try again.';
		}
		else if(empty($_POST['password'])){
			$this->messages[]='Empty password. Try again.';
		}
		else if(empty($_POST['email'])){
			$this->messages[]='Empty email. Try again.';
		}
		else if(empty($_POST['password_repeat'])){
			$this->messages[]='Empty password repeat. Try again.';
		}
		else if($_POST['password']!=$_POST['password_repeat']){
			$this->messages[]='password and password repeat does not match. Try again.';
		}
		else if( strlen($_POST['password'])<6 || strlen($_POST['password'])>50 ){
			$this->messages[]='password cant be less than 6 characters or more than 50. Try again.';
		}
		else if( strlen($_POST['user'])<6 || strlen($_POST['user'])>50){
			$this->messages[]='user cant be less than 6 characters or more than 50.';
		}
		else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
			$this->messages[]='Email is not valid. Try again.';
		}
		else if(!preg_match('/^[a-zA-Z0-9._-]{6,50}$/',$_POST['user'])){
			$this->messages[]='User must have between 6 and 50 alphanumeric charachers and _,.,-. Try again.';
		}
		else{
		$this->db=new mysqli(SERVER,USER,PASSWORD,DATABASE);

		if(!$this->db->connect_errno){

			$user=$this->db->real_escape_string(strip_tags($_POST['user'],ENT_QUOTES));
			$email=$this->db->real_escape_string(strip_tags($_POST['email'],ENT_QUOTES));
			$password=$_POST['password'];
			$password_hash=password_hash($password,PASSWORD_DEFAULT);
			$privileges=1;

			$sql="SELECT * FROM usuarios WHERE user='$user' OR email='$email';";
			
			$resource=$this->db->query($sql);

			if($resource->num_rows === 1){

				$this->warnings[] = 'User or email already exists. Try another user and email.';
			
			}else{
			
			$sql="INSERT INTO usuarios values('$user','$password_hash','$email','$privileges');";
			
			$result=$this->db->query($sql);

			if($result){
			
				$this->messages[] = 'User successfully created.';
			
			}else{
			
				$this->warnings[] = 'There has been some problem creating new user. Try again';
			
			}
			
			}

			
		}else{
			$this->warnings[] = "Database not working.";
		}

		}

	}
}

?>