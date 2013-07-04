<?php 
if(!isset($_SESSION['rights'])){
	echo language(19);
	die();
	}	
if($_SESSION['rights'] >= 2){
?>
<h2><?php echo language(135); ?></h2>

<div style="width:200px; float:left;">
	<a href="<?php echo URL; ?>page/statics"><?php echo language(111) ?></a><br />
	<br />
	<a href="<?php echo URL; ?>page/sollicitations"><?php echo language(136) ?></a><br />
	<br />
</div>
<div style="width:200px; float:left;">
	
</div>
<br style="clear:both;" />



<?php
} else {
	echo language(20);
}
?>