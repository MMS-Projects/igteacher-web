<?php
if (!isset($_SESSION['rights'])) {
    echo language(19);
    die();
}
if ($_SESSION['rights'] >= 3) {

    if (isset($_POST['ban'])) {
        $ip = $_POST['ip'];
        $reason = $_POST['reason'];
        mysql_query("INSERT INTO bans VALUES('','$ip','','" . $_SESSION['userid'] . "','$reason')");
        $ul = '' . URL . 'page/ban/';
        header('Location: ' . $ul . '');
    }
    ?>
    <h2>Bannen</h2> 
    <a href="<?php echo URL; ?>/page/admin"><?php echo language(116) ?></a><br />
    <em><?php echo language(117) ?></em><br />
    <br />
    <form action="" method="POST">
        <table style="width:500px;">
            <tr>	
                <td>IP</td>
                <td class="lastth"><input type="text" name="ip" /></td>
            </tr>
            <tr>	
                <td><?php echo language(115) ?></td>
                <td class="lastth"><textarea name="reason" style="height:20px;width:350px;"></textarea></td>
            </tr>
            <tr>	
                <td></td>
                <td class="lastth"><input type="submit" name="ban" /></td>
            </tr>

        </table>
    </form>

    <h2>Overzicht van bans </h2>

    <table>
        <tr>	
            <th>#</th>
            <th>IP</th>
            <th><?php echo language(105) ?></th>
            <th><?php echo language(114) ?></th>
            <th class="lastth"><?php echo language(115) ?></th>

        </tr>

        <?php
        $query = mysql_query("SELECT * FROM bans");
        while ($q = mysql_fetch_object($query)) {
            ?>
            <tr>
                <td><?php echo $q->id; ?></td>
                <td><?php echo $q->ip; ?></td>
                <td><?php echo @username($q->by); ?></td>
                <td><?php echo $q->reason; ?></td>
                <td class="lastth"><a href="<?php echo URL; ?>page/deleteban/<?php echo $q->id; ?>">Verwijder</a></td>

            </tr>
            <?php
        }
        ?>
    </table>
    <?php
} else {
    echo language(20);
}
?>