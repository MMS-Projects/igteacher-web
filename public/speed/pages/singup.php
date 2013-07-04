<?php
if (isset($_POST['username'], $_POST['email'], $_POST['motivation'])) {
    if (empty($_POST['username'])) {
        echo '<strong>' . language(47) . '</strong><br />';
        die('<a href="' . URL . 'page/signup">' . language(53) . '</a>');
    } else {
        $querys = mysql_query("SELECT * FROM users WHERE username = '" . $_POST['username'] . "'");
        if (!mysql_num_rows($querys) == 0) {
            echo language(14);
            die();
        }
        $username = mysql_real_escape_string($_POST['username']);
    }
    if (empty($_POST['email'])) {
        echo '<strong>' . language(48) . '</strong><br />';
        die('<a href="' . URL . 'page/singup">' . language(53) . '</a>');
    } else {
        $email = mysql_real_escape_string($_POST['email']);
    }
    if (empty($_POST['motivation'])) {
        echo '<strong>' . language(52) . '</strong><br />';
        die('<a href="' . URL . 'page/singup">' . language(53) . '</a>');
    } else {
        $motivation = mysql_real_escape_string(bbcode_format($_POST['motivation']));
    }
    if (isset($motivation, $email, $username)) {
        $cr_password = RandomPass();
        $date = date('d-m-Y');
        $password = md5($cr_password . $date . 'IGtEaChErIsNoTaPaRtOfInNoGaMeS');
        $userquery = mysql_query("INSERT INTO users (username,password,regdate,rights,email) VALUES ('" . $username . "','" . $password . "','" . $date . "','0','" . $email . "')");
        if ($userquery) {
            $query = mysql_query("SELECT ID FROM users WHERE username = '" . $username . "'");
            while ($userid = mysql_fetch_object($query)) {
                $userID = $userid->ID;
            }
            echo '<strong>' . language(54) . '</strong><br />';
            echo language(8) . ': <i>' . $username . '</i><br />';
            echo language(9) . ': <i>*******</i><br /><hr />';
        }
        $ticketquery = mysql_query("
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
						'" . $userID . "',
						'Speed',
						'0',
						'0',
						'2',
						'1',
						'tribalwars',
						'nl',
						'" . mysql_real_escape_string($_POST['skype']) . "',
						'" . $motivation . "',
						'" . date('d-m-Y H:i:s') . "',
						'',
						'0',
						'0',
						'" . $_SERVER['REMOTE_ADDR'] . "')
						");
        if ($ticketquery) {
            echo language(44) . ': <i>' . $email . '</i><br /><hr />';
            $to = $email;
            $subject = language(55) . ' ' . SiteName;

            $message = "
<html>
<head>
<title>" . language(55) . " " . SiteName . "</title>
</head>
<body>
<h3>" . language(55) . " " . SiteName . "</h3>
<hr />
" . language(56) . "<br />
<hr />
<strong>" . language(57) . "</strong>
" . language(8) . ": <i>" . $username . "</i><br />
" . language(9) . ": <i>" . $cr_password . "</i><br />
<hr /><br /><br />
" . language(58) . "<br />
<a href='" . URL . "'>" . SiteName . "</a><br />
</body>
</html>
";

// Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// More headers
            $headers .= 'From: <mail@igteacher.com>' . "\r\n";

            mail($to, $subject, $message, $headers);
        } else {
            echo mysql_error();
        }
    }
}
?>
<h1>Speedaanmelding 1 mei 2013</h1>
<em>Zorg voor een degelijke motivatie!</em>
<em>Je kan ook een ticket openen voor vragen</em>
<?php if (isset($_SESSION['rights'])) { ?>
    <p><?php header('location:' . URL . 'page/signupwithaccount'); ?></p>
<?php } ?>
<form method="POST">
    <label for="username"><?php echo language(8); ?></label><br />
    <input type="text" name="username" /><br />
    <label for="email"><?php echo language(44); ?></label><br />
    <input type="text" name="email" /><br />
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