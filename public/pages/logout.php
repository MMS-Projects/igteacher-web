<?php
if(isset($_POST['submit'])){
unset($_SESSION['rights']);
unset($_SESSION['userid']);
unset($_SESSION['username']);
header('location: '.URL.'page/login');
}
?>
<form method="POST">
<input type="submit" name="submit" value="<?php echo language(18); ?>" />
</form>