<?php
require('db_connect.php');	// database connect script.

// 0d107d09f5bbe40cade3de5c71e9e9b7 = letmein

$replytoemail = "phpTickets@aretemm.net";

if (isset($_POST['submit'])) { // if form has been submitted
	/* check they filled in what they supposed to, 
	passwords matched, username
	isn't already taken, etc. */

	if (!$_POST['old_passwd'] | !$_POST['passwd'] | !$_POST['passwd_again']) {
		die('You did not fill in a required field.');
	}


	// check if old password matches

	if (!get_magic_quotes_gpc()) {
		$_POST['uname'] = addslashes($_POST['uname']);
	}

	$check = $db_object->query("SELECT username, password, email FROM users WHERE username = '".$_POST['uname']."'");

	if (DB::isError($check)) {
		die('That username does not exist in our database.');
	}

	$info = $check->fetchRow();

	// check password is long enough

	if (strlen($_POST['passwd']) < '4') {
		die('Passwords must be at least 4 digits long.');
	}

	// check passwords match

	$info['password'] = stripslashes($info['password']);

	if (!password_verify($_POST['old_passwd'], $info['password'])) {
		die('Old Password was incorrect. Cannot proceed.');
	}

	// check passwords match

	if ($_POST['passwd'] != $_POST['passwd_again']) {
		die('Passwords did not match.');
	}

	// no HTML tags in username, website, location, password

	$_POST['uname'] = strip_tags($_POST['uname']);
	$_POST['passwd'] = strip_tags($_POST['passwd']);

	// now we can add them to the database.
	// encrypt password

	$_POST['passwd'] = password_hash($_POST['passwd'], PASSWORD_DEFAULT);

	$insert = "UPDATE users SET password = '".$_POST['passwd']."' WHERE username = '".$_POST['uname']."'";

	$add_member = $db_object->query($insert);

	if (DB::isError($add_member)) {
		die($add_member->getMessage());
	}



	$db_object->disconnect();

	$to = $info['email'];
	$subject = "Your account has been updated";
	$message = "Hello. Your password was updated successfully.";
	$message .= "\n\n";
	$message .= "\tUsername: ";
	$message .= $_POST['uname'];
	$message .= "\n\tPassword: (not shown for security)";
	$message .= "\n\n";
	$message .= "Questions? Please let me know at [ lmoiola@aretemm.net ].";
	$message .= "\n\n";
	$message .= "****************************************************************\n";
	$message .= "The Personnel and Project Management Tool:\n";
	$message .= "http://www.aretemm.net/phpTickets/";
	$message .= "\n\n";
	$message .= "To redo your password, click here: http://www.aretemm.net/phpTickets/chpasswd.php?uname=";
	$message .= $_POST['uname'];
	$extra = "From: Personnel Database <$replytoemail>\r\nReply-To: $replytoemail\r\n";

	mail ($to, $subject, $message, $extra);


?>

	<html><head>
	<title>Success!</title>
	<meta http-equiv="refresh" content="5; url=login.php">
	</head>
	<body>
	Success! <?php echo $_POST['uname']; ?>, you have updated your password in the database. You may now <a href="login.php" title="Login">log in</a>.</p>

<?php

} else {	// if form hasn't been submitted

$uname = $_GET['uname'];

?>
<html>
<head>
<title>Change Password</title>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0>
<?php
include('./includes/topframe_disabled.inc');

?>
<center>
<table border=0><tr><td align="center">
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<input type="hidden" name="uname" value="<?php echo $uname; ?>">
<img src="./images/chpasswd_logo1.jpg"></td></tr>
<tr><td>
<table border=0 cellpadding=5 width="100%" bgcolor="#CCCCCC">
<tr><th>Old Password</th><td bgcolor="#FFFFFF">
<input type="password" name="old_passwd" maxlength="50">
</td></tr>
<tr><th>New Password</th><td bgcolor="#FFFFFF">
<input type="password" name="passwd" maxlength="50">
</td></tr>
<tr><th>Confirm Password</th><td bgcolor="#FFFFFF">
<input type="password" name="passwd_again" maxlength="50">
</td></tr>

	<?php 
	if(strlen($uname) < '1') {

	echo "
	<tr>
	<td align=\"center\"><font size=\"-2\"></font></td>
	<td align=\"right\"><input type=\"button\" name=\"submit\" disabled value=\"Change Password\"></td>
	</tr>
	</table>
	</form>
	<center>You must provide a username.<br>Just click (or cut-n-paste) the link from your email.</center>
	";

	} else {

	echo "
	<tr>
	<td align=\"center\"><font size=\"-2\">* all fields are required</font></td>
	<td align=\"right\"><input type=\"submit\" name=\"submit\" value=\"Change Password\"></td>
	</tr>
	</table>
	</form>
	";
	}

}

?>
</body>
</html>