<?php
if ($_SESSION['rights'] < 1) {
    echo language(19);
    die();
}
if ($_SESSION['rights'] >= 1) {
    ?>

    <h3><?php echo language(37); ?></h3>
    <?php
    if ($_SESSION['rights'] > 2) {
        ?>

        <a href="<?php echo URL; ?>page/archif/tribalwars/">Tribalwars</a> |
        <a href="<?php echo URL; ?>page/archif/west/">The West</a> |
        <a href="<?php echo URL; ?>page/archif/grepo/">Grepolis</a> |
        <a href="<?php echo URL; ?>page/archif/forge/">Forge of Empires</a> |
        <a href="<?php echo URL; ?>page/archif/kartuga/">Kartuga</a> |
        <a href="<?php echo URL; ?>page/archif/lagoonia/">Lagoonia</a>
        <br />
        <?php
        if ($_GET['sort']) {
            ?>
            <a href="<?php echo URL; ?>page/archif/<?php echo $_GET['sort']; ?>/nl/"><?php echo language(138) ?></a> |
            <a href="<?php echo URL; ?>page/archif/<?php echo $_GET['sort']; ?>/en/"><?php echo language(139) ?></a> |
            <a href="<?php echo URL; ?>page/archif/<?php echo $_GET['sort']; ?>/de/"><?php echo language(140) ?></a> 
            <br />
            <?php
        } else {
            ?>
            <a href="<?php echo URL; ?>page/archif/nl/"><?php echo language(138) ?></a> |
            <a href="<?php echo URL; ?>page/archif/en/"><?php echo language(139) ?></a> |
            <a href="<?php echo URL; ?>page/archif/de/"><?php echo language(140) ?></a> 
            <br />
            <?php
        }
        if ($_GET['lang'] || $_GET['sort']) {
            ?>
            <a href="<?php echo URL; ?>/page/archif"><?php echo language(141) ?></a> <br />
            <?php
        }
    }
    ?>

    <a href="<?php echo URL; ?>page/tickets">Tickets</a>
    <table>
        <tr>
            <th>ID</th>
            <th><?php echo language(8); ?></th>
            <th><?php echo language(28); ?></th>
            <th><?php echo language(29); ?></th>
            <th><?php echo language(30); ?></th>
            <th><?php echo language(10); ?></th>
            <th><?php echo language(31); ?></th>
            <th><?php echo language(32); ?></th>
        </tr>
        <?php
        if ($_SESSION['rights'] == 1) {
            $query = mysql_query("SELECT * FROM tickets WHERE (takenbyID IS NULL OR takenbyID = '" . $_SESSION['userid'] . "') AND game = '" . $_SESSION['game'] . "' AND language = '" . $_SESSION['language'] . "' AND subject = 'Aanmelding' AND open = '2'  ORDER BY id");
        } elseif ($_SESSION['rights'] == 2) {
            $query = mysql_query("SELECT * FROM tickets WHERE game = '" . $_SESSION['game'] . "' AND language = '" . $_SESSION['language'] . "' AND open = '2' ORDER BY id");
        } elseif ($_SESSION['rights'] >= 3) {
            if (isset($_GET['sort'])) {
                $query = mysql_query("SELECT * FROM tickets WHERE game = '" . $_GET['sort'] . "' AND open = '2' ORDER BY id");
            } elseif (isset($_GET['lang'])) {
                $query = mysql_query("SELECT * FROM tickets WHERE language = '" . $_GET['lang'] . "' AND open = '2' ORDER BY id");
            } elseif (isset($_GET['sort']) && isset($_GET['lang'])) {
                $query = mysql_query("SELECT * FROM tickets WHERE game = '" . $_GET['sort'] . "' AND language = '" . $_GET['lang'] . "' AND open = '2' ORDER BY id");
            } else {
                $query = mysql_query("SELECT * FROM tickets WHERE open = '2' ORDER BY id");
            }
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
                    <td><?php echo game($tickets->game); ?></td>
                    <td><?php echo $tickets->language; ?></td>
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