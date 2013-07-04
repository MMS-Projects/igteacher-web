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
<body style="<?php if(isset($_GET['game'])){ ?>background: #4D4D4D url('<?php echo URL; ?>images/bg_<?php echo $_GET['game']; ?>.png') center center no-repeat; background-attachment:fixed;<?php } ?>">
	<div id="gamesbottom">
	  <div class="gamesbelow">
<a class="none" href="<?php echo URL; ?>game/tribalwars"><img src="<?php echo URL; ?>images/icon_tribalwars_en.png" alt="Tribal Wars" /></a>
<a class="none" href="<?php echo URL; ?>game/west"><img src="<?php echo URL; ?>images/icon_west.png" alt="The West" /></a>
<a class="none" href="<?php echo URL; ?>game/grepo"><img src="<?php echo URL; ?>images/icon_grepo.png" alt="Grepolis" /></a>
<a class="none" href="<?php echo URL; ?>game/forge"><img src="<?php echo URL; ?>images/icon_foe.png" alt="Forge Of Empires" /></a>
<a class="none" href="<?php echo URL; ?>game/bountyhounds"><img src="<?php echo URL; ?>images/icon_bho.png" alt="Bounty Hounds Online" /></a>
<a class="none" href="<?php echo URL; ?>game/lagoonia"><img src="<?php echo URL; ?>images/icon_lagoonia.png" alt="Lagoonia" /></a>
	  </div>
	</div>
	<div id="wrapper">
		<header>
			<a href="<?php echo URL; ?>">
				<img class="logo" src="<?php echo LogoSrc; ?>" alt="<?php echo SiteName; ?>" />
			</a>
			<p class="menu">
				<a href="<?php echo URL; ?>">
					<?php echo language(4); ?>
				</a> 
				<?php if(isset($_SESSION['username'],$_SESSION['rights'])){ ?>
				- 
				<a href="<?php echo URL; ?>page/logout">
					<?php echo language(18); ?>
				</a>
				<?php } else { ?>
				- 
				<a href="<?php echo URL; ?>page/login">
					<?php echo language(5); ?>
				</a>
				<?php } ?>
				- 
				<a href="<?php echo URL; ?>page/signup">
					<?php echo language(59); ?>
				</a>
				- 
				<a href="<?php echo URL; ?>page/team">
					<?php echo language(6); ?>
				</a>
			</p>
		</header>
		<?php 
			if(isset($_GET['game'])){
				$_SESSION['game'] = $_GET['game'];
				$game = 'games/'.$_GET['game'];
				}
			else {
				$game = 'games';
				}
			include 'pages/'.$game.'.php';
		?>
		<footer>
			 <?php echo language(1); ?> - &copy; 2010 - <?php echo date('Y'); ?> <a href="<?php echo URL; ?>"><?php echo SiteName; ?></a> <?php echo language(1); ?> <a href="<?php echo URL; ?>page/scriptinfo">Script</a>
		</footer>
	</div>
</body>
</html>