<h3>
<?php
echo language(22).' '.$_SESSION['username'];
?>
</h3>
<?php if($_SESSION['rights'] >= 1){ ?>
<p><?php echo language(21); ?></p>
<?php if($_SESSION['rights'] >= 2) { ?>
<h2>Guides</h2>
<a href="<?php echo URL; ?>page/guiderguide"> Guide voor guiders</a><br />
<em>Let op: Je moet ingelogd zijn om deze te kunnen bekijken!</em>
<?php } ?>
<?php } else { 
	header('Location: mytickets');
} ?>