<?php include 'inc/header.php'; ?>
<?php
	if(!isset($_GET['id']) || $_GET['id'] == NULL){
		header("Location:index.php");
	}else{
		$id = $_GET['id'];
		$po = new Post();
		$onepost = $po->getOnePost($id);
	}
?>

	<div class="main">
	<div class="maincontent">
	<?php
		if($onepost){
			while($result = $onepost->fetch_assoc()){
	?>
		<div class="post">
			<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
			<h4><?php echo $fm->formatDate($result['date']); ?><a href="#"><?php echo $result['author']; ?></a>
			<img src="admin/<?php echo $result['image']; ?>" alt=""></h4>
			<p><?php echo $result['body']; ?></p>
		</div>
		<div class="relatedpost">
			<h2>Related Articles</h2>
			<?php
				$catid = $result['cat'];
				$relatedpost = $po->getRelatedPost($catid);
				if($relatedpost){
					while($res = $relatedpost->fetch_assoc()){
			?>
			<a href="post.php?id=<?php echo $res['id']; ?>"><img src="admin/<?php echo $res['image']; ?>" alt="" /></a>
			<?php } }else{ echo "No Related Post Available !"; }?>
		</div>
			<?php } }else{ header("Location:notfound.php"); }?>
	</div>
	</div>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>