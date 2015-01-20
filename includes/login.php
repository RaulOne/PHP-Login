<?php

class Login{

	private $db = null;

	public $messages = array();

	public $warnings = array();

	public function __construct(){
		
		session_start();

		if(isset($_GET['logout'])){
			$this->doLogout();
		}
		elseif(isset($_POST['login'])){
			$this->doLogin();
		}
	}

	private function doLogin(){		

		$this->db= new mysqli(SERVER,USER,PASSWORD,DATABASE);

		if(!$this->db->errno){

			$user=$this->db->real_escape_string($_POST['user']);

			$sql="SELECT user, password, email, privileges FROM usuarios WHERE user='$user' OR email='$user';";
			$resource=$this->db->query($sql);

			if($resource->num_rows===1){
				if(password_verify($_POST['password'],$resource['password'])){
					$_SESSION['user'] = $resource['user'];
					$_SESSION['email'] = $resource['email'];
					$_SESSION['privileges'] = $resource['privileges'];
					$this->messages[]='Successfully logged in.'
				}else{
					$this->warnings[] = "Password is wrong.";
				}
			}else{
			$this->warnings[] = "This user doesn't exist.";
			}
		}else{
			$this->warnings[]= "Database not working."
		}

	}

	private function doLogout(){

		session_destroy();
		$this->messages[]='Disconnected. Thanks for being with us. Come back soon.';

	}

	public function getPrivileges(){



	}
	


}

?> 