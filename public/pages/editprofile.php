<?php
if (isset($_SESSION['userid'], $_GET['id'])) {
    if (isset($_POST['edit'])) {
        mysql_query("UPDATE users SET gender = '" . $_POST['gender'] . "' , birthday = '" . $_POST['birthday'] . "' , personaltext = '" . $_POST['personaltext'] . "' WHERE ID = '" . $_GET['id'] . "'");
    }
    if (isset($_POST['rightssubmit'])) {
        mysql_query("UPDATE users SET rights = '" . $_POST['rights'] . "', game = '" . $_POST['game'] . "', language = '" . $_POST['language'] . "' WHERE ID = '" . $_GET['id'] . "'");
    }
    if (isset($_POST['password'])) {
        $date = date('d-m-Y');
        $password = md5($_POST['pass'] . $date . 'IGtEaChErIsNoTaPaRtOfInNoGaMeS');
        mysql_query("UPDATE users SET regdate = '" . $date . "', password = '" . $password . "' WHERE ID = '" . $_GET['id'] . "'");
    }
    $query = mysql_query("SELECT * FROM users WHERE ID = '" . $_GET['id'] . "'");
    while ($profile = mysql_fetch_object($query)) {
        ?>
        <h3><?php echo language(85) . ' ' . $profile->username; ?></h3>
        <form method="POST">
            <label for="gender"><?php echo language(83); ?></label><br />
            <select name="gender">
                <option value=""><?php echo language(84); ?></option>
                <option value="1"><?php echo language(80); ?></option>
                <option value="2"><?php echo language(82); ?></option>
            </select><br />
            <label for="birthday"><?php echo language(81); ?></label><br />
            <input type="text" name="birthday" value="<?php echo $profile->birthday; ?>" /><br />
            <label for="personaltext"><?php echo language(86); ?></label>	
            <div class="richeditor">
                <div class="editbar">
                    <button title="bold" onclick="doClick('bold');" type="button"><b>B</b></button>
                    <button title="italic" onclick="doClick('italic');" type="button"><i>I</i></button>
                    <button title="underline" onclick="doClick('underline');" type="button"><u>U</u></button>
                </div>
                <div class="container">
                    <textarea name="personaltext" id="tbMsg" style="height:150px;width:350px;"><?php echo $profile->personaltext; ?></textarea>
                </div>
            </div>
            <script type="text/javascript">
                        initEditor("tbMsg", true);
            </script>
            <input name="edit" type="submit" value="<?php echo language(85); ?>" onclick="doCheck();" />
        </form>
        <h3><?php echo language(85) . ' ' . language(9); ?></h3>
        <form method="POST">
            <label for="pass"><?php echo language(9); ?></label><br />
            <input type="password" name="pass" /><br />
            <input name="password" type="submit" value="<?php echo language(85); ?>" />
        </form>
        <?php if ($_SESSION['rights'] >= 2) { ?>
            <hr />
            <form method="POST">
                <label for="rights"><?php echo language(10); ?></label><br />
                <select name="rights">
                    <option value="0"><?php echo language(101) ?></option>
                    <option value="1"><?php echo language(11); ?></option>
                    <?php if ($_SESSION['rights'] >= 3) { ?>
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
                    <option value="kartuga">Kartuga</option>
                </select><br />
                <label for="language"><?php echo language(32); ?></label><br />
                <select name="language">
                    <?php if (isset($_SESSION['lang'])) { ?>
                        <option <?php if ($_SESSION['lang'] == "nl") echo 'selected'; ?> value="nl">Nederlands</option>
                        <option <?php if ($_SESSION['lang'] == "en") echo 'selected'; ?> value="en">English</option>
                        <option <?php if ($_SESSION['lang'] == "de") echo 'selected'; ?> value="de">Deutsch</option>
                    <?php } else { ?>
                        <option selected value="nl">Nederlands</option>
                        <option value="en">English</option>
                        <option value="de">Deutsch</option>
                    <?php } ?>
                </select><br />	
                <input type="submit" name="rightssubmit" value="<?php echo language(85); ?>" />
            </form>
        <?php } ?>
        <?php
    }
} else {
    echo language(20);
}
?>