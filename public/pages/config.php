<?php
if (!isset($_SESSION['rights'])) {
    echo language(19);
    die();
}
if (isset($_POST['submit'])) {
    $query = mysql_query("UPDATE configuration 
				SET 
				sitename = '" . mysql_real_escape_string($_POST['sitename']) . "',
				seokeywords = '" . mysql_real_escape_string($_POST['seokeywords']) . "',
				seodescription = '" . mysql_real_escape_string($_POST['seodescription']) . "',
				logosrc = '" . mysql_real_escape_string($_POST['logosrc']) . "'
				");
    if ($query)
        echo language(70);
}
if ($_SESSION['rights'] >= 3) {
    $query = mysql_query("SELECT * FROM configuration");
    while ($config = mysql_fetch_object($query)) {
        ?>
        <h3><?php echo language(71); ?></h3>
        <form method="post">
            <label for="sitename"><?php echo language(66); ?></label><br />
            <input type="text" name="sitename" value="<?php echo $config->sitename; ?>" /><br />
            <label for="seokeywords"><?php echo language(68); ?></label><br />
            <input type="text" name="seokeywords" value="<?php echo $config->seokeywords; ?>" /><br />
            <label for="seodescription"><?php echo language(67); ?></label><br />
            <textarea name="seodescription"><?php echo $config->seodescription; ?></textarea><br />
            <label for="logosrc"><?php echo language(69); ?></label><br />
            <input type="text" name="logosrc" value="<?php echo $config->logosrc; ?>" /><br />
            <input name="submit" type="submit" value="save" /><br />
        </form>
        <?php
    }
} else {
    echo language(20);
}
?>