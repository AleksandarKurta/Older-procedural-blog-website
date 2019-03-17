<?php include '../classes/Adminlogin.php'; ?>
<?php
	$al = new AdminLogin();
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$loginChk = $al->adminLogin($username, $password);
	}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
		<?php
			if(isset($loginChk)){
				echo $loginChk;
			}
		?>
			<div>
				<input type="text" placeholder="username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>