<?php
if (isset($_GET['id'])) {
    if (!isset($_SESSION['rights'])) {
        echo language(19);
        die();
    }
    if ($_SESSION['rights'] >= 3) {
        if (isset($_POST['submit'])) {
            mysql_query("UPDATE texts SET nl = '" . mysql_real_escape_string($_POST['nl']) . "', en = '" . mysql_real_escape_string($_POST['en']) . "', de = '" . mysql_real_escape_string($_POST['de']) . "' WHERE ID = '" . $_GET['id'] . "'");
            header('location: ' . URL . 'page/translationlist');
        }
        ?>
        <table>
            <tr>
                <th>NL</th>
                <th>EN</th>
                <th class="lastth">DE</th>
            </tr>
            <form method="POST">
                <?php
                $query = mysql_query("SELECT * FROM texts WHERE ID = '" . $_GET['id'] . "'");
                while ($texts = mysql_fetch_object($query)) {
                    ?>
                    <tr>
                        <td>
                            <textarea name="nl"><?php echo $texts->nl; ?></textarea>
                        </td>
                        <td>
                            <textarea name="en"><?php echo $texts->en; ?></textarea>
                        </td>
                        <td class="lastth">
                            <textarea name="de"><?php echo $texts->de; ?></textarea>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <input type="submit" name="submit" value="<?php echo language(85); ?>" />
            </form>
        </table>
        <?php
    }
}
?>