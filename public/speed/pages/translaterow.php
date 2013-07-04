<?php
if(isset($_GET['id'])){
if(!isset($_SESSION['rights'])){
	echo language(19);
	die();
	}
if($_SESSION['rights'] >= 2){
if(isset($_POST['submit'])){
	mysql_query("UPDATE speed_texts SET text = '".mysql_real_escape_string($_POST['text'])."' WHERE ID = '".$_GET['id']."'");
	header('location: '.URL.'page/texts');
}
?>
<table>
	<tr>
		<th class="lastth">Tekst</th>
	</tr>
<form method="POST">
<?php
$query = mysql_query("SELECT * FROM speed_texts WHERE ID = '".$_GET['id']."'");
while($texts = mysql_fetch_object($query)){
?>
	<tr>
		<td class="lastth">
			<textarea name="text"><?php echo $texts->text; ?></textarea>
		</td>
	</tr>
<?php
}
?>
<input type="submit" name="submit" value="<?php echo language(85); ?>" />
</form>
</table>
<?php
}
}
?>