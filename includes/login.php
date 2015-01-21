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

		if(!$this->db->connect_errno){

			$user=$this->db->real_escape_string($_POST['user']);

			$sql="SELECT user, password, email, privileges FROM usuarios WHERE user='$user' OR email='$user';";
			
			$resources=$this->db->query($sql);

			if($resources->num_rows===1){
				
				$res_array=$resources->fetch_array();

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

	private function doLogout(){
		$_SESSION = array();
		session_destroy();
		$this->messages[]='Disconnected. Thanks for being with us. Come back soon.';

	}

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