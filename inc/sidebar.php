<?php
	$ca = new Category;
	$category = $ca->getCategory();
?>
<div class="sidebar">
		<div class="block">
		<h2>Categories</h2>
		<ul>
	<?php
		if($category){
			while($result = $category->fetch_assoc()){
	?>
			<li><a href="posts.php?category=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
	<?php }}else{ ?>	
			<li>No Category Created</li>
	<?php } ?>
		</ul>
	<?php
		$po = new Post();
		$lposts = $po->getPosts();
		if($lposts){
				while($result = $lposts->fetch_assoc()){
	?>
		<div class="popular">
			<h2>Latest Articles</h2>
			<h3><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h3>
			<a href="post.php?id=<?php echo $result['id']; ?>"></a><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
			<p><?php echo $fm->textShorten($result['body'], 120); ?></p>
		</div>
	<?php } }else{ header("Location:404.php");} ?>
			
		</div>
	</div>