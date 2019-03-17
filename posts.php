<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>
<?php
	if(!isset($_GET['category']) || $_GET['category'] == NULL){
		header("Location:notfound.php");
	}else{
		$id = $_GET['category'];
		$po = new Post();
		$postcat = $po->getPostFromCat($id);
	}
?>
<div class="main">
	<div class="maincontent">
	<?php
		if($postcat){
			while($result = $postcat->fetch_assoc()){
	?>
		<div class="post">
			<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
			<h4><?php echo $fm->formatDate($result['date']); ?><a href="#"><?php echo $result['author']; ?></a>
			<img src="admin/<?php echo $result['image']; ?>" alt=""></h4>
			<p><?php echo $fm->textShorten($result['body']); ?></p>
			<div class="readmore">
				<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
			</div>
		</div>
			<?php } }else{ ?>
			<h3>No Post Available In This Category!</h3>
			<?php } ?>
	</div>
	</div>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>