<!DOCTYPE html>
<html>
    <head>
        <style>
            #left {
                float: left;
                position: fixed;
            }
            .leftpanel { margin: 3px 3px 14px 3px; padding: 2px; width: 160px; border: 1px solid #C5E2AE;}
            .leftpanel h4 { font-size:12px; font-weight:bold; font-style:italic; color:#fff; text-align: center; margin: 0; margin-bottom: 2px; padding-top: 2px; padding-bottom: 6px; background-color: #67a13a; }
            ul.menu { margin:0px; padding:10px; list-style-type: none; list-style-position: inside}
            ul.menu li { margin: 0px; font-size:16px; line-height: 24px; border-bottom: 1px solid #536F49; }

            ul.smallmenu { margin:0px; padding:10px; list-style-type: none; list-style-position: inside}
            ul.smallmenu li { margin: 0px; font-size:11px; line-height: 16px; border-bottom: 1px solid #536F49; }
            a:focus	{ font-weight:bold; color: #67A13A; text-decoration:none; }
            a:link	{ font-weight:bold; color: #67A13A; text-decoration:none; }
            a:visited	{  font-weight:bold; color: #67A13A; text-decoration:none; }
            a:hover	{  font-weight:bold; color: #64C218; text-decoration:none; }
            a:active	{  font-weight:bold; color: #63CF0B; text-decoration:none; }
            body	{ background-color: #FFFFFF; font-size:10px; font-family: Verdana, Arial;}
            h1		{ font-size:18px; }
            h2		{ font-size:16px; color: #536F49; border-bottom: 1px solid #536F49; }
            h3      { font-size:14px; font-weight:bold; color:#536F49; margin-top: 10px; }
            h4      { font-size:12px; font-weight:bold; font-style:italic; color:#536F49}
        </style>
    </head>
    <body>
        <div id="left">
            <div class="leftpanel">
                <div style="text-align: center">
                    <img src="logo.png" alt="InnoGames Teacher" width='100px' /><br />
                    <span style="font-family: 'Helvetica Neue',Helvetica; font-size: 20px; color: #2e5d23">My Account</span>
                </div>
                <ul class="menu">
                    <li><a href="/applications">Dashboard</a>
                    <li><a href="/profile">Profile</a>
                    <li><a href="/auth/login?action=logout">Logout</a>
                </ul>
            </div>

        </div>

    </body>
</html>