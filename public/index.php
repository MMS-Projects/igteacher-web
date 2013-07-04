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
<ul id="js-news" class="js-hidden">
	<?php 
		$newsquery = mysql_query("SELECT * FROM news ORDER BY date DESC");
		while($news = mysql_fetch_object($newsquery))
			{
	?>
				<li class="news-item"><strong><?php echo $news->title; ?></strong> - (<?php echo $news->date; ?>) - <?php echo $news->text; ?> - <i>by <?php echo $news->author; ?></i></li>
	<?php
			}
	?>	
</ul>
<script type="text/javascript">
    $(function () {
        $('#js-news').ticker();
    });
</script>
	<div id="flags">
	<a href="<?php echo URL; ?>/include/setlang.php?lang=nl"><img src="<?php echo URL; ?>images/nl.png" alt="Nederlands" /></a>
	<a href="<?php echo URL; ?>/include/setlang.php?lang=en"><img src="<?php echo URL; ?>images/en.png" alt="English" /></a>
	</div>
	<?php if(isset($_SESSION['rights'])){ ?>
	<div id="sidemenu">
	<?php if($_SESSION['rights'] == 0){ ?>
		<a href="<?php echo URL; ?>page/mytickets"><?php echo language(60); ?></a>
	<?php } ?>
	<?php if($_SESSION['rights'] >= 1){ ?>
		<a href="<?php echo URL; ?>page/loggedin"><?php echo language(4); ?></a>
		-
		<a href="<?php echo URL; ?>page/tickets"><?php echo language(37); ?></a>
		-
		<a href="<?php echo URL; ?>page/userlist"><?php echo language(100); ?></a>
				<?php if($_SESSION['rights'] >= 3){ ?>
		-
		<a href="<?php echo URL; ?>page/admin"><?php echo language(110) ?></a>
		<?php } ?>

		<?php if($_SESSION['rights'] >1) {?>
		-
		<a href="<?php echo URL; ?>page/guider">Guider</a>
		<?php } } ?>
	
		-
		<a href="<?php echo URL; ?>page/profile/<?php echo $_SESSION['userid']; ?>"><?php echo language(87); ?><a>
	</div>
	<?php } ?>
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
				<?php if(isset($_SESSION['username'],$_SESSION['rights'])){ ?>
				<a href="<?php echo URL; ?>page/signupwithaccount">
				<?php } else { ?>
				<a href="<?php echo URL; ?>page/signup">
				<?php } ?>
					<?php echo language(59); ?>
				</a>
				- 
				<?php if(isset($_SESSION['username'],$_SESSION['rights'])){ ?>
				<a href="<?php echo URL; ?>page/sollicitatewhitaccount">
				<?php } else { ?>
				<a href="<?php echo URL; ?>page/sollicitate">
				<?php } ?>
					<?php echo language(109); ?>
				</a>
				- 
				<a href="<?php echo URL; ?>page/team">
					<?php echo language(6); ?>
				</a>
				-
				<a href="<?php echo URL ?>page/contact">
					Contact
				</a>
				-
				<a href="http://webchat.quakenet.org/?channels=#igteacher" target="_blank">
					Chat
				</a>
			</p>
		</header>
		<?php 
			if(isset($_GET['page'])){
				$page = $_GET['page'];
				}
			else {
				$page = 'games';
				}
			include 'pages/'.$page.'.php';
		?>
		<footer>
				&copy; 2010 - <?php echo date('Y'); ?> <a href="<?php echo URL; ?>"><?php echo SiteName; ?></a> <?php echo language(1); ?> <a href="<?php echo URL; ?>page/scriptinfo">Script</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php
						$end = number_format((microtime(true) - $start), 2);
						echo 'Pagina geladen in ', $end , ' seconden';
					?>
		</footer>
	</div>