<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Category{
	
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function getCategory(){
		$query = "SELECT * FROM tbl_category";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function getCategoryInAdmin(){
		$query = "SELECT * FROM tbl_category ORDER BY id DESC";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function addCategory($name){
		$name = mysqli_real_escape_string($this->db->link, $name);
		if(empty($name)){
			echo "<span class='error'>Field must not be empty!</span>";
		}else{
			$query = "INSERT INTO tbl_category(name) VALUES('$name')";
			$catinsert = $this->db->insert($query);
			if($catinsert){
				echo "<span class='success'>Category Inserted Successfully.</span>";
			}else{
				echo "<span class='success'>Category not Inserted.</span>";
			}
		}
	}
	
	public function updateCategory($id , $name){
		$name = mysqli_real_escape_string($this->db->link, $name);
		if(empty($name)){
			echo "<span class='error'>Field must not be empty!</span>";
		}else{
			$query = "UPDATE tbl_category
					SET 
					name = '$name'
					WHERE id = '$id'";
			$update_row = $this->db->update($query);
			if($update_row){
				echo "<span class='success'>Category Updated Successfully.</span>";
			}else{
				echo "<span class='error'>Category not Updated.</span>";
			}
		}
	}
	
	public function showCatById($id){
		$query = "SELECT * FROM tbl_category WHERE id = '$id' ORDER BY id DESC";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function deleteCategory($delid){
		$query = "DELETE FROM tbl_category WHERE id = '$delid'";
		$deldata = $this->db->delete($query);
		if($deldata){
			echo "<span class='success'>Category Deleted Successfully.</span>";
		}else{
			echo "<span class='error'>Category not Deleted.</span>";
		}
	}
	
}	
?>