<?php

if(isset($_POST['username'],$_POST['password'])){
	$squery = mysql_query("SELECT * FROM users WHERE username = '".mysql_real_escape_string($_POST['username'])."'");
	if(!mysql_num_rows($querys) == 0){
	echo language(17);
	die();
	}
	while($userdata = mysql_fetch_object($squery)){
		$dbpass = $userdata->password;
		$dbdate = $userdata->regdate;
		if(md5($_POST['password'].$dbdate.'IGtEaChErIsNoTaPaRtOfInNoGaMeS') == $dbpass){
			$_SESSION['userid'] = $userdata->ID;
			$_SESSION['username'] = $userdata->username;
			$_SESSION['rights'] = $userdata->rights;
			$_SESSION['game'] = $userdata->game;
			$_SESSION['language'] = $userdata->language;
			header('location: tickets');
		}
	}
}
?>
<h3><?php echo language(7); ?></h3>
<form method="POST">
	<label for="username"><?php echo language(8); ?></label><br />
	<input type="text" name="username" /><br />
	<label for="password"><?php echo language(9); ?></label><br />
	<input type="password" name="password" /><br />
	<input type="submit" value="<?php echo language(5); ?>" />
</form>