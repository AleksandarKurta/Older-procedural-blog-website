<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Post{
	
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function getOnePost($id){
		$query = "SELECT * FROM tbl_post WHERE id = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function getRelatedPost($catid){
		$query = "SELECT * FROM tbl_post WHERE cat = '$catid' ORDER BY rand() LIMIT 6";
		$result = $this->db->select($query);
		return $result;
	}
	
		public function getPostFromCat($id){
		$query = "SELECT * FROM tbl_post WHERE cat = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function getPosts(){
		$query = "SELECT * FROM tbl_post limit 5";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function searchPosts($search){
		$query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function insertPost($data, $file){
		$title = mysqli_real_escape_string($this->db->link, $data['title']);
		$cat = mysqli_real_escape_string($this->db->link, $data['cat']);
		$body = mysqli_real_escape_string($this->db->link, $data['body']);
		$tags = mysqli_real_escape_string($this->db->link, $data['tags']);
		$author = mysqli_real_escape_string($this->db->link, $data['author']);
		
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];
	
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "upload/".$unique_image;
		
		if($title == "" || $cat == "" || $body == "" || $tags == "" || $author == "" || $file_name == "" ){
			echo "<span class='error'>Field must not be empty!</span>";
		}elseif ($file_size >1048567) {
			echo "<span class='error'>Image Size should be less then 1MB!</span>";
		} elseif (in_array($file_ext, $permited) === false) {
			echo "<span class='error'>You can upload only:-"
			.implode(', ', $permited)."</span>";
		}else{
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "INSERT INTO tbl_post(cat,title, body, image, author, tags) VALUES('$cat', '$title', '$body','$uploaded_image', '$author', '$tags')";
			$insert_row = $this->db->insert($query);
			if($insert_row){
				echo "<span class='success'>Data Inserted Successfully</span>";
			}else{
				echo "<span class='error'>>Data Not Inserted.</span>";
			}
		}
	}
	
	public function showListOfPosts(){
		$query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat = tbl_category.id ORDER BY tbl_post.title DESC";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function updatePost($data, $file, $postid){
		$title = mysqli_real_escape_string($db->link, $data['title']);
		$cat = mysqli_real_escape_string($db->link, $data['cat']);
		$body = mysqli_real_escape_string($db->link, $data['body']);
		$tags = mysqli_real_escape_string($db->link, $data['tags']);
		$author = mysqli_real_escape_string($db->link, $data['author']);
		
		
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];
	
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "upload/".$unique_image;
		
		if($title == "" || $cat == "" || $body == "" || $tags == "" || $author == ""  ){
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
			$query = "UPDATE tbl_post 
					  SET
					  cat    = '$cat',
					  title  = '$title',
					  body   = '$body',
				      image  = '$uploaded_image',
					   tags   = '$tags',
					  author   = '$author'
					  WHERE id = '$postid'";
					  
			$updated_row = $db->update($query);
			if($updated_row){
				echo "<span class='success'>Data Updated Successfully</span>";
			}else{
				echo "<span class='error'>>Data Not Updated.</span>";
			}	
		}
	  }else{
			$query = "UPDATE tbl_post 
					  SET
					  cat    = '$cat',
					  title  = '$title',
					  body   = '$body',
					  tags   = '$tags',
					  author   = '$author'
					  WHERE id = '$postid'";
					  
			$updated_row = $db->update($query);
			if($updated_row){
				echo "<span class='success'>Data Updated Successfully</span>";
			}else{
				echo "<span class='error'>>Data Not Updated.</span>";
			}
	    }
	  }
	}	
	
	public function getPostForUpdate($postid){
		$query = "SELECT * FROM tbl_post WHERE id = '$postid' ORDER BY id DESC";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function deletePost($postid){
		$query = "SELECT * FROM tbl_post WHERE id = '$postid'";
		$getdata = $this->db->select($query);
		if($getdata){
			while($delimg = $getdata->fetch_assoc()){
				$dellink = $delimg['image'];
				unlink($dellink);
			}
		}
		
		$delquery = "DELETE FROM tbl_post WHERE id = '$postid'";
		$deldata = $this->db->delete($delquery);
		if($deldata){
			echo "<script>alert('Data Deleted Successfully.')</script>";
			echo "<script>window.location = 'postlist.php'; </script>";
		}else{
			echo "<script>alert('Data Not Deleted.')</script>";
			echo "<script>window.location = 'postlist.php'; </script>";
		}
	}
}
?>
