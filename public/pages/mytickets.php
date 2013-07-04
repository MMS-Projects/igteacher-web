<?php
if(!isset($_SESSION['rights'])){
	echo language(19);
	die();
	}
if($_SESSION['rights'] >= 0){
?>
<h3><?php echo language(37); ?></h3>
<table>
<tr>
	<th>ID</th>
	<th><?php echo language(8); ?></th>
	<th><?php echo language(28); ?></th>
	<th><?php echo language(29); ?></th>
	<th><?php echo language(30); ?></th>
	<th><?php echo language(31); ?></th>
	<th><?php echo language(32); ?></th>
</tr>
<?php
	$query = mysql_query("SELECT * FROM tickets WHERE userID = '".$_SESSION['userid']."' ORDER BY ID");
while($tickets = mysql_fetch_object($query)){
?>
<tr>
	<td><a href="<?php echo URL.'page/viewticket/'.$tickets->ID; ?>"><?php echo $tickets->ID; ?></a></td>
	<td><?php echo username($tickets->userID); ?></td>
	<td><?php echo $tickets->subject; ?></td>
	<td><?php echo status($tickets->open); ?></td>
	<td><?php echo priority($tickets->priority); ?></td>
	<td><?php echo game($tickets->game); ?></td>
	<td><?php echo lang($tickets->language); ?></td>
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