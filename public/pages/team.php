<h3><?php echo language(6); ?></h3>
<p>
<?php
echo '<strong>'.language(24).'</strong><br />';
$query = mysql_query("SELECT * FROM users WHERE rights = '3'");
if($query){
while($management = mysql_fetch_object($query)){
	echo $management->username.'<br />';
}
}
echo '<br /><strong>'.language(12).'</strong><br />';
$query = mysql_query("SELECT * FROM users WHERE rights = '2'");
if($query){
while($guider = mysql_fetch_object($query)){
	echo $guider->username.'<br />';
}
}
echo '<br /><strong>'.language(11).'</strong><br />';
$query = mysql_query("SELECT * FROM users WHERE rights = '1'");
if($query){
while($mentor = mysql_fetch_object($query)){
	echo $mentor->username.'<br />';
}
}
echo '<br /><strong>'.language(26).'</strong><br />';
$query = mysql_query("SELECT * FROM users WHERE rights = '4'");
if($query){
while($dev = mysql_fetch_object($query)){
	echo $dev->username.'<br />';
}
}
?>
</p>