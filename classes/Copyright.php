<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Copyright{
	
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function getCopyright(){
		$query = "SELECT * FROM tbl_footer WHERE id = '1'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function updateCopyright($note){
		$note = $this->fm->validation($_POST['note']);
		$note = mysqli_real_escape_string($this->db->link, $note);
		
		if($note == "" ){
			echo "<span class='error'>Field must not be empty !</span>";
		}else{
			$query = "UPDATE tbl_footer SET
					note = '$note'
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