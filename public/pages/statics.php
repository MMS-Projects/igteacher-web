<?php
if(!isset($_SESSION['rights'])){
	echo language(19);
	die();
	}
if($_SESSION['rights'] >= 2){
?>
<h2><?php echo language(143); ?></h2>
<?php	
if($_SESSION['rights']>2) {
?>


	<a href="<?php echo URL; ?>page/statics/tribalwars/">Tribalwars</a> |
	<a href="<?php echo URL; ?>page/statics/west/">The West</a> |
	<a href="<?php echo URL; ?>page/statics/grepo/">Grepolis</a> |
	<a href="<?php echo URL; ?>page/statics/forge/">Forge of Empires</a> |
	<a href="<?php echo URL; ?>page/statics/bountyhounds/">Bounty Hounds Online</a> |
	<a href="<?php echo URL; ?>page/statics/lagoonia/">Lagoonia</a>
	<br />
<?php
	if($_GET['sort']) {
?>
	<a href="<?php echo URL; ?>page/statics/<?php echo $_GET['sort']; ?>/nl/"><?php echo language(138) ?></a> |
	<a href="<?php echo URL; ?>page/statics/<?php echo $_GET['sort']; ?>/en/"><?php echo language(139) ?></a> |
	<a href="<?php echo URL; ?>page/statics/<?php echo $_GET['sort']; ?>/de/"><?php echo language(140) ?></a> 
	<br />
<?php
} else {
?>
	<a href="<?php echo URL; ?>page/statics/nl/"><?php echo language(138) ?></a> |
	<a href="<?php echo URL; ?>page/statics/en/"><?php echo language(139) ?></a> |
	<a href="<?php echo URL; ?>page/statics/de/"><?php echo language(140) ?></a> 
	<br />
<?php
}
if($_GET['lang'] || $_GET['sort']) {
?>
	<a href="<?php echo URL; ?>/page/statics"><?php echo language(141) ?></a> <br />
<?php
}
}
?>
<?php

if($_SESSION['rights'] <= 2){
	$tq = mysql_query("SELECT * FROM users WHERE rights = 1 AND language ='".$_SESSION['lang']."' AND game = '".$_SESSION['game']."'");
	$atq = mysql_num_rows($tq);
	$qo  = mysql_query("SELECT * FROM tickets WHERE open != 2 AND game = '".$_SESSION['game']."' AND language = '".$_SESSION['language']."' AND subject = 'Aanmelding' ");
	$qno = mysql_num_rows($qo);
	$qs  = mysql_query("SELECT * FROM tickets WHERE open = '2' AND game = '".$_SESSION['game']."' AND language = '".$_SESSION['language']."' AND subject = 'Aanmelding'");
	$qns = mysql_num_rows($qs);
	$qso  = mysql_query("SELECT * FROM tickets WHERE open != 2 AND game = '".$_SESSION['game']."' AND language = '".$_SESSION['language']."' AND subject = 'Sollicitatie' ");
	$qsno = mysql_num_rows($qso);
	$qss  = mysql_query("SELECT * FROM tickets WHERE open = '2' AND game = '".$_SESSION['game']."' AND language = '".$_SESSION['language']."' AND subject = 'Sollicitatie'");
	$qsns = mysql_num_rows($qss);
} else{
	if(isset($_GET['sort']) && isset($_GET['lang'])){
		$tq = mysql_query("SELECT * FROM users WHERE rights = 1 AND language = '".$_GET['lang']."' AND game = '".$_GET['sort']."'");
		$atq = mysql_num_rows($tq);
		$qg = mysql_query("SELECT * FROM users WHERE rights = 2 AND language = '".$_GET['lang']."' AND game = '".$_GET['sort']."'");
		$qgn = mysql_num_rows($qg);
		$qo  = mysql_query("SELECT * FROM tickets WHERE open != 2 AND language = '".$_GET['lang']."' AND game = '".$_GET['sort']."' AND subject = 'Aanmelding'");
		$qno = mysql_num_rows($qo);
		$qs  = mysql_query("SELECT * FROM tickets WHERE open = '2' AND language = '".$_GET['lang']."' AND game = '".$_GET['sort']."' AND subject = 'Aanmelding'");
		$qns = mysql_num_rows($qs);
		$qso  = mysql_query("SELECT * FROM tickets WHERE open != 2 AND language = '".$_GET['lang']."' AND game = '".$_GET['sort']."' AND subject = 'Sollicitatie'");
		$qsno = mysql_num_rows($qso);
		$qss  = mysql_query("SELECT * FROM tickets WHERE open = '2' AND language = '".$_GET['lang']."' AND game = '".$_GET['sort']."' AND subject = 'Sollicitatie'");
		$qsns = mysql_num_rows($qss);
	} elseif(isset($_GET['sort'])) {
		$tq = mysql_query("SELECT * FROM users WHERE rights = 1 AND game = '".$_GET['sort']."'");
		$atq = mysql_num_rows($tq);
		$qg = mysql_query("SELECT * FROM users WHERE rights = 2 AND game = '".$_GET['sort']."'");
		$qgn = mysql_num_rows($qg);
		$qo  = mysql_query("SELECT * FROM tickets WHERE open != 2 AND game = '".$_GET['sort']."' AND subject = 'Aanmelding'");
		$qno = mysql_num_rows($qo);
		$qs  = mysql_query("SELECT * FROM tickets WHERE open = '2' AND game = '".$_GET['sort']."' AND subject = 'Aanmelding'");
		$qns = mysql_num_rows($qs);
		$qso  = mysql_query("SELECT * FROM tickets WHERE open != 2 AND game = '".$_GET['sort']."' AND subject = 'Aanmelding'");
		$qsno = mysql_num_rows($qso);
		$qss  = mysql_query("SELECT * FROM tickets WHERE open = '2' AND game = '".$_GET['sort']."' AND subject = 'Aanmelding'");
		$qsns = mysql_num_rows($qss);
	} elseif(isset($_GET['lang'])) {
		$tq = mysql_query("SELECT * FROM users WHERE rights = 1 AND language ='".$_GET['lang']."'");
		$atq = mysql_num_rows($tq);
		$qg = mysql_query("SELECT * FROM users WHERE rights = 2 AND language = '".$_GET['lang']."'");
		$qgn = mysql_num_rows($qg);
		$qo  = mysql_query("SELECT * FROM tickets WHERE open != 2 AND language = '".$_GET['lang']."' AND subject = 'Aanmelding'");
		$qno = mysql_num_rows($qo);
		$qs  = mysql_query("SELECT * FROM tickets WHERE open = '2' AND language = '".$_GET['lang']."' AND subject = 'Aanmelding'");
		$qns = mysql_num_rows($qs);
		$qso  = mysql_query("SELECT * FROM tickets WHERE open != 2 AND language = '".$_GET['lang']."' AND subject = 'Aanmelding'");
		$qsno = mysql_num_rows($qso);
		$qss  = mysql_query("SELECT * FROM tickets WHERE open = '2' AND language = '".$_GET['lang']."' AND subject = 'Aanmelding'");
		$qsns = mysql_num_rows($qss);
	} else {
		$tq = mysql_query("SELECT * FROM users WHERE rights = 1")	;
		$atq = mysql_num_rows($tq);
		$qg = mysql_query("SELECT * FROM users WHERE rights = 2");
		$qgn = mysql_num_rows($qg);
		$qo  = mysql_query("SELECT * FROM tickets WHERE open != 2 AND subject = 'Aanmelding'");
		$qno = mysql_num_rows($qo);
		$qs  = mysql_query("SELECT * FROM tickets WHERE open = '2' AND subject = 'Aanmelding'");
		$qns = mysql_num_rows($qs);
		$qso  = mysql_query("SELECT * FROM tickets WHERE open != 2 AND subject = 'Sollicitatie'");
		$qsno = mysql_num_rows($qso);
		$qss  = mysql_query("SELECT * FROM tickets WHERE open = '2' AND subject = 'Sollicitatie'");
		$qsns = mysql_num_rows($qss);
	}
}

?>
<h3>Tickets</h3>
<strong>Aanmeldingen</strong><br />
<table style="width:250px;">
	<tr>
		<td>Aantal open aanmeldingen</td>
		<td  class="lastth"><?php echo $qno; ?></td>
	</tr>
	<tr>
		<td>Aantal gesloten aanmeldingen</td>
		<td class="lastth"><?php echo $qns; ?></td>
	</tr>
</table>
<br />
<strong>Sollicitaties</strong><br />
<table style="width:250px;">
	<tr>
		<td>Aantal open sollicitaties:</td>
		<td  class="lastth"><?php echo $qsno; ?></td>
	</tr>
	<tr>
		<td>Aantal gesloten sollicitaties</td>
		<td class="lastth"><?php echo $qsns; ?></td>
	</tr>
</table>
<h2>Statiestieken mentoren</h2>
<h3>Mentoren</h3>
Aantal mentoren: <?php echo $atq; ?><br />
<?php
	while ($teacher = mysql_fetch_object($tq)) {
	$id = $teacher->ID;
	$qso = mysql_query("SELECT * FROM tickets WHERE takenbyID = '$id' AND open = 1");
	$qson = mysql_num_rows($qso);
	$qsc = mysql_query("SELECT * FROM tickets WHERE takenbyID = '$id' AND open = 2");
	$qscn = mysql_num_rows($qso);
?>
</ul>

<strong><?php echo $teacher->username; ?></strong>
	<table style="width:300px;">
		<tr>
			<td>Aantal op tickets</td>
			<td class="lastth"><?php echo $qson; ?></td>
		</tr>
		<tr>
			<td>Aantal afgehandelde tickets</td>
			<td class="lastth"><?php echo $qscn; ?></td>
		</tr>
	</table><br />
<?php
}
if($_SESSION['rights'] > 2) {
?>
<h2>Guider statistieken</h2>
Aantal guiders: <?php echo $qgn; ?><br /><br />
	<?php
		while ($guider = mysql_fetch_object($qg)){
		$game = $guider->game;
		$language = $guider->language;
		$qm = mysql_query("SELECT * FROM users WHERE rights = 1 AND language = '$language' AND game = '$game'");
		$qmn = mysql_num_rows($qm);
?>
<strong><?php echo $guider->username; ?></strong><br />
Aantal mentoren: <?php echo $qmn; ?><br />
<ul>
	<?php
		while ($mentor = mysql_fetch_object($qm)) {
			echo "<li>";
			echo $mentor->username;
			echo "</li>";
		}
	?>
</ul>	
<?php
		}
	?>
<?php
}
}
else {
	echo language(20);
}
?>