<?php
//coded by Bastian Stolk

//Page loading
$start = microtime(true);

//starting the session 
session_start();

//defining the root-url and root-dir of your website
define('URL','http://www.igteacher.com/'); //IMPORTANT please enter with latest backslash
define('DIR','../'); //IMPORTANT please enter with latest backslash and first link to your startdirectory

//defining MySQL connect details
define('HOST','localhost'); //The host for the MySQL database
define('USER','igt'); //The username for the MySQL database
define('PASS','********'); //The password for the MySQL database
define('DB','InnoGamesTeacher'); //The name of the MySQL databasease


//creating database connection
$con = mysql_connect(HOST, USER, PASS);
if(!$con){
	die(header('location: ./errors/dbcon.html'));
}
$selectdb = mysql_select_db(DB);
if(!$selectdb){
	die(header('location: ./errors/nodb.html'));
}



//getting database variables from the MySQL database
$configq = mysql_query("SELECT * FROM configuration LIMIT 1");
	while($config = mysql_fetch_object($configq)){
		define('SiteName',$config->sitename); //The name of the website
		define('MetaKeywords',$config->seokeywords); //The keywords for the metadata of your website
		define('MetaDescription',$config->seodescription); //The description for the metadata of your website
		define('LogoSrc',$config->logosrc); //this will be needed to display a logo
	}
//translation function, this functions returns a text from the database, with a WHERE-statement you'll get the data from ONE row
function language($id) {
	if(isset($_SESSION['lang'])){
		$slang = $_SESSION['lang'];
	}
	else {
		$slang = 'nl';
	}
	$query = mysql_query("SELECT ".$slang." FROM texts WHERE id = ".$id);
	while($lang = mysql_fetch_object($query)){
		$return = $lang->$slang;
	}
	return $return;
}
function username($id) {
	$query = mysql_query("SELECT username FROM users WHERE ID = ".$id);
	while($user = mysql_fetch_object($query)){
		$return = $user->username;
	}
	return $return;
}	
function priority($id) {
	if($id == 0){
	$return = '<strong class="normal">'.language(34).'</strong>';
	}
	if($id == 1){
	$return = '<strong>'.language(33).'</strong>';
	}
	if($id == 2){
	$return = '<strong class="alert">'.language(35).'</strong>';
	}
	if($id == 3){
	$return = language(77);
	}
	return $return;
}
function status($count) {
	if($count == 0){
	$return = language(62);
	}
	if($count == 1){
	$return = language(63);
	}
	if($count == 2){
	$return = language(64);
	}
	return $return;
}
function gender($gender) {
	if($gender == ''){
	$return = language(84);
	}
	if($gender == 1){
	$return = language(80);
	}
	if($gender == 2){
	$return = language(82);
	}
	return $return;
}
function lang($lang) {
	if($lang == 'nl'){
	$return = 'Nederlands';
	}
	if($lang == 'en'){
	$return = 'English';
	}
	if($lang == 'de'){
	$return = 'Deutsch';
	}
	return $return;
}
function game($game) {
	if($game == 'west'){
	$return = 'The West';
	}
	if($game == 'tribalwars'){
	$return = language(25);
	}
	if($game == 'grepo'){
	$return = 'Grepolis';
	}
	if($game == 'forge'){
	$return = 'Forge of Empires';
	}
	if($game == 'lagoonia'){
	$return = 'Lagoonia';
	}
	if($game == 'kartuga'){
	$return = 'Kartuga';
	}
	return $return;
}
function rights($id) {
	if(isset($_SESSION['lang'])){
		$slang = $_SESSION['lang'];
	}
	else {
		$slang = 'nl';
	}
	if($id == 0){
	$query = mysql_query("SELECT * FROM texts WHERE ID = '36'");
	}
	if($id == 1){
	$query = mysql_query("SELECT * FROM texts WHERE ID = '11'");
	}
	if($id == 2){
	$query = mysql_query("SELECT * FROM texts WHERE ID = '12'");
	}
	if($id == 3){
	$query = mysql_query("SELECT * FROM texts WHERE ID = '13'");
	}
	if($id == 4){
	$query = mysql_query("SELECT * FROM texts WHERE ID = '26'");
	}
	while($rights = mysql_fetch_object($query)){
		$return = $rights->$slang;
	}
	return $return;
}
//BB code parser
function bbcode_format($str){
   // Convert all special HTML characters into entities to display literally
   $str = htmlentities($str);
   // The array of regex patterns to look for
   $format_search =  array(
      '#\[b\](.*?)\[/b\]#is', // Bold ([b]text[/b]
      '#\[i\](.*?)\[/i\]#is', // Italics ([i]text[/i]
      '#\[u\](.*?)\[/u\]#is', // Underline ([u]text[/u])
      '#\[s\](.*?)\[/s\]#is', // Strikethrough ([s]text[/s])
      '#\[quote\](.*?)\[/quote\]#is', // Quote ([quote]text[/quote])
      '#\[code\](.*?)\[/code\]#is', // Monospaced code [code]text[/code])
      '#\[size=([1-9]|1[0-9]|20)\](.*?)\[/size\]#is', // Font size 1-20px [size=20]text[/size])
      '#\[color=\#?([A-F0-9]{3}|[A-F0-9]{6})\](.*?)\[/color\]#is', // Font color ([color=#00F]text[/color])
      '#\[url=((?:ftp|https?)://.*?)\](.*?)\[/url\]#i', // Hyperlink with descriptive text ([url=http://url]text[/url])
      '#\[url\]((?:ftp|https?)://.*?)\[/url\]#i', // Hyperlink ([url]http://url[/url])
      '#\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]#i' // Image ([img]http://url_to_image[/img])
   );
   // The matching array of strings to replace matches with
   $format_replace = array(
      '<strong>$1</strong>',
      '<em>$1</em>',
      '<span style="text-decoration: underline;">$1</span>',
      '<span style="text-decoration: line-through;">$1</span>',
      '<blockquote>$1</blockquote>',
      '<pre>$1</'.'pre>',
      '<span style="font-size: $1px;">$2</span>',
      '<span style="color: #$1;">$2</span>',
      '<a href="$1">$2</a>',
      '<a href="$1">$1</a>',
      '<img src="$1" alt="" />'
   );
   // Perform the actual conversion
   $str = preg_replace($format_search, $format_replace, $str);
   // Convert line breaks in the <br /> tag
   $str = nl2br($str);
   return $str;
}
//password generator
function RandomPass($length=9, $strength=0) {
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}

// Random cijfer van 11 letters

		$characters = array(
		"A","B","C","D","E","F","G","H","J","K","L","M",
		"N","P","Q","R","S","T","U","V","W","X","Y","Z",
		"1","2","3","4","5","6","7","8","9","a","b","c",
		"d","e","f","g","h","i","j","k","l","m","n","o",
		"p","q","r","s","t","u","v","w","x","y","z");


		$keys = array();


		while(count($keys) < 11) {
			 
			 $x = mt_rand(0, count($characters)-1);
			 if(!in_array($x, $keys)) {
				$keys[] = $x;
			 }
		 }

		 foreach($keys as $key){
			$char_16 .= $characters[$key];
		 }

?>

<?php
	// This is the ban script

$banq = mysql_query("SELECT * FROM bans WHERE ip = '".$_SERVER['REMOTE_ADDR']."'");
$bannr = mysql_num_rows($banq);

if($bannr != 0){
	while($b = mysql_fetch_assoc($banq)){
		$breason = $b['reason'];
		$bip = $b['ip'];
		$bby = $b['by'];
	}	
	echo "<!DOCTYPE html>
<html>
<head>
	<title>".SiteName."</title>
	<link href=\" ".URL."css/style.css\" rel=\"stylesheet\" type=\"text/css\">
	<link href='http://fonts.googleapis.com/css?family=Pontano+Sans' rel='stylesheet' type='text/css'>
    <link href=\" ".URL." ?>css/editor.css\" rel=\"Stylesheet\" type=\"text/css\" />
	<script src=\" '".URL."' ?>include/editor.js\" type=\"text/javascript\"></script>
	<meta name=\"Author\" content=\"Bastian Stolk, info@stolk-it.nl\">
	<meta name=\"keywords\" content=\" ".MetaKeywords." \">
	<meta name=\"description\" content=\" ".MetaDescription." \">
	<!--[if gte IE 9]>
		<style type=\"text/css\">
			.gradient {
			filter: none;
			}
		</style>
	<![endif]-->
</head>
<div id=\"wrapper\">
		<header>
			<a href=\" ".URL." \">
				<img class=\"logo\" src=\" ".LogoSrc."\" alt=\"".SiteName."\" />
			</a>
		</header>
<body>";
echo "Beste bezoeker,<br /><br /> De toegang tot IGTeacher is voor u geblokkeerd door <b>".@username($bby)."</b> op het IP-adres ".$bip." met de volgende reden:<br /><br /><b>".$breason."</b><br /><br />Indien je deze blokkade onterecht vindt kan je altijd een mail sturen naar <b>support@igteacher.com</b>. Houd er rekening mee dat wij ongewenst gebruik van ons systeem niet tolereren en dat onwenselijk gedrag ook zal worden bestraft.</b> .<br /><br />Met vriendelijke groeten,<br /><em>IGTeacher Management</em>";
echo "<footer>
			 &copy; 2003 - Innogames Teacher
		</footer>
		</div>";
		die();
}

?>