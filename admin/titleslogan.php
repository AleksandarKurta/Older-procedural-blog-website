<?php include 'inc/header.php'; ?>	
<?php include 'inc/sidebar.php'; ?>	
<style>
.leftside{float:left;width:70%;}
.rightside{float:left;width:20%;}
.rightside img{height:160px;width:170px;}
</style>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$updatetsl = $ts->updateTitleSloganLogo();
	}
?>
<?php
	$ts = new Titleslogan();
	$gettsl = $ts->getTitleSlogan();
	if($gettsl){
		while($result = $gettsl->fetch_assoc()){
?>
                <div class="block sloginblock"> 
				<div class="leftside">
		<?php
			if(isset($updatetsl)){
				echo $updatetsl;	
			}
		?>
                  <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title']; ?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['slogan']; ?>" name="slogan" class="medium" />
                            </td>
                        </tr>
						
						<tr>
							<td>
								<label>Upload Logo</label>
							</td>
							<td>
								<input type="file" name="logo">
							</td>
						</tr>
						 
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
				</div>
					<div class="rightside">
						<img src="<?php echo $result['logo']; ?>" alt="logo" />
					</div>
                </div>
<?php
		}
	}
?>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>	

