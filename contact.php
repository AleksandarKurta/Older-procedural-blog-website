<?php include 'inc/header.php'; ?>
<?php
	if($_SERVER['REQUEST_METHOD'] == "POST" ){
		$fname = $fm->validation($_POST['firstname']);
		$lname = $fm->validation($_POST['lastname']);
		$email = $fm->validation($_POST['email']);
		$body = $fm->validation($_POST['body']);
			
		$fname = mysqli_real_escape_string($db->link,$fname);
		$lname = mysqli_real_escape_string($db->link,$lname);
		$email = mysqli_real_escape_string($db->link,$email);
		$body = mysqli_real_escape_string($db->link,$body);
		
		$error = "";
		if(empty($fname)){
			$error = "First name must not be empty !";	
		}elseif(strlen($fname) < 2){
			$error = "First name must have at least 2 characters !";
		}elseif(!ctype_alnum($fname)){
			$error = "First name can contain numbers and letters only !";
		}elseif(empty($lname)){
			$error = "Last name must not be empty !";
		}elseif(strlen($lname) < 2){
			$error = "Last name must have at least 2 characters !";
		}elseif(!ctype_alnum($lname)){
			$error = "Last name can contain numbers and letters only !";
		}elseif(empty($email)){
			$error = "Email field must not be empty !";
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error = "Invalid Email Address!";
		}elseif(empty($body)){
			$error = "Message filed must not be empty !";
		}else{
			$query = "INSERT INTO tbl_contact(firstname, lastname, email, body) VALUES('$fname', '$lname', '$email', '$body')";
			$inserted_row = $db->insert($query);
			if($inserted_row){
				$msg = "Message Sent Successfully !";
			}else{
				$error = "Message Not Sent !";
			}	
		}
	}
?>
<div class="main">
	<div class="maincontent">
	<?php
		if(isset($msg)){
			echo "<span style='color:green'>$msg</span>";
		}
		
		if(isset($error)){
			echo "<span style='color:red'>$error</span>";
		}
	?>
		<form method="POST" action="">
			<table>
			<tr>
				<td>Your First Name:</td>
				<td>
				<input type="text" name="firstname" placeholder="Enter your first name">
				</td>
			</tr>
			<tr>
				<td>Your Last Name:</td>
				<td>
				<input type="text" name="lastname" placeholder="Enter your last name">
				</td>
			</tr>
			<tr>
				<td>Your Email Address:</td>
				<td>
				<input type="text" name="email" placeholder="Enter Email Address">
				</td>
			</tr>
			<tr>
				<td>Your Message:</td>
				<td>
				<textarea name="body"></textarea>
				</td>
			</tr>
			<tr>
				<td></td>
					<td>
					<input type="submit" name="submit" value="Send"/>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>