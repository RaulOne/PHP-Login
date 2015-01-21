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
		

		$this->db=new mysqli(SERVER,USER,PASSWORD,DATABASE);

		if(!$this->db->connect_errno){

			$user=$this->db->real_escape_string($_POST['user']);
			$email=$this->db->real_escape_string($_POST['email']);
			$password=$_POST['password'];
			$password_hash=password_hash($password,PASSWORD_DEFAULT);
			$privileges=1;

			$sql="SELECT user, email, password, privileges FROM usuarios WHERE user='$user';";
			$resource=$this->db->query($sql);

			if($resource->num_rows === 1){

				$this->warnings[] = 'User already exists. Try another user.';
			
			}else{
			
			$sql="INSERT INTO usuarios values('$user','$password_hash','$email','$privileges');";
			$result=$this->db->query($sql);

			if($result){
			
				$this->messages[] = 'User successfully created.';
			
			}else{
			
				$this->warnings[] = 'There was some problem creating new user. Try again';
			
			}
			
			}

			
		}else{
			$this->warnings[] = "Database not working.";
		}

		

	}
}

?>