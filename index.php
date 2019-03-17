<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>
	<div class="main">
		<div class="maincontent">
	<!--Pagination-->
		<?php
		$per_page = 3;
		if(isset($_GET["page"])){
			$page = $_GET["page"];
		}else{
			$page = 1;
		}
		$start_form = ($page-1)*$per_page;
		?>
	<!--Pagination-->
		<?php
			$query = "SELECT * FROM tbl_post LIMIT $start_form, $per_page";
			$post = $db->select($query);
			if($post){
				while($result = $post->fetch_assoc()){
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
	<?php
			}
	?>
	
	<!--Pagination-->
			<?php 
			$query = "SELECT * FROM tbl_post ";
			$result = $db->select($query);
			$total_rows = mysqli_num_rows($result);
			$total_pages = ceil($total_rows/$per_page);
			
			echo "<span class='pagination'><a href='index.php?page=1'>".'First Page'."</a>"; 
			for($i=1;$i<=$total_pages;$i++){
				echo "<a href='index.php?page=".$i."'>".$i."</a>";
			};
			 echo "<a href='index.php?page=$total_pages'>".'Last Page'."</a></span>"?>
	<!--Pagination-->
			<?php }else{ header("Location:notfound.php"); }?>
		</div>
	</div>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>
