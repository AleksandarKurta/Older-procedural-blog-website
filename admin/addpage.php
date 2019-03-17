<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>	
	    <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Page</h2>
<?php
	if($_SERVER['REQUEST_METHOD'] == "POST" ){
		$pa = new Page();
		$addpage = $pa->addPage();
	}
?>
                <div class="block">  
<?php
	if(isset($addpage)){
		echo $addpage;
	}
?>				
                 <form action="" method="POST" >
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                     


           
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body" ></textarea>
                            </td>
                        </tr>
				
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
		<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>
    <!-- /TinyMCE -->
<?php include 'inc/footer.php'; ?>	