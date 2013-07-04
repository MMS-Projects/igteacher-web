 <?php
if($_SESSION['rights'] < 1){
	echo language(19);
	die();
	}
if($_SESSION['rights'] >= 1){
?>
<h3><?php echo language(37); ?></h3>
<?php 
	if($_SESSION['rights']>2) {


?>

	<a href="<?php echo URL; ?>page/tickets/tribalwars/">Tribalwars</a> |
	<a href="<?php echo URL; ?>page/tickets/west/">The West</a> |
	<a href="<?php echo URL; ?>page/tickets/grepo/">Grepolis</a> |
	<a href="<?php echo URL; ?>page/tickets/forge/">Forge of Empires</a> |
	<a href="<?php echo URL; ?>page/tickets/kartuga/">Kartuga</a> |
	<a href="<?php echo URL; ?>page/tickets/lagoonia/">Lagoonia</a>
	<br />
<?php
	if($_GET['sort']) {
?>
	<a href="<?php echo URL; ?>page/tickets/<?php echo $_GET['sort']; ?>/nl/"><?php echo language(138) ?></a> |
	<a href="<?php echo URL; ?>page/tickets/<?php echo $_GET['sort']; ?>/en/"><?php echo language(139) ?></a> |
	<a href="<?php echo URL; ?>page/tickets/<?php echo $_GET['sort']; ?>/de/"><?php echo language(140) ?></a> 
	<br />
<?php
} else {
?>
	<a href="<?php echo URL; ?>page/tickets/nl/"><?php echo language(138) ?></a> |
	<a href="<?php echo URL; ?>page/tickets/en/"><?php echo language(139) ?></a> |
	<a href="<?php echo URL; ?>page/tickets/de/"><?php echo language(140) ?></a> 
	<br />
<?php
}
if($_GET['lang'] || $_GET['sort']) {
?>
	<a href="<?php echo URL; ?>/page/tickets"><?php echo language(141) ?></a> <br />
<?php
}
}
?>

<a href="<?php echo URL; ?>page/archif"><?php echo language(142); ?></a>
<table>
<tr>
	<th>ID</th>
	<th><?php echo language(8); ?></th>
	<th><?php echo language(28); ?></th>
	<th><?php echo language(29); ?></th>
	<th><?php echo language(30); ?></th>
	<th><?php echo language(10); ?></th>
	<th><?php echo language(104); ?></th>
	<th><?php echo language(31); ?></th>	
	<th  class="lastth"><?php echo language(32); ?></th>
</tr>
<?php

if($_SESSION['rights'] == 1) {
		$query = mysql_query("SELECT * FROM tickets WHERE (takenbyID = '".$_SESSION['userid']."' OR takenbyID IS NULL) AND game = '".$_SESSION['game']."' AND language = '".$_SESSION['language']."' AND subject = 'Aanmelding' AND open < '2'  ORDER BY ID");
} elseif($_SESSION['rights'] == 2){
		$query = mysql_query("SELECT * FROM tickets WHERE game = '".$_SESSION['game']."' AND language = '".$_SESSION['language']."' AND open < '2' ORDER BY ID");
} elseif($_SESSION['rights'] >= 3){
	if(isset($_GET['sort'])){
		$query = mysql_query("SELECT * FROM tickets WHERE game = '".$_GET['sort']."' AND open < '2' AND subject = 'Aanmelding' ORDER BY ID");
	} elseif(isset($_GET['lang'])){
		$query = mysql_query("SELECT * FROM tickets WHERE language = '".$_GET['lang']."' AND open < '2' AND subject = 'Aanmelding' ORDER BY ID");
	} elseif(isset($_GET['sort']) && isset($_GET['lang'])){
		$query = mysql_query("SELECT * FROM tickets WHERE game = '".$_GET['sort']."' AND language = '".$_GET['lang']."' AND open < '2' AND subject = 'Aanmelding' ORDER BY ID");
	}
	else {
		$query = mysql_query("SELECT * FROM tickets WHERE open < '2' AND subject = 'Aanmelding' ORDER BY ID");
	}
}

while($tickets = mysql_fetch_object($query)){
if($tickets->rights <= $_SESSION['rights']){
?>
<tr>
	<td><a href="<?php echo URL.'page/viewticket/'.$tickets->ID; ?>"><?php echo $tickets->ID; ?></a></td>
	<td><a href="<?php echo URL.'page/profile/'.$tickets->userID; ?>"><?php echo username($tickets->userID); ?></a></td>
	<td><?php echo $tickets->subject; ?></td>
	<td><?php echo status($tickets->open); ?></td>
	<td><?php echo priority($tickets->priority); ?></td>
	<td><?php echo rights($tickets->rights); ?></td>
	<td><?php echo $tickets->lastanswer; ?></td>
	<td><?php echo game($tickets->game); ?></td>
	<td  class="lastth"><?php echo $tickets->language; ?></td>
</tr>
<?php
}
}
?>
</table>
<?php
}
else {
	echo language(20);
}
?>