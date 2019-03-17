<?php
	include '../lib/Session.php'; 
	Session::checkSession();
?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>
<?php include '../classes/Post.php'; ?>	
<?php
	$db = new Database();
?>
<?php
	if(!isset($_GET['delpostid']) || $_GET['delpostid'] == NULL){
		echo "<script>window.location = 'postlist.php'; </script>";
	}else{
		$po = new Post();
		$postid = $_GET['delpostid'];
		$deldata = $po->deletePost($postid);
	}
?>