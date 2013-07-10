<?php
if (!isset($_SESSION['rights'])) {
    echo language(19);
    die();
}
if (isset($_POST['take'])) {
    mysql_query("UPDATE tickets SET takenbyID = '" . $_SESSION['userid'] . "' WHERE ID = '" . $_GET['id'] . "'");
    mysql_query("UPDATE tickets SET open = '1' WHERE ID = '" . $_GET['id'] . "'");
}
if (isset($_POST['forward'])) {
    $rights = $_POST['forwardto'];
    mysql_query("UPDATE tickets SET open = '0' WHERE ID = '" . $_GET['id'] . "'");
    mysql_query("UPDATE tickets SET takenbyID = NULL WHERE ID = '" . $_GET['id'] . "'");
    mysql_query("UPDATE tickets SET rights = '" . $rights . "' WHERE ID = '" . $_GET['id'] . "'");
}
if (isset($_POST['letgo'])) {
    mysql_query("UPDATE tickets SET takenbyID = NULL WHERE ID = '" . $_GET['id'] . "'");
    mysql_query("UPDATE tickets SET open = '0' WHERE ID = '" . $_GET['id'] . "'");
}
if (isset($_POST['priority'])) {
    mysql_query("UPDATE tickets SET priority = '" . $_POST['prio'] . "' WHERE ID = '" . $_GET['id'] . "'");
}
if (isset($_POST['close'])) {
    $rdate = date('d-m-Y H:i:s');
    mysql_query("UPDATE tickets SET closedate = '$rdate' WHERE ID = '" . $_GET['id'] . "'");
    mysql_query("UPDATE tickets SET open = '2' WHERE ID = '" . $_GET['id'] . "'");
}
if (isset($_POST['open'])) {
    mysql_query("UPDATE tickets SET open = '0' WHERE ID = '" . $_GET['id'] . "'");
}
if ($_SESSION['rights'] >= 0) {
    $query = mysql_query("SELECT * FROM tickets WHERE ID = '" . $_GET['id'] . "'");
    while ($ticket = mysql_fetch_object($query)) {
        //Controle of the user may view te ticket
        // BEGIN
        if ($_SESSION['rights'] == 0) {
            if (!$ticket->userID == $_SESSION['userid']) {
                echo language(19);
                die();
            }
        } elseif ($_SESSION['rights'] == 1) {
            if ($ticket->language == $_SESSION['language'] && $ticket->rights <= $_SESSION['rights'] && $ticket->game == $_SESSION['game']) {
                
            } else {
                echo language(19);
                die();
            }
        } elseif ($_SESSION['rights'] == 2) {
            if ($ticket->language == $_SESSION['language'] && $ticket->rights <= $_SESSION['rights'] && $ticket->game == $_SESSION['game']) {
                
            } else {
                echo language(19);
                die();
            }
        }
        // END OF USER MAY VIEUW TE TICKET!


        if ($_SESSION['userid'] == $ticket->userID || $_SESSION['rights'] >= 1) {
            if (isset($_POST['email'])) {
                $query = mysql_query("SELECT email FROM users WHERE ID = '" . $ticket->userID . "'");
                while ($email = mysql_fetch_object($query)) {
                    $emailtosend = $email->email;
                }
                $to = $emailtosend;
                $subject = language(90) . ' ' . SiteName;

                $message = "
<html>
<head>
<title>" . language(90) . " " . SiteName . "</title>
</head>
<body>
<h3>" . language(90) . " " . SiteName . "</h3>
<hr />
" . language(91) . "
<hr /><br /><br />
" . language(58) . "<br />
<a href='" . URL . "'>" . SiteName . "</a><br />
</body>
</html>
";

// Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// More headers
                $headers .= 'From: <mail@igteacher.com>' . "\r\n";

                $rdate = date('d-m-Y H:i:s');
//mail($to,$subject,$message,$headers);
                mysql_query("INSERT INTO notes VALUES('','" . $_SESSION['userid'] . "','" . $ticket->ID . "','" . language(123) . "','$rdate')");
                $ul = '' . URL . 'page/viewticket/' . $_GET['id'] . '';
                header('Location: ' . $ul . '');
                ;
            }
            if (isset($_POST['rating'])) {
                $sSqlrating = mysql_query("SELECT rating FROM users WHERE ID = '" . $ticket->takenbyID . "'");
                while ($rating = mysql_fetch_object($sSqlrating)) {
                    $currrating = $rating->rating;
                }
                $newrating = $currrating + $_POST['rating'];
                mysql_query("UPDATE users SET rating = '" . $newrating . "' WHERE ID = '" . $ticket->takenbyID . "'");
            }
            if (isset($_POST['react'], $_POST['reaction'])) {
                $query = mysql_query("SELECT email FROM users WHERE ID = '" . $ticket->userID . "'");
                while ($email = mysql_fetch_object($query)) {
                    $emailtosend = $email->email;
                }
                $rdate = date('d-m-Y H:i:s');
                $query = mysql_query("SELECT * FROM answers WHERE ticketID = '" . $_GET['id'] . "'");
                $firstanswer = mysql_num_rows($query);
                if ($firstanswer == '0') {
                    mysql_query("UPDATE tickets SET firstanswer = '$rdate' WHERE ID = '" . $_GET['id'] . "' ");
                }
                $rnewreaction = mysql_real_escape_string(bbcode_format($_POST['reaction']));
                $ruserid = $_SESSION['userid'];
                $rticketid = $_GET['id'];
                mysql_query("INSERT INTO answers VALUES('','$ruserid','$rticketid','$rnewreaction','$rdate')");
                mysql_query("UPDATE tickets SET lastanswer = '$rdate' WHERE id = '" . $_GET['id'] . "' ");

                $to = $emailtosend;
                $subject = language(76) . ' ' . SiteName;

                $message = "
<html>
<head>
<title>" . language(76) . " " . SiteName . "</title>
</head>
<body>
<h3>" . language(76) . " " . SiteName . "</h3>
<hr />
" . bbcode_format($_POST['reaction']) . "
<hr /><br /><br />
" . language(58) . "<br />
<a href='" . URL . "'>" . SiteName . "</a><br />
<br />
<br />
" . language(124) . "
</body>
</html>
";

// Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// More headers
                $headers .= 'From: <mail@igteacher.com>' . "\r\n";

//mail($to,$subject,$message,$headers);
                $ul = '' . URL . 'page/viewticket/' . $_GET['id'] . '';
                header('Location: ' . $ul . '');
            }

            if (isset($_POST['nnote'], $_POST['newnote'])) {
                $newnote = $_POST['newnote'];
                $nid = $_SESSION['userid'];
                $ntid = $_GET['id'];
                $ndate = date('d-m-Y H:i:s');
                mysql_query("INSERT INTO notes VALUES('', '$nid', '$ntid', '$newnote', '$ndate')");
                $ul = '' . URL . 'page/viewticket/' . $_GET['id'] . '';
                header('Location: ' . $ul . '');
            }
            if (isset($_POST['newlesson'], $_POST['newlessontext'])) {
                $content = $_POST['newlessontext'];
                $ndate = date('d-m-Y H:i:s');
                mysql_query("INSERT INTO lessons VALUES('', '" . $_GET['id'] . "', '" . $_SESSION['userid'] . "', '$ndate', '$content')");
                $ul = '' . URL . 'page/viewticket/' . $_GET['id'] . '';
                header('Location: ' . $ul . '');
            }
// email from the ticketowner
            $q = mysql_query("SELECT * FROM users WHERE ID = '" . $ticket->userID . "'");
            while ($qm = mysql_fetch_assoc($q)) {
                $qmail = $qm['email'];
            }
            ?>
            <h3><?php echo $ticket->subject . ' ' . language(61) . ' ' . username($ticket->userID); ?> <small class="red" ><?php
                    if ($_SESSION['rights'] >= 3) {
                        echo $ticket->ip;
                    }
                    ?></small></h3>
            <table>
                <tr>
                    <td><?php echo language(29); ?>:</td>
                    <td class="lastth"><?php echo status($ticket->open); ?></td>
                <tr>
                <tr>
                    <td>Aangemaakt op:</td>
                    <td class="lastth"><?php echo $ticket->createdate; ?></td>
                </tr>
            <?php if ($ticket->open == 2) { ?>
                    <tr>
                        <td>Gesloten op :</td>
                        <td class="lastth"><?php echo $ticket->closedate; ?></td>
                    </tr>
            <?php } ?>
                <tr>
                    <td><?php echo language(30); ?>:</td>
                    <td class="lastth"><?php echo priority($ticket->priority); ?>
            <?php if ($_SESSION['rights'] >= 1) { ?>
                            <form method="POST">
                                <select name="prio">
                                    <option value="3" ><?php echo language(77); ?></option>
                                    <option value="0" ><?php echo language(34); ?></option>
                                    <option value="1"><?php echo language(33); ?></option>
                                    <option value="2"><?php echo language(35); ?></option>
                                </select><input type="submit" name="priority" />
                            </form>
            <?php } ?>
                    </td>
                <tr>
                <tr>
                    <td><?php echo language(31); ?>:</td>
                    <td class="lastth"><?php echo game($ticket->game); ?></td>
                <tr>
                <tr>
                    <td><?php echo language(32); ?>:</td>
                    <td class="lastth"><?php echo lang($ticket->language); ?></td>
                <tr>
                <tr>
                    <td><?php echo language(65); ?>:</td>
                    <td class="lastth"><?php echo @username($ticket->takenbyID); ?></td>
                <tr>
                    <?php
                    if ($ticket->open == 1 && $_SESSION['rights'] == 1 && $ticket->takenbyID == $_SESSION['userid'] || $ticket->userID == $_SESSION['userid'] || $_SESSION['rights'] >= 2) {
                        ?>
                    <tr>
                        <td> Skype </td>
                        <td class="lastth"><?php echo $ticket->skype; ?></td>
                    </tr>
                    <tr>
                        <td> <?php echo language(44); ?> </td>
                        <td class="lastth"><?php echo $qmail; ?></td>
                    </tr>
            <?php } ?>
                <tr>
                    <td><?php echo language(46); ?>:</td>
                    <td class="lastth"><?php echo $ticket->motivation; ?></td>
                <tr>
                    <?php
                    if ($ticket->takenbyID == NULL && $_SESSION['rights'] >= 1 && $ticket->open != 2 || $_SESSION['rights'] > 2 && $ticket->open != 1) {
                        ?>
                    <tr>
                        <td></td>
                        <td class="lastth"><form method="POST"><input type="submit" name="take" value="<?php echo language(73); ?>" /></form></td>
                    <tr>
                        <?php
                    } elseif ($ticket->takenbyID == $_SESSION['userid'] && $_SESSION['rights'] >= 1 && $ticket->open != 2 || $_SESSION['rights'] >= 2) {
                        ?>
                    <tr>
                        <td></td>
                        <td class="lastth"><form method="POST"><input type="submit" name="letgo" value="<?php echo language(74); ?>" /></form></td>
                    <tr>
                        <?php
                    }
                    if ($ticket->open == 1 && $_SESSION['rights'] >= 1 || $ticket->open == 0 && $_SESSION['rights'] >= 1 || $ticket->userID == $_SESSION['userid']) {
                        ?>
                    <tr>
                        <td></td>
                        <td class="lastth"><form method="POST"><input type="submit" name="close" value="<?php echo language(78); ?>" /></form></td>
                    <tr>
                        <?php
                    } elseif ($ticket->open == 2 && $_SESSION['rights'] >= 2) {
                        ?>
                    <tr>
                        <td></td>
                        <td class="lastth"><form method="POST"><input type="submit" name="open" value="<?php echo language(79); ?>" /></form></td>
                    <tr>
                        <?php
                    }
                    if ($_SESSION['rights'] >= 1 && $ticket->open != 2) {
                        ?>
                    <tr>
                        <td></td>
                        <td class="lastth"><form method="POST"><input type="submit" name="email" value="<?php echo language(89); ?>" /></form></td>
                    <tr>
                        <?php
                    }
                    if ($_SESSION['rights'] >= 1) {
                        ?>
                    <tr>
                        <td></td>
                        <td class="lastth">
                            <form method="POST">
                                <select name="forwardto">
                                    <option value="1"><?php echo rights(1); ?></option>
                                    <option value="2"><?php echo rights(2); ?></option>
                                    <option value="3"><?php echo rights(3); ?></option>
                                    <option value="4"><?php echo rights(4); ?></option>
                                </select>
                                <input type="submit" name="forward" value="<?php echo language(92); ?>" />
                            </form>
                        </td>
                    <tr>
                    <?php } ?>
            <?php if ($ticket->userID == $_SESSION['userid']) { ?>
                <?php if (!empty($ticket->takenbyID)) { ?>
                        <tr>
                            <td></td>
                            <td class="lastth"><form method="POST">
                                    <select name="rating">	
                                        <option value="-1"><?php echo language(94); ?></option>	
                                        <option value="1"><?php echo language(95); ?></option>	
                                        <option value="2"><?php echo language(96); ?></option>	
                                        <option value="3"><?php echo language(97); ?></option>
                                    </select>
                                    <input type="submit" value="<?php echo language(98); ?>" />
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php
                }
                if ($ticket->open == 1 && $_SESSION['rights'] >= 1 || $ticket->open == 1 && $_SESSION['rights'] >= 3 || $ticket->open == 0 && $_SESSION['rights'] >= 3 || $_SESSION['userid'] == $ticket->userID && $ticket->open < 2) {
                    ?>
                    <tr>
                        <td><?php echo language(75); ?></td>
                        <td class="lastth">	
                            <form method="POST">
                                <div class="richeditor">
                                    <div class="editbar">
                                        <button title="bold" onclick="doClick('bold');" type="button"><b>B</b></button>
                                        <button title="italic" onclick="doClick('italic');" type="button"><i>I</i></button>
                                        <button title="underline" onclick="doClick('underline');" type="button"><u>U</u></button>
                                    </div>
                                    <div class="container">
                                        <textarea name="reaction" id="tbMsg" style="height:150px;width:350px;"><?php if ($_SESSION['rights'] > 0) { ?><?php echo language(125); ?> <?php echo username($ticket->userID); ?> 
                                        				
                                        				
                                        				
                                                <?php echo language(58); ?>
                                        				
                                                <?php echo username($_SESSION['userid']); ?>
                                        				
                    <?php echo rights($_SESSION['rights']); ?>
                <?php } ?></textarea>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                            initEditor("tbMsg", true);
                                </script>
                                <input name="react" type="submit" onclick="doCheck();" /></form></td>

                    </tr>





                    <?php
                }
                ?>
            </table>

            <?php
            if ($_SESSION['userid'] == $ticket->takenbyID || $_SESSION['userid'] == $ticket->userID || $_SESSION['rights'] >= 2) {
                ?>
                <table>
                    <tr>
                        <th class="lastth">
                    <?php echo language(122); ?>
                        </th>
                    </tr>
                    <?php
                    $reqid = $_GET['id'];
                    $reqq = mysql_query("SELECT * FROM answers WHERE ticketID = '$reqid'");
                    while ($rec = mysql_fetch_object($reqq)) {
                        ?>
                        <tr>
                            <th class="lastth"	>
                    <?php echo language(120); ?> <?php echo $rec->date; ?> <?php echo language(121); ?> <?php echo @username($rec->userID); ?>
                            </th>
                        </tr>
                        <tr>
                            <td class="lastth">
                        <?php echo $rec->reaction; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
            }
            ?>
            <?php if ($_SESSION['rights'] >= 1) { ?>
                <br />
                <br />
                <table>
                    <tr>
                        <th class="lastth"> Gegeven lessen </th>
                    </tr>
                    <tr>
                        <th class="lastth"> Nieuwe les toevoegen </th>
                    </tr>
                    <tr><form action="" method="POST">
                        <th class="lastth"><textarea rows=5 cols=100 name="newlessontext"></textarea><br />
                            <input type="submit" name="newlesson" /></th>
                    </form>
                </tr>
                </table>
                <table>
                    <tr>
                        <th class="lastth">Bekijk lessen</th>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th>Datum</th>
                        <th>Door</th>
                        <th class="lastth">Inhoud</th>
                    </tr>
                    <?php
                    $lessonq = mysql_query("SELECT * FROM lessons WHERE ticketID = '" . $_GET['id'] . "'");
                    while ($lesson = mysql_fetch_object($lessonq)) {
                        ?>
                        <tr>
                            <td><?php echo $lesson->date; ?></td>
                            <td><?php echo @username($lesson->userID); ?></td>
                            <td class="lastth"><?php echo nl2br($lesson->content); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>

                <br />
                <br />
                <table>
                    <tr>
                        <th class="lastth"><?php echo language(103); ?></th>
                    </tr>
                    <?php
                    if ($ticket->open != 2 && $_SESSION['rights'] >= 1) {
                        ?>
                        <tr>
                            <td class="lastth"><?php echo language(107); ?>	
                                <form method="POST">
                                    <textarea name="newnote" id="tbMsg" style="height:25px;width:350px;" /></textarea><br />
                                    <input name="nnote" type="submit" onclick="doCheck();" />
                                </form>
                            </td>

                        </tr>
                <?php } ?>
                </table>
                <?php
            }

            if ($_SESSION['rights'] >= 1) {
                ?>

                <table>
                    <tr>
                        <th><?php echo language(105) ?></th>
                        <th><?php echo language(104); ?></th>
                        <th class="lastth"><?php echo language(106); ?></th>
                    </tr>
                    <?php
                    $notesq = mysql_query("SELECT * FROM notes WHERE ticketID = '" . $_GET['id'] . "'");
                    while ($notes = mysql_fetch_object($notesq)) {
                        ?>

                        <tr>
                            <td><?php echo @username($notes->userID); ?></td>
                            <td><?php echo $notes->date; ?></td>
                            <td class="lastth"><?php echo $notes->note; ?></td>
                        </tr>
                        <?php
                    }
                    ?>

                </table>
            <?php } ?>
            <?php
        } else {
            echo language(20);
        }
    }
} else {
    echo language(20);
}
?>