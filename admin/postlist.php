<?php include 'inc/header.php'; ?>	
<?php include 'inc/sidebar.php'; ?>	
<?php include '../classes/Post.php'; ?>	
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<th>No.</th>
						<th>Post Title</th>
						<th>Description</th>
						<th>Category</th>
						<th>Image</th>
						<th>Author</th>
						<th>Tags</th>
						<th>Date</th>
						<th>Action</th>
					</thead>
					<tbody>
		<?php
			$fm = new Format();
			$po = new Post();
			$postlist = $po->showListOfPosts();
			if($postlist){
				$i = 0;
				while($result = $postlist->fetch_assoc()){
					$i++;
		?>
		<tr class="odd gradeX">
			<td><?php echo $i; ?></td>
				<td><a href="editpost.php?editpostid=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></td>
				<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
				<td><?php echo $result['name']; ?></td>
				<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px"/></td>
				<td><?php echo $result['author']; ?></td>
				<td><?php echo $result['tags']; ?></td>
				<td><?php echo $fm->formatDate($result['date']); ?></td>
				<td>
				<a href="editpost.php?editpostid=<?php echo $result['id']; ?>">Edit</a> || <a onclick="return confirm('Are you shure to delete')" href="deletepost.php?delpostid=<?php echo $result['id']; ?>">Delete</a>
			</td>
		</tr>
		<?php
				}
			}
		?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
   <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
 <?php include 'inc/footer.php'; ?>	