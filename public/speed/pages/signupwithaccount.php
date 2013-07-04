<?php
if (!isset($_SESSION['rights'])) {
    echo language(19);
    die();
}
if (isset($_POST['motivation'])) {
    if (empty($_POST['motivation'])) {
        echo '<strong>' . language(52) . '</strong><br />';
        die('<a href="' . URL . 'page/signup">' . language(53) . '</a>');
    } else {
        $motivation = mysql_real_escape_string(bbcode_format($_POST['motivation']));
    }
    if (isset($motivation, $language, $game)) {
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
						'" . $userID . "',
						'Speed',
						'0',
						'0',
						'2',
						'1',
						'Tribalwars',
						'nl',
						'" . mysql_real_escape_string($_POST['skype']) . "',
						'" . $motivation . "',
						'" . date('d-m-Y H:i:s') . "',
						'',
						'0',
						'0',
						'" . $_SERVER['REMOTE_ADDR'] . "')
						");
    }
}
?>
<h1>Speedaanmelding 1 mei 2013</h1>
<em>! Zorg voor een degelijke motivatie!</em><br />
<em>Je kan ook een ticket openen voor vragen</em><br /><br />
<form method="POST">
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