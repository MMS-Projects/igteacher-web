<?php

if (!isset($_SESSION['rights'])) {
    echo language(19);
    die();
}
if ($_SESSION['rights'] >= 3) {


    $id = $_GET['id'];
    mysql_query("DELETE FROM bans WHERE id='$id'");
    $ul = '' . URL . 'page/ban/';
    header('Location: ' . $ul . '');
} else {
    echo language(20);
}
?>