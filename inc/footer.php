<?php
	$cr = new Copyright();
	$getcopyright = $cr->getCopyright();
	if($getcopyright){
		while($result = $getcopyright->fetch_assoc()){
?>
<div class="footer">
	<h3><?php echo $result['note']; ?> <?php echo date('Y') ?></</h3>
</div>
<?php
		}
	}
?>
</div>
</body>
</html>
