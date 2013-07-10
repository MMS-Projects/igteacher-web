<?php
if (isset($_GET['id'], $_SESSION['userid'])) {
    $query = mysql_query("SELECT * FROM users WHERE ID = '" . $_GET['id'] . "'");
    while ($profile = mysql_fetch_object($query)) {
        ?>
        <h3><?php echo $profile->username; ?><span class="red"><a href="<?php echo URL . 'page/editprofile/' . $_GET['id']; ?>"><?php
                    if ($_SESSION['userid'] == $profile->ID || $_SESSION['rights'] >= 2) {
                        echo language(85);
                    }
                    ?></a></span></h3>
        <p><?php echo bbcode_format($profile->personaltext); ?></p>
        <table>
            <tr>
                <td><?php echo language(83); ?></td>
                <td><?php echo gender($profile->gender); ?></td>
            </tr>	
            <tr>
                <td><?php echo language(99); ?></td>
                <td><?php echo $profile->rating; ?></td>
            </tr>	
            <tr>
                <td><?php echo language(81); ?></td>
                <td><?php echo $profile->birthday; ?></td>
            </tr>
        </table>
        <?php
    }
} else {
    echo language(20);
}
?>