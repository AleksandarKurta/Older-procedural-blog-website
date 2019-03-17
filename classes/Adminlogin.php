<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	Session::checkLogin();
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
	include_once ($filepath.'/../config/config.php');
?>
<?php

class Adminlogin{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function adminLogin($username, $password){
			$username = $this->fm->validation($_POST['username']);
			$password = $this->fm->validation($_POST['password']);
			
			$username = mysqli_real_escape_string($this->db->link,$username);
			$password = mysqli_real_escape_string($this->db->link,$password);
			
			$query = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
			$result = $this->db->select($query);
			if($result != false){
				if($result != false){
				$value = $result->fetch_assoc();
					Session::set("login" ,true);
					Session::set("username" ,$value['username']);
					Session::set("userId" ,$value['id']);
					header("Location:index.php");
				}else{
					echo "<span style='color:red;font-size:18px;'>No result found!!<span>";
				}
			}else{
				echo "<span style='color:red;font-size:18px;'>Username or Password not matched!<span>";
			}
		}
}
?>