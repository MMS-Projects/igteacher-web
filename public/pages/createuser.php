<?php
if(!isset($_SESSION['rights'])){
	echo language(19);
	die();
	}
if($_SESSION['rights'] >= 2){
if(isset($_POST['submit'])){
	if(isset($_POST['username'],$_POST['password'],$_POST['rights'],$_POST['email'])){
	$querys = mysql_query("SELECT * FROM users WHERE username = '".$_POST['username']."'");
	if(!mysql_num_rows($querys) == 0){
		echo language(14);
		die();
		}
	$date = date('d-m-Y');
	$pass = md5($_POST['password'].$date.'IGtEaChErIsNoTaPaRtOfInNoGaMeS');
	$query = mysql_query("INSERT INTO users VALUES ( 
						'',
						'".mysql_real_escape_string($_POST['username'])."',
						'".mysql_real_escape_string($pass)."',
						'".$date."',
						'',
						'',
						'',
						'".mysql_real_escape_string($_POST['rights'])."',
						'".mysql_real_escape_string($_POST['game'])."',
						'".mysql_real_escape_string($_POST['email'])."',
						'".mysql_real_escape_string($_POST['language'])."',
						'')");
	if($query)
		echo language(15);
	} else {
		echo 'fout';
}
}
?>
<h3><?php echo language(16); ?></h3>
<form method="POST">
	<label for="username"><?php echo language(8); ?></label><br />
	<input type="text" name="username" /><br />
	<label for="password"><?php echo language(9); ?></label><br />
	<input type="password" name="password" /><br />
	<label for="email"><?php echo language(44); ?></label><br />
	<input type="text" name="email" /><br />
	<label for="rights"><?php echo language(10); ?></label><br />
	<select name="rights">
		<option value="0"><?php echo language(101) ?></option>
		<option value="1"><?php echo language(11); ?></option>
		<?php if($_SESSION['rights'] >= 3){ ?>
		<option value="2"><?php echo language(12); ?></option>
		<option value="3"><?php echo language(13); ?></option>
		<option value="4"><?php echo language(26); ?></option>
		<?php } ?>
	</select><br />
	<label for="game"><?php echo language(31); ?></label><br />
	<select name="game">
		<option value="west">The West</option>
		<option value="tribalwars"><?php echo language(25); ?></option>
		<option value="grepo">Grepolis</option>
		<option value="forge">Forge of Empires</option>
		<option value="bountyhounds">Bounty Hounds Online</option>
		<option value="lagoonia">Lagoonia</option>
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
	<input type="submit" name="submit" />
</form>
<?php
}
else {
	echo language(20);
}
?>