<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>	
<?php include '../classes/Category.php'; ?>	
<?php
	if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
		"<script>window.location = 'catlist.php'; </script>";
		//header("Location:catlist.php");
	}else{
		$id = $_GET['catid'];
	}
?>
		<div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$name = $_POST['name'];
		$ca = new Category();
		$updatecat = $ca->updateCategory($id , $name);
	}
?>
<?php
	$ca = new Category();
	$showcat = $ca->showCatById($id);
	if($showcat){
		while($result = $showcat->fetch_assoc()){
?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name"value="<?php echo $result['name']; ?>"  class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
<?php
		}
	}
?>
                </div>
            </div>
	    </div>
<?php include 'inc/footer.php'; ?>	