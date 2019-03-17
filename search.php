<?php include 'inc/header.php'; ?>
<?php
	if(!isset($_GET['search']) || $_GET['search'] == NULL){
		header("Location:notfound.php");
	}else{
		$search = $_GET['search'];
		$po = new Post();
		$search = $po->searchPosts($search);
	}
?>
	<div class="main">
		<div class="maincontent">
<?php
	if($search){
		while($result = $search->fetch_assoc()){
?>
	<div class="post">
		<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
		<h4><?php echo $fm->formatDate($result['date']); ?><a href="#"><?php echo $result['author']; ?></a></h4>
		 <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
				 
		<?php echo $fm->textShorten($result['body']); ?>
				
		<div class="readmore">
			<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
		</div>
		</div>
<?php } }else{ ?>
		<p>Your Search Not found</p>
<?php } ?>
		</div>
	</div>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>