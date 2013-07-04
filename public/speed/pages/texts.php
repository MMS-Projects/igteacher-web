<?php
if(!isset($_SESSION['rights'])){
	echo language(19);
	die();
	}
if($_SESSION['rights'] >= 2){

$query = mysql_query("SELECT * FROM speed_texts ");
?>
<table>
	<tr>
		<th>#</th>
		<th class="lastth">Tekst</th>
	</tr>
<?php
while($texts = mysql_fetch_object($query)){
?>
	<tr>
		<td><a href="<?php echo URL.'page/translaterow/'.$texts->id; ?>"><?php echo $texts->id; ?></a></td>
		<td class="lastth"><?php echo $texts->text; ?></td>
	</tr>
<?php
}
?>
</table>
<?php
}
else {
	echo language(20);
}
?>