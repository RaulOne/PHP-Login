<?php

class Login{
	//Creating a variable for database
	private $db = null;

	public $messages = array();
	//Creating an array for echoing warnings
	public $warnings = array();
	//Creating an array for echoing messages
	public function __construct(){
		//Absolutely necessary to start session se we can keep logged in.
		session_start();
		//We logout if logout is set
		if(isset($_GET['logout'])){
			$this->doLogout();
		}
		//And we login if login is set
		elseif(isset($_POST['login'])){
			$this->doLogin();
		}
	}

	private function doLogin(){		
		//This creates a new mysqli instance
		$this->db= new mysqli(SERVER,USER,PASSWORD,DATABASE);
		//If there is no errors then we..
		if(!$this->db->connect_errno){
			//Check if user exists escaping the variable just to be protected against java, html, sql injections
			$user=$this->db->real_escape_string(strip_tags($_POST['user'],ENT_QUOTES));

			$sql="SELECT user, password, email, privileges FROM usuarios WHERE user='$user' OR email='$user';";
			
			$resources=$this->db->query($sql);
			//If we get a result then user exist 
			if($resources->num_rows===1){
				//and here we check if password it's ok.
				$res_array=$resources->fetch_array();
				//As we have in our database a crypted password we need to use this function to compare the password we get from our form and the crypted password we get from database. This works only from php 5.5.0 or newer
				if(password_verify($_POST['password'],$res_array['password'])){
					$_SESSION['user'] = $res_array['user'];
					$_SESSION['email'] = $res_array['email'];
					$_SESSION['privileges'] = $res_array['privileges'];
					$this->messages[]='Successfully logged in.';

				}else{
					$this->warnings[] = "Password is wrong.";
				}
			}else{
			$this->warnings[] = "This user doesn't exist.";
			}
		}else{
			$this->warnings[]= "Database not working.";
		}

	}
	//This is the function which makes logout and tell us we did it right.
	private function doLogout(){
		$_SESSION = array();
		session_destroy();
		$this->messages[]='Disconnected. Thanks for being with us. Come back soon.';

	}
	//Function to check privileges and return it's value.
	public function getPrivileges(){
		if(isset($_SESSION['privileges']) AND $_SESSION['privileges']==='1'){
			return 1;
		}

		else if(isset($_SESSION['privileges']) AND $_SESSION['privileges']==='2'){
			return 2;
		}else{
			return 0;
		}

	}
	


}

?> 