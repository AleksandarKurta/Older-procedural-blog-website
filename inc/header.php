<?php include 'lib/Database.php'; ?>
<?php include 'helpers/Format.php'; ?>
<?php include 'classes/Titleslogan.php'; ?>
<?php include 'classes/Copyright.php'; ?>
<?php include 'classes/Page.php'; ?>
<?php
	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});

	$db = new Database();
	$fm = new Format();
	$po = new Post();
	$ca = new Category();
	$ts = new Titleslogan();
	$cr = new Copyright();
	$pa = new Page();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<?php
	if(isset($_GET['pageid'])){
		$pagetitle = $_GET['pageid'];
		$pages = $pa->getAllPagesTitle($pagetitle);
		if($pages){
			while($result = $pages->fetch_assoc()){ ?>
		<title><?php echo $result['name']; ?>-<?php echo TITLE; ?></title>
		
	<?php	}}}elseif(isset($_GET['id'])){
		$postid = $_GET['id'];
		$posts = $po->getOnePost($postid);
		if($posts){
			while($result = $posts->fetch_assoc()){ ?>
		<title><?php echo $result['title']; ?>-<?php echo TITLE; ?></title>			
	<?php	}}}
	else{ ?>
<title><?php echo $fm->title(); ?>-<?php echo TITLE; ?></title>	
	<?php	}  ?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>
<body>
<div class="wrapper">
	<div class="top">
		<div class="logo">
		<?php
			$gettsl = $ts->getTitleSlogan();
			if($gettsl){
				while($result = $gettsl->fetch_assoc()){
		?>
			<img src="admin/<?php echo $result['logo']; ?>" alt=""  > 
			<h1><?php echo $result['title']; ?></h1>
			<p><?php echo $result['slogan'] ?></p>
		<?php
				}
			}
		?>
		</div>
		<div class="search">
		<form action="search.php" method="get">
			<input type="text" name="search" placeholder="Search...">
			<input type="submit" name="submit" value="Search">
		</form>
		</div>
	</div>
	<div class="nav">
	<?php
		$path = $_SERVER['SCRIPT_FILENAME'];
		$curentpage = basename($path, '.php');
	?>
	<ul>
		<li><a 
		<?php
			if($curentpage == 'index'){
				echo 'id="active"';
			}
		?>
		href="index.php">Home</a></li>
	<?php
		$pages = $pa->getAllPages();
		if($pages){
			while($result = $pages->fetch_assoc()){
	?>
	<li><a 
	<?php
		if(isset($_GET['pageid']) && $_GET['pageid'] == $result['id']){
			echo 'id="active"';
		}
	?>
	href="page.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a> </li>
	<?php
			}
		}
	?>	
		<li><a 
		<?php
			if($curentpage == 'contact'){
				echo 'id="active"';
			}
		?>
		href="contact.php">Contact</a></li>
	</ul>
	</div>