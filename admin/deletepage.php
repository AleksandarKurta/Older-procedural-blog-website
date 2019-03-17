<?php include 'inc/header.php'; ?>
<?php
	if(!isset($_GET['delpage']) || $_GET['delpage'] == NULL ){
		echo "<script>window.location = 'index.php'; </script>";
	}else{
		$delid = isset($_GET['delpage']);
		$delpage = $pa->deletePage($delid);
	}


	if(isset($delpage)){
		echo $delpage;
	}
?>