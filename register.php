<?php

require('db_connect.php');	// database connect script.

if (isset($_POST['submit'])) { // if form has been submitted

	$replytoemail = "phpTickets@aretemm.net";	

	/* check they filled in what they supposed to, 
	passwords matched, username
	isn't already taken, etc. */

	if (!$_POST['uname'] | !$_POST['passwd'] | !$_POST['passwd_again'] | !$_POST['email']) {
		die('You did not fill in a required field.');
	}

	// check if username exists in database.

	if (!get_magic_quotes_gpc()) {
		$_POST['uname'] = addslashes($_POST['uname']);
	}


	$name_check = $db_object->query("SELECT username FROM users WHERE username = '".$_POST['uname']."'");

	if (DB::isError($name_check)) {
		die($name_check->getMessage());
	}

	$name_checkk = $name_check->numRows();

	if ($name_checkk != 0) {
		die('Sorry, the username: <strong>'.$_POST['uname'].'</strong> is already taken, please pick another one.');
	}

	$name_check2 = $db_object->query("SELECT emp_name FROM personnel WHERE emp_name = '".$_POST['uname']."'");

	if (DB::isError($name_check2)) {
		die($name_check2->getMessage());
	}

	$name_check2k = $name_check2->numRows();

	if ($name_check2k != 0) {
		die('Sorry, the username: <strong>'.$_POST['uname'].'</strong> is already taken, please pick another one.');
	}


	// check uname is long enough

	if (strlen($_POST['uname']) < '4') {
		die('Username must be at least 4 digits long.');
	}


	// check password is long enough

	if (strlen($_POST['passwd']) < '4') {
		die('Passwords must be at least 4 digits long.');
	}


	// check passwords match

	if ($_POST['passwd'] != $_POST['passwd_again']) {
		die('Passwords did not match.');
	}



	// check e-mail format

	if (!preg_match("/.*@.*..*/", $_POST['email']) | preg_match("/(<|>)/", $_POST['email'])) {
		die('Invalid e-mail address.');
	}

	// no HTML tags in username, website, location, password

	$_POST['uname'] = strip_tags($_POST['uname']);
	$_POST['passwd'] = strip_tags($_POST['passwd']);
	$_POST['website'] = strip_tags($_POST['website']);
	$_POST['location'] = strip_tags($_POST['location']);



	// check show_email data

	if ($_POST['show_email'] != 0 & $_POST['show_email'] != 1) {
		die('Nope');
	}

	/* the rest of the information is optional, the only thing we need to 
	check is if they submitted a website, 
	and if so, check the format is ok. */

	if ($_POST['website'] != '' & !preg_match("/^(http|ftp):\/\//", $_POST['website'])) {
		$_POST['website'] = 'http://'.$_POST['website'];
	}

	// now we can add them to the database.
	// encrypt password

	$_POST['passwd'] = password_hash($_POST['passwd'], PASSWORD_DEFAULT);

	if (!get_magic_quotes_gpc()) {
		$_POST['passwd'] = addslashes($_POST['passwd']);
		$_POST['email'] = addslashes($_POST['email']);
		$_POST['website'] = addslashes($_POST['website']);
		$_POST['location'] = addslashes($_POST['location']);
	}



	$regdate = date('m d, Y');

	$insert = "INSERT INTO users (
			username, 
			password, 
			regdate, 
			email, 
			website, 
			location, 
			show_email, 
			last_login,
			auth_level) 
			VALUES (
			'".$_POST['uname']."', 
			'".$_POST['passwd']."', 
			'$regdate', 
			'".$_POST['email']."', 
			'".$_POST['website']."', 
			'".$_POST['location']."', 
			'".$_POST['show_email']."', 
			'Never',
			'3')";

	$add_member = $db_object->query($insert);


	if (DB::isError($add_member)) {
		die($add_member->getMessage());
	}

	$insert2 = "INSERT INTO personnel (
			emp_name, 
			emp_email, 
			emp_title,
			emp_phone_hm,
			emp_phone_cell,
			emp_notes,
			emp_group,
			emp_login) 
			VALUES (
			'".$_POST['uname']."', 
			'".$_POST['email']."', 
			'',
			'', 
			'',
			'',
			'',
			'".$_POST['uname']."'
			)";

	$add_member2 = $db_object->query($insert2);


	if (DB::isError($add_member2)) {
		die($add_member2->getMessage());
	}
	$db_object->disconnect();


		
	$to = $_POST['email'];
	$subject = "Your account has been added to the Database";
	$message = "Hello. Your account has been added to the Database.";
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
	$message .= "To change your password, click here: http://www.aretemm.net/phpTickets/chpasswd.php?uname=";
	$message .= $_POST['uname'];
	$extra = "From: The Personnel Database <$replytoemail>\r\nReply-To: $replytoemail\r\n";

	mail ($to, $subject, $message, $extra);

?>

	<html><head>
	<title>Success!</title>
	<meta http-equiv="refresh" content="0; url=secure.php">
	</head>
	<body>
	Success!
	<p>Thank you, your information has been added to the database, you may now <a href="login.php" title="Login">log in</a>.</p>

<?php

} else {	// if form hasn't been submitted

?>
<html>
<head>
<title>Register an Account</title>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0>
<?php
include('./includes/topframe_disabled.inc');
?>
<center>
<table border=0><tr><td align="center">
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<img src="./images/register_logo1.jpg"></td></tr>
<tr><td>
<table border=0 cellpadding=5 width="100%" bgcolor="#CCCCCC">
<tr><th>Username</th><td bgcolor="#FFFFFF">
<input type="text" name="uname" maxlength="40">
</td></tr>
<tr><th>Password</th><td bgcolor="#FFFFFF">
<input type="password" name="passwd" maxlength="50">
</td></tr>
<tr><th>Confirm Password</th><td bgcolor="#FFFFFF">
<input type="password" name="passwd_again" maxlength="50">
</td></tr>
<tr><th>Email</th><td bgcolor="#FFFFFF">
<input type="text" name="email" maxlength="100">
</td></tr>
<tr>
<td align="center"><font size="-2">* all fields are required</font></td>
<td align="right">
<input type="submit" name="submit" value="Sign Up">
</td></tr>
</table>
<input type="hidden" name="show_email" value="1">
<input type="hidden" name="location" value="NULL">
<input type="hidden" name="website" value="NULL">
</form>

<?php

}

?>
</body>
</html>
