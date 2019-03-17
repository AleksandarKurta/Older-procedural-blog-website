<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Titleslogan{
	
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function getTitleSlogan(){
		$query = "SELECT * FROM title_slogan WHERE id = '1'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function updateTitleSloganLogo(){
		$title = $this->fm->validation($_POST['title']);
		$slogan = $this->fm->validation($_POST['slogan']);
		$title = mysqli_real_escape_string($this->db->link, $title);
		$slogan = mysqli_real_escape_string($this->db->link, $slogan);
		
		$permited  = array( 'png');
		$file_name = $_FILES['logo']['name'];
		$file_size = $_FILES['logo']['size'];
		$file_temp = $_FILES['logo']['tmp_name'];
	
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$same_image = 'logo'.'.'.$file_ext;
		$uploaded_image = "upload/".$same_image;
		
		if($title == "" || $slogan == "" ){
			echo "<span class='error'>Field must not be empty !</span>";
		}else{
	if(!empty($file_name )){
		if ($file_size >1048567) {
		echo "<span class='error'>Image Size should be less then 1MB!
		</span>";
		} elseif (in_array($file_ext, $permited) === false) {
		echo "<span class='error'>You can upload only:-"
		.implode(', ', $permited)."</span>";
		}else{
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "UPDATE title_slogan SET
					title = '$title',
					slogan = '$slogan',
					logo = '$uploaded_image'
					WHERE id = '1'";
		$updated_row = $this->db->update($query);
			if($updated_row){
				echo "<span class='success'>Data Updated Successfully</span>";
			}else{
				echo "<span class='error'>>Data Not Updated.</span>";
			}	
		}
	  }else{
			$query = "UPDATE title_slogan 
					  SET
					  title  = '$title',
					  slogan   = '$slogan'
					  WHERE id = '1'";
					  
			$updated_row = $this->db->update($query);
			if($updated_row){
				echo "<span class='success'>Data Updated Successfully</span>";
			}else{
				echo "<span class='error'>>Data Not Updated.</span>";
			}
	    }
	  }
	}	
	
}