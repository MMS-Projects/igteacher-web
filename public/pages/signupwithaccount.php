<?php 
if(!isset($_SESSION['rights'])){
	echo language(19);
	die();
	}
if(isset($_POST['game'],$_POST['language'],$_POST['motivation'])){
	if(empty($_POST['game'])){
		echo '<strong>'.language(50).'</strong><br />';
		die('<a href="'.URL.'page/signup">'.language(53).'</a>');
	}
	else {
	$game = mysql_real_escape_string($_POST['game']);
	}
	if(empty($_POST['language'])){
		echo '<strong>'.language(51).'</strong><br />';
		die('<a href="'.URL.'page/signup">'.language(53).'</a>');
	}
	else {
	$language = mysql_real_escape_string($_POST['language']);
	}
	if(empty($_POST['motivation'])){
		echo '<strong>'.language(52).'</strong><br />';
		die('<a href="'.URL.'page/signup">'.language(53).'</a>');
	}
	else {
	$motivation = mysql_real_escape_string(bbcode_format($_POST['motivation']));
	}
	if(isset($motivation,$language,$game)){
				$userID = $_SESSION['userid'];
		mysql_query("
						INSERT INTO tickets (
						userID,
						subject,
						open,
						priority,
						rights,
						level,
						game,
						language,
						skype,
						motivation,
						createdate,
						lastanswer,
						firstanswer,
						closedate,
						ip) VALUES (
						'".$userID."',
						'".language(55)."',
						'0',
						'0',
						'1',
						'1',
						'".$game."',
						'".$language."',
						'".mysql_real_escape_string($_POST['skype'])."',
						'".$motivation."',
						'".date('d-m-Y H:i:s')."',
						'',
						'0',
						'0',
						'".$_SERVER['REMOTE_ADDR']."')
						");
	}
}
?>
<form method="POST">
	<label for="game"><?php echo language(31); ?></label><br />
	<select name="game">
	<?php if(isset($_SESSION['game'])){ ?>
		<option <?php if($_SESSION['game'] == "west") echo 'selected'; ?> value="west">The West</option>
		<option <?php if($_SESSION['game'] == "tribalwars") echo 'selected'; ?> value="tribalwars"><?php echo language(25); ?></option>
		<option <?php if($_SESSION['game'] == "grepo") echo 'selected'; ?> value="grepo">Grepolis</option>
		<option <?php if($_SESSION['game'] == "forge") echo 'selected'; ?> value="forge">Forge of Empires</option>
		<option <?php if($_SESSION['game'] == "bountyhounds") echo 'selected'; ?> value="bountyhounds">Bounty Hounds Online</option>
		<option <?php if($_SESSION['game'] == "lagoonia") echo 'selected'; ?> value="lagoonia">Lagoonia</option>
		<option <?php if($_SESSION['game'] == "kartuga") echo 'selected'; ?> value="kartuga">Kartuga</option>
	<?php } else { ?>
		<option value="west">The West</option>
		<option value="tribalwars"><?php echo language(25); ?></option>
		<option value="grepo">Grepolis</option>
		<option value="forge">Forge of Empires</option>
		<option value="bountyhounds">Bounty Hounds Online</option>
		<option value="lagoonia">Lagoonia</option>
		<option value="kartuga">Kartuga</option>
	<?php } ?>
	</select><br />
	<label for="language"><?php echo language(32); ?></label><br />
	<select name="language">
	<?php if(isset($_SESSION['lang'])){ ?>
		<option <?php if($_SESSION['lang'] == "nl") echo 'selected'; ?> value="nl">Nederlands</option>
		<option <?php if($_SESSION['lang'] == "en") echo 'selected'; ?> value="en">English</option>
		<option <?php if($_SESSION['lang'] == "de") echo 'selected'; ?> value="de">Deutsch</option>
	<?php } else { ?>
		<option selected value="nl">Nederlands</option>
		<option value="en">English</option>
		<option value="de">Deutsch</option>
	<?php } ?>
	</select><br />	
	<label for="skype">Skype</label><br />
	<input type="text" name="skype" /><br />
	<label for="motivation"><?php echo language(46); ?></label><br />
	<div class="richeditor">
		<div class="editbar">
			<button title="bold" onclick="doClick('bold');" type="button"><b>B</b></button>
			<button title="italic" onclick="doClick('italic');" type="button"><i>I</i></button>
			<button title="underline" onclick="doClick('underline');" type="button"><u>U</u></button>
		</div>
		<div class="container">
		<textarea name="motivation" id="tbMsg" style="height:150px;width:350px;"></textarea>
		</div>
	</div>
	<script type="text/javascript">
		initEditor("tbMsg", true);
	</script>
	<input type="submit" onclick="doCheck();" />
</form>