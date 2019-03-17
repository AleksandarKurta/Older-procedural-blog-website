<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
	
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$note = isset($_POST['note']);
		$updatecopyright = $cr->updateCopyright($note);
	}
?>
                <div class="block copyblock"> 
<?php
	if(isset($updatecopyright)){
		echo $updatecopyright;
	}
?>
<?php
	$cr = new Copyright();
	$getcopyright = $cr->getCopyright();
	if($getcopyright){
		while($result = $getcopyright->fetch_assoc()){
?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['note']; ?>" name="note" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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
