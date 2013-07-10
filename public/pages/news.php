<?php

if (!isset($_SESSION['rights'])) {
    echo language(19);
    die();
}
?>

<?php

if ($_SESSION['rights'] >= 2) {
    
} else {
    echo language(20);
}
?>