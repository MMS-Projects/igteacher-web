<?php
if (!isset($_SESSION['rights'])) {
    echo language(19);
    die();
}
if ($_SESSION['rights'] >= 3) {

    if ($_GET['id']) {
        mysql_query("DELETE FROM news WHERE id = '" . $_GET['id'] . "'");
        $ul = '' . URL . '/page/addnews';
        header('Location: ' . $ul . '');
    }
    if (isset($_POST['addnews'], $_POST['newstext'])) {
        $qInsertNews = mysql_query("INSERT INTO news 
													(title, 
													text, 
													date, 
													author) 
													VALUES 
													('" . mysql_real_escape_string($_POST['title']) . "',
													'" . mysql_real_escape_string($_POST['newstext']) . "',
													'" . date("d-m-Y H:i:s") . "',
													'" . $_SESSION['username'] . "')");
        if (!$qInsertNews) {
            die('ERROR:' . mysql_error());
        } else {
            $ul = '' . URL . '/page/addnews';
            header('Location: ' . $ul . '');
            echo 'Added news succesfully!';
        }
    }
    ?>
    <h2>Nieuws toevoegen</h2>
    <table>
        <form method="POST">
            <tr>
                <td>
                    Titel
                </td>
                <td  class="lastth">
                    <input type="text" name="title" />
                </td>
            </tr>
            <tr>
                <td>
                    Nieuwstekst
                </td>
                <td  class="lastth">
                    <input type="text" name="newstext" style="width: 500px;"/> 
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td  class="lastth">
                    <input type="submit" name="addnews" />
                </td>
            </tr>
        </form>
    </table>
    <h2>Nieuws overzicht</h2>
    <table>
        <tr>
            <td>
                <strong>ID</strong>
            </td>
            <td>
                <strong>Titel</strong>
            </td>
            <td>
                <strong>Nieuws</strong>
            </td>
            <td  class="lastth">
                <strong>Verwijder</strong>
            </td>
        </tr>
        <?php
        $qGetnews = mysql_query("SELECT * FROM news");
        while ($news = mysql_fetch_object($qGetnews)) {
            ?>
            <tr>
                <td><?php echo $news->ID; ?></td>
                <td><?php echo $news->title; ?></td>
                <td style="width:600px;"><?php echo $news->text; ?></td>
                <td  class="lastth"><a href="addnews/<?php echo $news->ID; ?>">Verwijder</a></td>
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