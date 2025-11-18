<?php

$message .= "Hello\n\";
$message .= "\tYour account has been added into the database.\n\n";
$message .= "Name: ".$_POST['uname'].";
$message .= "\nPassword: ".$_POST['passwd_again'].";
$message .= "\n\n";
$message .= "If you have any questions, please let me know at lmoiola@aretemm.net\n\n";
$message .= "The Personnel and Project Management Tool:\n";
$message .= "http://www.aretemm.net/phpTickets/";
$message .= "\n\n";
$message .= "To reset your password, click here: http://www.aretemm.net/phpTickets/chpasswd.php?uname=$uname";

?>