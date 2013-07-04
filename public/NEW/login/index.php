<! DOCTYPE html>
<html>
	<head>
<style>
body{
	font-family:verdana;
}
#login{
	width:500px;
	margin:0 auto;
	border:1px solid #406b35;
}
#logo{
	border-bottom:1px solid #406b35;
	text-align:center;
}
#left{
	width:100px;
	float:left;
}
#right{
	width:100px;
	float:left;
}
.clear{
	clear:both;
}
#login_login{
	padding:10px;
}
</style>
	<title>InnoGames Teacher Login</title>
	</head>
	<body>
		<div id="login">
			<div id="logo"><img src="logo.png" width=350 /></div>
			<div id="login_login">
				<h1>Login</h1>
				<div id="details">
					<form method="POST" action="">
						<div id="left">
							Username
						</div>
						<div id="right">
							<input type="text" name="username" />
						</div>
						<div class="clear"></div>
						<div id="left">
							Password
						</div>
						<div id="right">
							<input type="password" name="password" />
						</div>
						<div class="clear"></div>
						<div id="left">
						</div>
						<div id="right">
							<input type="submit" name="submit" value="Log in" />
						</div>
						<div class="clear"></div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>