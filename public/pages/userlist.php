<?php
if(!isset($_SESSION['rights'])){
	echo language(19);
	die();
	}
if(!$_SESSION['rights'] >= 1){
	echo language(20);
	die();
	}

	
if(isset($_POST['show'])){
	if($_POST['show'] == 'all')
	$qShow = mysql_query("SELECT * FROM users ORDER BY ID DESC");
	else 
	$qShow = mysql_query("SELECT * FROM users WHERE rights = '".$_POST['show']."' ORDER BY ID DESC");
}
else {
	$qShow = mysql_query("SELECT * FROM users ORDER BY ID DESC");
}
?>

<h3><?php echo language(100); ?></h3>
<form method="POST">
	<label for="show">
		<?php echo language(10); ?>
	<select name="show">
		<option value="all" selected><?php echo language(102); ?></option>
		<option value="1"><?php echo language(11); ?></option>
		<option value="2"><?php echo language(12); ?></option>
		<option value="3"><?php echo language(13); ?></option>
		<option value="0"><?php echo language(101); ?></option>
	</select>
	<input type="submit" />
</form>	
<table>
	<tr>
		<th>ID</th>
		<th class="lastth"><?php echo language(8); ?></th>
	</tr>
	<?php 
		while($oShow = mysql_fetch_object($qShow)){
	?>
	<tr>
		<td><?php echo $oShow->ID; ?></td>
		<td class="lastth"><a href="<?php echo URL; ?>page/profile/<?php echo $oShow->ID; ?>"><?php echo $oShow->username; ?></a></td>
	</tr>
	<?php
		}
	?>
</table>