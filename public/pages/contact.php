<?php
if ($_POST['submit']) {
    $name = mysql_real_escape_string($_POST['name2']);
    $email = mysql_real_escape_string($_POST['email']);
    $message = mysql_real_escape_string(bbcode_format($_POST['message']));
    if ($message && $email && $name) {
        $query = mysql_query("INSERT INTO contact VALUES ('', '$name', '$email', '$message', '" . date('d-m-Y-H:i:s') . "', '" . $_SERVER['REMOTE_ADDR'] . "', '0')");
        if (isset($query)) {
            echo 'Succes';
        } else {
            echo 'Error2';
        }
    } else {
        echo 'Error';
    }
}
?>
<h2>Contact</h2>

<?php echo language(127); ?><hr />
<form action="" method="POST">
    <?php echo language(128); ?><br />
    <input type="text" name="name2" /><br />
    E-mail:<em>*</em><br />
    <input type="text" name="email" /><br />
    Bericht <br />
    <div class="richeditor">
        <div class="editbar">
            <button title="bold" onclick="doClick('bold');" type="button"><b>B</b></button>
            <button title="italic" onclick="doClick('italic');" type="button"><i>I</i></button>
            <button title="underline" onclick="doClick('underline');" type="button"><u>U</u></button>
        </div>
        <div class="container">
            <textarea name="message" id="tbMsg" style="height:150px;width:350px;"></textarea>
        </div>
    </div>
    <script type="text/javascript">
                initEditor("tbMsg", true);
    </script>
    <input type="submit" name="submit" onclick="doCheck();" /><br />
</form>
<br />


<em>* <?php echo language(129); ?></em>