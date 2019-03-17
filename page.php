<?php include 'inc/header.php'; ?>
<?php
	if(!isset($_GET['pageid']) || $_GET['pageid'] == NULL){
		header("Location:notfound.php");
	}else{
		$id = $_GET['pageid'];
	}
	$pa = new Page();
	$getpage = $pa->getPage($id);
	if($getpage){
		while($result = $getpage->fetch_assoc()){
?>
<div class="main">
		<div class="maincontent">
		<div class="post">
			<h2><?php echo $result['name']; ?></h2>
			<p><?php echo $result['body']; ?></p>
		</div>
		</div>
</div>
<?php } }else{ header("Location:notfound.php");} ?>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>