<?php
	if(!isset($_SESSION['rights'])){
		echo language(19);
		die();
	}
	if($_SESSION['rights'] >= 3){
	
?>
<h2>Adminpannel</h2>
<div style="width:200px; float:left;">
	<a href="<?php echo URL; ?>/page/ban">Ban</a><br /><br />
	<a href="<?php echo URL; ?>/page/config"><?php echo language(71); ?></a><br /><br />
	<a href="<?php echo URL; ?>page/translationlist"><?php echo language(88); ?></a><br /><br />
</div>
<div style="width:200px; float:left;">
	<a href="<?php echo URL; ?>page/addnews"><?php echo language(126) ?></a><br /><br />
	<a href="<?php echo URL; ?>page/createuser"><?php echo language(23); ?></a><br /><br />
	<a href="<?php echo URL; ?>page/contact_admin">Bekijk contacten</a><br /><br />
</div>
<br style="clear:both;" />
 


<?php
	} else {
	echo language(20);
}
?>