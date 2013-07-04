<?php
//coded by bastian stolk
$config = require 'include/config.php';
if(!$config){
	die(header('location: '.URL.'errors/noconfig.html'));
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo SiteName; ?></title>
	<link href="<?php echo URL; ?>css/style.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Pontano+Sans' rel='stylesheet' type='text/css'>
    <link href="<?php echo URL; ?>css/editor.css" rel="Stylesheet" type="text/css" />
	<script src="<?php echo URL; ?>include/editor.js" type="text/javascript"></script>
	<link href="<?php echo URL; ?>css/styles/ticker-style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script> 
	<script src="<?php echo URL; ?>includes/jquery.ticker.js" type="text/javascript"></script>
	<meta name="Author" content="Bastian Stolk, info@stolk-it.nl">
	<meta name="keywords" content="<?php echo MetaKeywords; ?>">
	<meta name="description" content="<?php echo MetaDescription; ?>">
	<!--[if gte IE 9]>
		<style type="text/css">
			.gradient {
			filter: none;
			}
		</style>
	<![endif]-->
</head>
<body>
<?php if($_SESSION['rights'] == 2 && $_SESSION['language'] == 'nl' && $_SESSION['game'] == 'tribalwars' || $_SESSION['rights'] > 2){ ?>
	<div id="sidemenu">
		<a href="<?php echo URL; ?>page/tickets">Tickets</a>
		-
		<a href="<?php echo URL; ?>page/texts">Teksten</a>
	</div>
	<?php } ?>
	<div id="wrapper">
		<header>
			<a href="<?php echo URL; ?>">
				<img class="logo" src="<?php echo URL; ?>/images/speed.png" alt="<?php echo SiteName; ?>" />
			</a>
			<p class="menu">
				<a href="<?php echo URL; ?>page/singup">
					Aanmelden
				</a>
				-
				<a href="<?php echo URL; ?>page/login">Login</a>
			</p>
		</header>
		<?php 
			if(isset($_GET['page'])){
				$page = $_GET['page'];
				}
			else {
				$page = 'home';
				}
			include 'pages/'.$page.'.php';
		?>
		<footer>
				&copy; 2010 - <?php echo date('Y'); ?> <a href="<?php echo URL; ?>"><?php echo SiteName; ?></a> <?php echo language(1); ?> <a href="<?php echo URL; ?>page/scriptinfo">Script</a>
		</footer>
	</div>