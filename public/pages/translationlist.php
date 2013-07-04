<?php
if(!isset($_SESSION['rights'])){
	echo language(19);
	die();
	}
if($_SESSION['rights'] >= 3){
if($_GET['id']) {

	if($_POST['submit']){
		if($_POST['nl']&&$_POST['en']&&$_POST['de']) {
		$nl = $_POST['nl'];
		$en = $_POST['en'];
		$de = $_POST['de'];
			$query = mysql_query("INSERT INTO texts VALUES('', '$nl', '$en', '$de')");
			if(!$query) {
				echo 'Error2';	
			} else {
				$ul = ''.URL.'/page/translationlist';
				header('Location: '.$ul.'');
			}
		} else {
			echo 'Error';
		}
	}

?>
	<h2><?php echo language(130) ?></h2>
	
			<table>
			<tr>
				<th>NL</th>
				<th>EN</th>
				<th class="lastth">DE</th>
			</tr>
		<form method="POST">
			<tr>
				<td>
					<textarea name="nl"></textarea>
				</td>
				<td>
					<textarea name="en"></textarea>
				</td>
				<td class="lastth">
					<textarea name="de"></textarea>
				</td>
			</tr>

		<input type="submit" name="submit"/>
		</form>
		</table>

<?php
} else {
$query = mysql_query("SELECT * FROM texts ");
?>
<br />
<a href="<?php echo URL; ?>page/translationlist/new"><?php echo language(130) ?></a>
<br />
<br />
<table>
	<tr>
		<th>#</th>
		<th>NL</th>
		<th>EN</th>
		<th class="lastth">DE</th>
	</tr>
<?php
while($texts = mysql_fetch_object($query)){
?>
	<tr>
		<td><a href="<?php echo URL.'page/translaterow/'.$texts->ID; ?>"><?php echo $texts->ID; ?></a></td>
		<td><?php echo $texts->nl; ?></td>
		<td><?php echo $texts->en; ?></td>
		<td class="lastth"><?php echo $texts->de; ?></td>
	</tr>
<?php
}
?>
</table>
<?php
}
}
else {
	echo language(20);
}
?>