<?php
if ($_SESSION['rights'] < 1) {
    echo language(19);
    die();
}
if ($_SESSION['rights'] >= 1) {
    ?>
    <h3><?php echo language(37); ?></h3>

    <a href="<?php echo URL; ?>page/archif"><?php echo language(142); ?></a>
    <table>
        <tr>
            <th>ID</th>
            <th><?php echo language(8); ?></th>
            <th><?php echo language(28); ?></th>
            <th><?php echo language(29); ?></th>
            <th><?php echo language(30); ?></th>
            <th><?php echo language(10); ?></th>
            <th><?php echo language(104); ?></th>
            <th><?php echo language(31); ?></th>	
            <th  class="lastth"><?php echo language(32); ?></th>
        </tr>
        <?php
        if ($_SESSION['rights'] == 1) {
            $query = mysql_query("SELECT * FROM tickets WHERE (takenbyID = '" . $_SESSION['userid'] . "' OR takenbyID IS NULL) AND game = '" . $_SESSION['game'] . "' AND language = '" . $_SESSION['language'] . "' AND subject = 'Speed' AND open < '2'  ORDER BY id");
        } elseif ($_SESSION['rights'] == 2) {
            $query = mysql_query("SELECT * FROM tickets WHERE game = '" . $_SESSION['game'] . "' AND language = '" . $_SESSION['language'] . "' AND open < '2' AND subject = 'Speed' ORDER BY id");
        } elseif ($_SESSION['rights'] >= 3) {
            $query = mysql_query("SELECT * FROM tickets WHERE open < '2' AND subject = 'Speed' ORDER BY id");
        }

        while ($tickets = mysql_fetch_object($query)) {
            if ($tickets->rights <= $_SESSION['rights']) {
                ?>
                <tr>
                    <td><a href="<?php echo URL . 'page/viewticket/' . $tickets->ID; ?>"><?php echo $tickets->ID; ?></a></td>
                    <td><a href="<?php echo URL . 'page/profile/' . $tickets->userID; ?>"><?php echo username($tickets->userID); ?></a></td>
                    <td><?php echo $tickets->subject; ?></td>
                    <td><?php echo status($tickets->open); ?></td>
                    <td><?php echo priority($tickets->priority); ?></td>
                    <td><?php echo rights($tickets->rights); ?></td>
                    <td><?php echo $tickets->lastanswer; ?></td>
                    <td><?php echo game($tickets->game); ?></td>
                    <td  class="lastth"><?php echo $tickets->language; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
    <?php
} else {
    echo language(20);
}
?>