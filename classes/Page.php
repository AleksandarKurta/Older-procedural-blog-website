<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Page{
	
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function addPage(){
		$name = $this->fm->validation($_POST['name']);
		$body = $this->fm->validation($_POST['body']);
		$name = mysqli_real_escape_string($this->db->link, $_POST['name']);
		$body = mysqli_real_escape_string($this->db->link, $_POST['body']);
		
		if($name == "" || $body == "" ){
			echo "<span class='error'>Field must not be empty !</span>";
		}else{
			$query = "INSERT INTO tbl_page(name,body) VALUES('$name','$body')";
		$insert_row = $this->db->insert($query);
			if($insert_row){
				echo "<span class='success'>Data Inserted Successfully</span>";
			}else{
				echo "<span class='error'>>Data Not Inserted.</span>";
			}	
		}
	}
	
	public function updatePage($id){
		$name = mysqli_real_escape_string($this->db->link, $_POST['name']);
		$body = mysqli_real_escape_string($this->db->link, $_POST['body']);
	
		if($name == "" || $body == "" ){
			echo "<span class='error'>Field must not be empty !</span>";
		}else{
			$query =  "UPDATE tbl_page
					   SET 
					   name = '$name',
					   body = '$body'
					   WHERE id = '$id'";
			$update_row = $this->db->update($query);
			if($update_row){
				echo "<span class='success'>Page Updated Successfully</span>";
			}else{
				echo "<span class='error'>>Page Not Updated.</span>";
			}	
		}
	}
	
	public function getPage($id){
		$query = "SELECT * FROM tbl_page WHERE id = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function getAllPages(){
		$query = "SELECT * FROM tbl_page";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function deletePage($delid){
		$query = "DELETE FROM tbl_page WHERE id = '$delid'";
		$del_data = $this->db->delete($query);
		if($del_data){
			echo "<script>alert('Page Deleted Successfully')</script>";
			echo "<script>window.location = 'index.php'; </script>";
		}else{
			echo "<script>alert('Page Not Deleted')</script>";
			echo "<script>window.location = 'index.php'; </script>";
		}
	}
	
	public function getAllPagesTitle($pagetitle){
		$query = "SELECT * FROM tbl_page WHERE id = '$pagetitle'";
		$result = $this->db->select($query);
		return $result;
	}
}